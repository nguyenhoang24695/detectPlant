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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show(Request $request)
    {
        $image = $request->file('picture');
        $sha = sha1_file($image);
        dd($sha);
        session(["image_name" => $image->getClientOriginalName()]);

        //Dữ liệu trả về từ Plantix service
        $plantix_data = PlantixServices::ImageAnalysis($image);

        //Dữ liệu trả về từ plantId
        $plantId_data = PlantIdService::SendRequest($plantix_data["image_url"]);

        $plantix_data["image_url"] = str_replace($p, "", $plantix_data["image_url"]);
//        session(['$plantId_data' => $plantId_data]);
        session(['$plantix_data' => $plantix_data]);
//        return view("plant.result", ['plantix_data' => $plantix_data], ['plantId_data' => $plantId_data]);
        return view("plant.result", ['plantix_data' => $plantix_data]);
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
