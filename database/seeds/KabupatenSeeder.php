<?php

use Illuminate\Database\Seeder;
use App\Models\Kabupaten;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array_map('str_getcsv', file(base_path().'/database/seeds/csvs/regencies.csv'));
        foreach ($datas as $data) {
            Kabupaten::create([
                'id' => $data[0],
                'id_provinsi' => $data[1],
                'nama' => $data[2]
            ]);
        }
    }
}
