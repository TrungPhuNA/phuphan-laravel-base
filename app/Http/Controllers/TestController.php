<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view("test.index");
    }

    public function getCountriesGeoJSON()
    {
        // Danh sách các quốc gia
        $countries = ["Vietnam", "Laos", "Cambodia", "Thailand", "Myanmar"];
        $geojson = [];

        foreach ($countries as $country) {
            $geojson[] = [
                "name" => $country,
                "color" => "red", // Bạn có thể thay đổi màu
                "geojson" => $this->getCountryGeoJSONByCountry($country)
            ];
        }


        return response()->json($geojson);
    }

    public function getCountryGeoJSONByCountry($country) {
        $url = "https://nominatim.openstreetmap.org/search.php?country=" . urlencode($country) . "&format=jsonv2&polygon_geojson=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: MyGeoApp/1.0 (phupt.humg.94@email.com)" // Đổi email thành email của bạn để tránh bị chặn
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!empty($data) && isset($data[0]['geojson'])) {
            return $data[0]['geojson'];
        }

        return null;
    }
}
