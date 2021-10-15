<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 10/11/2021
 * Time: 5:32 PM
 */

namespace App\Services;


use App\Constants\CommonConstant;
use App\Models\CropPathogen;
use App\Models\CropPathogenBiochemicalDrug;
use App\Models\CropPathogenMethodGeneral;
use App\Models\CropPathogenStage;
use App\Models\IdentifyUser;
use App\Models\MstCrop;
use App\Models\MstPathogen;
use App\Models\PathogenInstructionDrug;
use Illuminate\Support\Facades\Session;

class DataServices
{
    public static function CreateUserIdentifyTest(string $image_public_url): IdentifyUser
    {
        $user = Session::get('user');
        // Tạo identiuser ảo
        $identifyUser = new IdentifyUser();
        $identifyUser->user_id = $user->id;
        $identifyUser->latitude = 120;
        $identifyUser->longitude = 120;
        $identifyUser->pathogen_indentify_status = 1;
        $identifyUser->image = $image_public_url;
        $identifyUser->air_temperature = 35;

        $identifyUser->save();
        return $identifyUser;

    }

    public static function GetDiseaseDataFromScientificName($scientificName): array
    {

        $pathogen = MstPathogen::query()->where("scientific_name", "=", $scientificName)->first();
        return DataServices::GetDiseaseData($pathogen);
    }

    public static function GetDiseaseDataFromIdentifyUserId($identify_user_id): array
    {
        $pathogen_list = [];
        $pathogen_data = IdentifyUser::query()
            ->select('mst_pathogen.*')
            ->join('identify_result', 'identify_result.identify_user_id', '=', 'identify_user.id')
            ->join('mst_pathogen', 'mst_pathogen.scientific_name', '=', 'identify_result.scientific_name')
            ->where('identify_user.id', $identify_user_id)
            ->where('identify_result.type', CommonConstant::PLANTIX_TYPE)
            ->get()
            ->toArray();
        foreach ($pathogen_data as $value) {
            array_push($pathogen_list, DataServices::GetDiseaseData($value));
        }
        return ["pathogen_data" => $pathogen_list];
    }

    private static function GetDiseaseData($pathogen): array
    {
        $pathogen_data = [];
        $pathogen_data["name"] = $pathogen["name"];
        $pathogen_data["scientific_name"] = $pathogen["scientific_name"];

        // Nhận biết sâu bệnh
        $pathogen_data["recognition"] = $pathogen["recognition"];
        $pathogen_data["instruction"] = $pathogen["instruction"];

        // Lấy thông tin cây bệnh, thông tin triệu chứng
        $crop_datas = CropPathogen::query()
            ->select('crop_pathogen.id', 'crop_manager.crop_name', 'crop_pathogen.symptom', 'crop_pathogen.cause')
            ->join('mst_pathogen', 'crop_pathogen.pathogen_id', "=", "mst_pathogen.id")
            ->join('crop_manager', 'crop_manager.id', "=", "crop_pathogen.crop_id")
            ->where('mst_pathogen.id', $pathogen["id"])
            ->get()
            ->toArray();

        // Lấy thông tin stage cho từng cây
        foreach ($crop_datas as $key1 => $value1) {
            $stage = CropPathogenStage::query()
                ->select('category.id', 'category.category_name')
                ->join('category', 'crop_pathogen_stage.category_id', '=', 'category.id')
                ->where('crop_pathogen_stage.crop_pathogen_id', $value1["id"])
                ->get()->toArray();

            $crop_datas[$key1]["stage"] = $stage;

            // Lấy thông tin biện pháp tổng hợp
            $general_method = CropPathogenMethodGeneral::query()
                ->select('crop_pathogen_method_general.content', 'mst_method_general.name')
                ->join('mst_method_general', 'mst_method_general.id', '=', 'crop_pathogen_method_general.mst_method_general_id')
                ->where('crop_pathogen_method_general.crop_pathogen_id', $value1["id"])
                ->get()
                ->toArray();

            $crop_datas[$key1]["general_method"] = $general_method;
        }

        $pathogen_data["crop_disease"] = $crop_datas;

        // Lấy thông tin thuốc sinh học
        $pathogen_data["biology_drug"] = DataServices::GetDrugInformation($pathogen["id"], CommonConstant::DRUG_TYPE_BIOLOGY);

        // Lấy thông tin thuốc hóa học
        $pathogen_data["chemical_drug"] = DataServices::GetDrugInformation($pathogen["id"], CommonConstant::DRUG_TYPE_CHEMICAL);

        // Lấy hướng dẫn sử dụng thứ tự các loại thuốc
        $drug_instruction = PathogenInstructionDrug::query()
            ->select('mst_instruction_drug.name', 'mst_instruction_drug.id')
            ->join('mst_instruction_drug', 'mst_instruction_drug.id', '=', 'pathogen_instruction_drug.mst_instruction_drug_id')
            ->where('pathogen_instruction_drug.pathogen_id', $pathogen["id"])
            ->get()
            ->toArray();
        $pathogen_data["drug_instruction"] = $drug_instruction;

        return $pathogen_data;
    }

