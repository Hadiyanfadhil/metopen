<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RajaOngkirService;

class RajaOngkirController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function getProvinces()
    {
        $provinces = $this->rajaOngkirService->getProvinces();
        return response()->json($provinces['rajaongkir']['results']);
    }

    public function getCities(Request $request)
    {
        $cities = $this->rajaOngkirService->getCities($request->province_id);
        return response()->json($cities['rajaongkir']['results']);
    }

    public function getSubdistricts(Request $request)
    {
        $subdistricts = $this->rajaOngkirService->getSubdistricts($request->city_id);
        return response()->json($subdistricts['rajaongkir']['results']);
    }
}
