<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('prodis')->insert([
            'nama' => 'Teknologi Informasi',
        ]);

        DB::table('prodis')->insert([
            'nama' => 'Sistem Informasi',
        ]);

        DB::table('prodis')->insert([
            'nama' => 'Pendidikan Teknologi Informasi',
        ]);

        DB::table('prodis')->insert([
            'nama' => 'Teknik Informatika',
        ]);

        DB::table('prodis')->insert([
            'nama' => 'Teknik Komputer',
        ]);
    }
}
