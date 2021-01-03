<?php

use Illuminate\Database\Seeder;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array_map('str_getcsv', file(base_path().'/database/seeds/csvs/provinces.csv'));
        foreach ($datas as $data) {
            Provinsi::create([
                'id' => $data[0],
                'nama' => $data[1]
            ]);
        }
    }
}
