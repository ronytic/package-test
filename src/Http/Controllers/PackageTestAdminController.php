<?php

namespace ProcessMaker\Package\PackageTest\Http\Controllers;

use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Http\Resources\ApiCollection;
use ProcessMaker\Package\PackageTest\Models\Sample;
use RBAC;
use Illuminate\Http\Request;
use URL;


class PackageTestAdminController extends Controller
{
    public function index()
    {
        return view('package-test::index-admin');
    }


    public function searchCountries(Request $request)
    {
        try {

            $region = $request->input('region', '');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.first.org/data/v1/countries?region=' . $region,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            if ($response === false) {
                throw new \Exception('Error Processing Request', 1);
            }
            $response = json_decode($response);

            $dataResponse = [
                "status" => "success",
                'data' => $response->data,
                "message" => ""
            ];
            // Return the response in json format
            return response()->json($dataResponse);
        } catch (\Exception $e) {
            $dataResponse = [
                "status" => "error",
                'message' => $e->getMessage()
            ];
            return response()->json($dataResponse);
        }
    }

    public function store(Request $request)
    {
        $country = $request->input('country', '');
        $region = $request->input('region', '');
        $countryId = $request->input('country_id', '');
    }
}
