<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
        ]);

        DB::table('users')->insert([
            'name' => 'kepala',
            'email' => 'kepala@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'kepala',
        ]);
    }
}
