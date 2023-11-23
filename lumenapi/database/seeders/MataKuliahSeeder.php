<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matakuliahs')->insert([
            'nama' => 'Pemrograman Dasar',
        ]);

        DB::table('matakuliahs')->insert([
            'nama' => 'Pemrograman Lanjut',
        ]);

        DB::table('matakuliahs')->insert([
            'nama' => 'Algoritma dan Struktur Data',
        ]);

        DB::table('matakuliahs')->insert([
            'nama' => 'Sistem Basis Data',
        ]);
        
        DB::table('matakuliahs')->insert([
            'nama' => 'Jaringan Komputer Dasar',
        ]);
    }
}