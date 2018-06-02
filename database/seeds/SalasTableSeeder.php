<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([
            'nombre' => 'Laboratiorio de Ingeniería y Arquitectura de Software (Uno)',
            'idSala' => 'lias001',
            'estado' => 'Disponible',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('salas')->insert([
            'nombre' => 'Laboratiorio de Ingeniería y Arquitectura de Software (Dos)',
            'idSala' => 'lias002',
            'estado' => 'Disponible',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
