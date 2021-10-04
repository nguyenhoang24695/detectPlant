<?php

namespace App\Http\Controllers;

use App\Models\PlantData;
use App\Services\PlantIdService;
use App\Services\PlantixServices;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(Request $request)
    {
        $image = $request->file('picture');
        $plantix_data = PlantixServices::SendRequest($image);
//        if ($data["plant_net"][0]["name"] == "ORNAMENTAL") {
        $plantId_data = PlantIdService::SendRequest($plantix_data);
//        }
        return view("plant.list", ['plantix_data' => $plantix_data], ['plantId_data' => $plantId_data]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $image = $request->file('picture');
        if (session('image_name') != null && session('image_name') == $image->getClientOriginalName() && session('$plantix_data') !== null) {
            $result = session('$plantId_data');
            foreach ($result as $key => $item) {
                $plant_data = PlantData::query()
                    ->where('scientific_name_with_author','like',$item["plant_details"]["scientific_name"].'%')
                    ->where('common_name','!=',"")
                    ->first();
                if (isset($plant_data)){
                    $plant_data = $plant_data->toArray();
                    $result[$key]["plant_details"]["global_name"] = $plant_data["common_name"];
                }
            }
            return view("plant.result", ['plantix_data' => session('$plantix_data')], ['plantId_data' => $result]);
        }
        session(["image_name" => $image->getClientOriginalName()]);
        $plantix_data = PlantixServices::SendRequest($image);
//        if ($data["plant_net"][0]["name"] == "ORNAMENTAL") {
        $p = public_path();
        $plantId_data = PlantIdService::SendRequest($plantix_data);
//        }
        $plantix_data["image_url"] = str_replace($p, "", $plantix_data["image_url"]);
        session(['$plantId_data' => $plantId_data]);
        session(['$plantix_data' => $plantix_data]);
        return view("plant.result", ['plantix_data' => $plantix_data], ['plantId_data' => $plantId_data]);
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
     * @param \Illuminate\Http\Request $request
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
