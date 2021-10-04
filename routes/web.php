<?php

use App\Http\Controllers\PlantController;
use App\Services\PlantIdService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/seed', function () {
    $raw = file_get_contents(storage_path() . "\app\public\plant_pathogen.txt");
    $datas = json_decode($raw, true);
    foreach ($datas["pathogen-list"] as $data) {
        $res = \App\Models\PlantPathogen::create([
            'peat_id' => $data["id"],
            'name' => $data["name"],
            'name_en' => $data["name_en"],
            'pathogen_class' => $data["pathogen_class"],
            'scientific_name' => $data["scientific_name"],
        ]);
    }
});

Route::prefix("plant")->group(function () {
    Route::get("", [PlantController::class, 'index']);
    Route::get("v2", [PlantController::class, 'index']);
    Route::post("upload", [PlantController::class, 'store']);
    Route::get("upload", [PlantController::class, 'show']);
    Route::post("detect", [PlantController::class, 'show']);
    Route::get("detect", [PlantController::class, 'edit']);
});

Route::get("test", function () {
//    $list = App\Models\PlantData::all();
//    $list = App\Models\PlantData::query()->where("scientific_name_with_author", "like", "Abutilon" . "%")->get();
    $list = App\Models\PlantData::query()->where("scientific_name_with_author", "like", "%" . "d'Urv" . "%")->get();
    foreach ($list as $key => $item) {
        $str = explode(" ", $item->scientific_name_with_author);
        $newStr = '';
        foreach ($str as $key1 => $item1) {
            if ($key1 == 0) {
                $newStr = $newStr . $item1;
                continue;
            }
//            if (preg_match("/^[a-z]/", $item1)) {
//                $newStr = $newStr . " ";
//                $newStr = $newStr . $item1;
//            } else {
//                break;
//            }

            if ($item1 != "d'Urv.") {
                $newStr = $newStr . " ";
                $newStr = $newStr . $item1;
            } else {
                break;
            }
        }
        $item->scientific_name_with_author = $newStr;
        $item->save();
    }
});

Route::get("test2", function () {
    \App\Models\PlantPathogen::create([
        'peat_id' => 99999,
        'name' => "Tiếng việt",
        'name_en' => "x",
        'pathogen_class' => "z",
        'scientific_name' => "x",
    ]);
});
