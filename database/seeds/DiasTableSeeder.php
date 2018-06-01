<?php

use Illuminate\Database\Seeder;

class DiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dia = [
            0 => "Lunes",
            1 => "Martes",
            2 => "Miercoles",
            3 => "Jueves",
            4 => "Viernes",
            5 => "Sabado",
            6 => "Domingo"
        ];
        $cantidad = 7;
        for ($i = 0; $i < $cantidad; $i++) {
            DB::table('dias')->insert([
                'dia_semana' => $dia[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
