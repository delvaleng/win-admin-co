<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Country;
use App\Models\DriverSaldo;

class ConexionCondController extends Controller
{

    public function __construct()            {
      $this->peru = config('enlace_svc.peru');
    }

    public function searchConductor()        {



      $query = request()->llave;
      $pais  = request()->pais;
      $driver;
      $data;

      if ($pais == 'PERU'){
        $data = $this->getConductorPeru($query);
      }


      return response()->json([
        'object'  => $data->object,
        'message' => $data->message,
        'data'    => ($data->object == 'success') ? $data->data : null
      ]);
    }

    public function getConductorPeru($query) {

      $id_country_local;

      $data  =  array("query" => $query);
      $data  = json_encode($data);


      $ch = curl_init(  $this->peru.'/api/Drivers/getDriver' );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true  );
            curl_setopt($ch, CURLOPT_POSTFIELDS,     $data );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'token: sgiII01cK589ysQUv9FP4GY7qPZA42Cq7439Aj9nSEDhWVrRyeKv7eC3NhCt'
              )
      );

      $result  = curl_exec($ch);
      $myArray = json_decode($result);


      if ($myArray->object == 'success'){
        $id_enlace        = $myArray->data->id_enlace;
        $driverId         = $myArray->data->driver_id;
        $codigo_oficina   = $myArray->data->id_office_driver;
        $usuario_oficina  = 'sorayi'; //$myArray->data->username;
        $country          = $myArray->data->country;

        $id_country_local = Country::where('country', mb_strtoupper($country))->first()->id;

        $driverSaldo      = DriverSaldo::where('id_country', $id_country_local)
        ->where('id_enlace_conductor',$id_enlace)
        ->where('id_enlace_app',      $driverId)
        ->where('codigo_oficina',     $codigo_oficina)
        ->first();

        if ($driverSaldo){

          $myArray->data->saldo_actual    = number_format( $driverSaldo->saldo_actual, 2) ;
          $myArray->data->id_driver_saldo = $driverSaldo->id;
          $myArray->data->simbolo_moneda  = $driverSaldo->getCountry->simbolo_local;
          $myArray->data->username  = $usuario_oficina;


        }
        else{
          $dataInsert =[
            'id_country'           => $id_country_local,
            'id_enlace_conductor'  => $id_enlace,
            'id_enlace_app'        => $driverId,
            'codigo_oficina'       => $codigo_oficina,
            'usuario_oficina'      => $usuario_oficina,
            'saldo_actual'         => 0,
          ];
          $id_driver_saldo = DriverSaldo::create($dataInsert)->id;
          $driverSaldo     = DriverSaldo::find($id_driver_saldo);

          $myArray->data->saldo_actual    = number_format( $driverSaldo->saldo_actual, 2) ;
          $myArray->data->id_driver_saldo = $driverSaldo->id;
          $myArray->data->simbolo_moneda  = $driverSaldo->getCountry->simbolo_local;
          $myArray->data->username  = $usuario_oficina;

        }



      }
      return $myArray;

    }

    public  function searchConductorNames() {
      $id_enlace = request()->id_enlace;
      $pais      = request()->pais;
      $driver;
      $data;

      if ($pais == 'PERU'){
        $data = $this->getConductorPeruNames($id_enlace);
      }


      return response()->json([
        'object'  => $data->object,
        'message' => $data->message,
        'data'    => ($data->object == 'success') ? $data->data : null
      ]);
    }

    public function getConductorPeruNames($id_enlace){

      $id_country_local;

      $data  =  array("id_enlace" => $id_enlace);
      $data  = json_encode($data);

      $ch = curl_init(  $this->peru.'/api/Drivers/driver_get' );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true  );
            curl_setopt($ch, CURLOPT_POSTFIELDS,     $data );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'token: sgiII01cK589ysQUv9FP4GY7qPZA42Cq7439Aj9nSEDhWVrRyeKv7eC3NhCt'
              )
      );

      $result  = curl_exec($ch);
      $myArray = json_decode($result);
      return $myArray;

    }

}