    public static function GetCropDataFromFromScientificName($scientificName): array
    {
        $crop_data = MstCrop::query()
            ->select('crop_manager.crop_name', 'crop_manager.introduce', 'mst_crop.name', 'mst_crop.name_en')
            ->leftJoin('crop_manager', 'crop_manager.mst_crop_id', '=', 'mst_crop.id')
            ->where('scientific_name', '=', $scientificName)
            ->first()
            ->toArray();

        return $crop_data;
    }

    public static function GetCropDataFromIdentifyUserId($identify_user_id): array
    {
        $pathogen_data = IdentifyUser::query()
            ->select('crop_manager.crop_name', 'crop_manager.introduce', 'identify_user.image', 'mst_crop.name', 'mst_crop.name_en')
            ->join('identify_result', 'identify_result.identify_user_id', '=', 'identify_user.id')
            ->join('mst_crop', 'mst_crop.scientific_name', '=', 'identify_result.scientific_name')
            ->leftJoin('crop_manager', 'crop_manager.mst_crop_id', '=', 'mst_crop.id')
            ->where('identify_user.id', $identify_user_id)
            ->where('identify_result.type', CommonConstant::PLANTID_TYPE)
            ->get()
            ->toArray();

        return ["crop_data" => $pathogen_data];
    }

    public static function GetDrugInformation($panthogen_id, $drug_type)
    {

        $drug_data = CropPathogenBiochemicalDrug::query()
            ->select('crop_protection_product.common_name', 'crop_protection_product.trade_name',
                'crop_protection_product.pest_crop', 'p1.group_name as child_group', 'p2.group_name as parent_group',
                'common_name_manager.id as common_name_id')
            ->join('crop_protection_product', 'crop_protection_product.id', '=', 'crop_pathogen_biochemical_drug.crop_protection_product_id')
            ->join('common_name_manager', 'common_name_manager.id', '=', 'crop_protection_product.common_name_manager_id')
            ->join('protect_product_group as p1', 'p1.id', '=', 'common_name_manager.protect_product_group_id')
            ->join('protect_product_group as p2', 'p1.parent_id', '=', 'p2.id')
            ->where('crop_pathogen_biochemical_drug.pathogen_id', $panthogen_id)
            ->where('crop_pathogen_biochemical_drug.type', $drug_type)
            ->get()
            ->toArray();

        $drug_response = [];
        foreach ($drug_data as $value2) {
            $drug = [];
            if (!array_key_exists($value2["common_name"], $drug_response)) {
                $drug_response[$value2["common_name"]] = [];

            }
            $drug["trade_name"] = $value2["trade_name"];
            $drug["pest_crop"] = $value2["pest_crop"];
            $drug["child_group"] = $value2["child_group"];
            $drug["parent_group"] = $value2["parent_group"];
            $drug["common_name_id"] = $value2["common_name_id"];
            array_push($drug_response[$value2["common_name"]], $drug);
        }

        return $drug_response;
    }

}
