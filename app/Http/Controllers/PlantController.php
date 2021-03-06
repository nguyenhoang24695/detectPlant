<?php

namespace App\Http\Controllers;

use App\Models\PlantData;
use App\Services\DataServices;
use App\Services\ImageService;
use App\Services\PlantIdService;
use App\Services\PlantixServices;
use App\Services\UserService;
use App\Utils\FileUtil;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->getRequestUri() == "/plant/v2") {
            return view("plant.index", ["url" => "/plant/detect"]);
        }
        return view("plant.index", ["url" => "/plant/upload"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function store(Request $request)
    {
        $image = $request->file('picture');
        $plantix_data = PlantixServices::ImageAnalysis($image);
//        if ($data["plant_net"][0]["name"] == "ORNAMENTAL") {
        $plantId_data = PlantIdService::ImageAnalysis($plantix_data);
//        }
        return view("plant.list", ['plantix_data' => $plantix_data], ['plantId_data' => $plantId_data]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function show(Request $request)
    {
        if (!Session::exists('user')) {
            $user = UserService::TestUser();
            Session::put("user", $user);
        }

        $response = [];
        $image = $request->file('picture');

        $sha_image = FileUtil::SHAFile($image);
        $image_check_result = ImageService::CheckSHAImage($sha_image);

        // X??? l?? ???nh ???? ???????c d??? ??o??n tr?????c ????y
        if (isset($image_check_result)) {
            $disease_data = DataServices::GetDiseaseDataFromIdentifyUserId($image_check_result["identify_user_id"]);
            $crop_data = DataServices::GetCropDataFromIdentifyUserId($image_check_result["identify_user_id"]);

            $response = array_merge($crop_data, $disease_data);

            return view("plant.new-result")->with("response", $response);
        }

        // L??u v?? l???y ra path local v?? path t????ng ?????i tr??n web
        [$image_url, $image_public_url] = FileUtil::SaveImageToPublicFolder($image);

        // T???o 1 user nh???n di???n ???o v???i user l?? admin
        $user_identify = DataServices::CreateUserIdentifyTest($image_public_url);

        //D??? li???u s??u b???nh tr??? v??? t??? Plantix service
        $disease_data = PlantixServices::ImageAnalysis($user_identify, $image_url);

        //D??? li???u tr??? v??? t??? plantId
        $crop_data = PlantIdService::ImageAnalysis($user_identify, $image_url);

        //L???y url c???a ???nh ????a v??o response
        foreach ($crop_data["crop_data"] as $key => $value) {
            $crop_data["crop_data"][$key]["image"] = $image_public_url;
        }
        $response = array_merge($crop_data, $disease_data);

        //L??u b???n ghi ng?????i d??ng nh???n di???n
        $user_identify->save();

        //L??u l???i checsum SHA c???a ???nh v???a nh???n di???n
        ImageService::SaveSHAImage($sha_image, $user_identify->id);

//        return view("plant.result")
        return view("plant.new-result")->with("response", $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view("plant.result");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
