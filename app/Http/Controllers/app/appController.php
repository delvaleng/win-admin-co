<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\TpBanco;

class appController extends Controller
{

  function viewPay()
  {
    return view('external.app.infoRecarga');
  }

  function getBanck()
  {
    $b = TpBanco::all();
    return response()->json([
      'object'  => "success",
      'data'    => $b
    ]);
  }

  function getDriverPeru()
  {

    $data               =  array(
                  "query" => request()->id_conductor,
        );
  $string             = json_encode($data);

    $ch = curl_init('https://test.conductores.wintecnologies.com/api/Drivers/getDriver');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'token: sgiII01cK589ysQUv9FP4GY7qPZA42Cq7439Aj9nSEDhWVrRyeKv7eC3NhCt')
        );
    $cQ = curl_exec($ch);
$p  = json_decode($cQ);
    return response()->json($p);
  }

}
