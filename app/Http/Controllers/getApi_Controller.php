<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getApi_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->origin && $request->destination && $request->berat && $request->kurir) {
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->berat;
            $courier = $request->kurir;

            $response = Http::asForm()->withHeaders([
                'key' => '51c889239850d47f7909895e5a982cdb',
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ]);

            $kurir = $response['rajaongkir']['results'][0];
            $cek_ongkir = $response['rajaongkir']['results'][0]['costs'];

        } else {
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
            $cek_ongkir = null;
            $kurir = null;

        }

        $provinsi = Province::all();
        return view('cekOngkir', ['provinsi' => $provinsi, 'cek_ongkir' => $cek_ongkir, 'kurir' => $kurir]);
    }

    public function ajax($id)
    {
        $cities = City::where('province_id', $id)->pluck('city_name', 'id');

        return json_encode($cities);
    }
}
