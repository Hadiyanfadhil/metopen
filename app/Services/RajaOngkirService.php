<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders(['key' => $this->apiKey])->get('https://api.rajaongkir.com/starter/province');
        return $response->json()['rajaongkir']['results'];
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders(['key' => $this->apiKey])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId
        ]);
        return $response->json()['rajaongkir']['results'];
    }

    public function getSubdistricts($cityId)
    {
        $response = Http::withHeaders(['key' => $this->apiKey])->get('https://api.rajaongkir.com/starter/subdistrict', [
            'city' => $cityId
        ]);
        return $response->json()['rajaongkir']['results'];
    }
}
