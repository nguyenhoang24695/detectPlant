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

//Route::get('/seed', function () {
//    $raw = file_get_contents(storage_path()."\app\public\plant_pathogen.txt");
//    $datas = json_decode($raw,true);
//    foreach ($datas["pathogen-list"] as $data){
//        $res = \App\Models\PlantPathogen::create([
//            'plant_id' => $data["id"],
//            'name' => $data["name"],
//            'name_en' => $data["name_en"],
//            'pathogen_class' => $data["pathogen_class"],
//            'scientific_name' => $data["scientific_name"],
//        ]);
//    }
//});

Route::prefix("plant")->group(function () {
    Route::get("", [PlantController::class, 'index']);
    Route::post("upload", [PlantController::class, 'store']);
    Route::get("upload", [PlantController::class, 'show']);
});
