<?php

namespace Database\Seeders;

use App\Models\RefSatker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefSatkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefSatker::truncate();

        $json = File::get(base_path().'/database/json/ref_satker.json');
        $data = json_decode($json, false)->RECORDS;

        foreach ($data as $r) {
            RefSatker::create([
                'kode_satker' => $r->kode,
                'nama_satker' => $r->nama,
                'no_nota_debet' => '00001',
                'no_nota_kredit' => '00001',
            ]);
        }
    }
}
