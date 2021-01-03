<?php

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array_map('str_getcsv', file(base_path().'/database/seeds/csvs/districts.csv'));
        foreach ($datas as $data) {
            Kecamatan::create([
                'id' => $data[0],
                'id_kabupaten' => $data[1],
                'nama' => $data[2]
            ]);
        }
    }
}
