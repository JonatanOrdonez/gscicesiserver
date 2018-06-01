<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComputadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idComputadores = [
            0 => "LABINGSW01",
            1 => "LABINGSW02",
            2 => "LABINGSW03",
            3 => "LABINGSW04",
        ];
        $cantidad = 4;
        for ($i = 0; $i < $cantidad; $i++) {
            DB::table('computadores')->insert([
                'idComputador' => $idComputadores[$i],
                'sala_id' => 1,
                'estado' => 'Disponible',
                'last_connection' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
