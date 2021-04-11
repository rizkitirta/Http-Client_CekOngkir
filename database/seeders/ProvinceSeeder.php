<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '51c889239850d47f7909895e5a982cdb',
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        foreach($provinces as $province) {
            $data_province[] = [
                'id' => $province['province_id'],
                'province' => $province['province']
            ];
        }

        Province::insert($data_province);

    }
}
