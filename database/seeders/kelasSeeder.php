<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // kelas X, XI, XII
        DB::table('kelas')->insert([
            'nama_kelas' => '1',
            'spp' => 170000
        ]);

        DB::table('kelas')->insert([
            'nama_kelas' => '2',
            'spp' => 150000
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => '3',
            'spp' => 120000
        ]);
    }
}
