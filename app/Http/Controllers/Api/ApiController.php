<?php

namespace App\Http\Controllers\Api;

use App\Models\Computador;
use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Actualiza la fecha de un computador recibiendo la identificación de la sala y la id del pc
     * @param  \Illuminate\Http\Request  $request
     * @return $fecha: Nueva fecha del computador
     */
    public function actualizarFechaComputador(Request $request)
    {
        $idsala = $request -> idsala;
        $idpc = $request -> idpc;
        $fecha = Carbon::now();
        DB::table('computadores')->where([
            ['sala_id', '=', $idsala],
            ['idComputador', '=', $idpc],
        ])->update(['last_connection' => $fecha, 'estado' => "Ocupado"]);

        return $fecha;
    }

    /**
     * Actualiza el estado de los computadores a partir de la diferencia en segundos de su última conexión
     * @return JSON: Lista en formato JSON con toda la información de los computadores
     */
    public function actualizarEstados()
    {
        $computadores = Computador::all();
        $fechaActual = Carbon::now();
        foreach ($computadores as $computador)
        {
            $fechaComputador = $computador -> last_connection;
            $diferencia = $fechaActual->diffInSeconds($fechaComputador);
            if($diferencia > 10)
            {
                $computador -> estado = "Disponible";
                $computador -> save();
            }
        }
        return Response::json($computadores, 200);
    }

    /**
     * Obtiene una lista con todos los computadores de una sala
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Lista en formato JSON con los computadores de una sala
     */
    public function obtenerComputadores(Request $request)
    {
        $idSala = $request -> idsala;
        $computadores = DB::table('computadores')->where([['sala_id', '=', $idSala]])->get();
        return Response::json($computadores, 200);
    }

    /**
     * Obtiene una lista con todos los computadores de una sala
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Lista en formato JSON con los computadores de una sala
     */
    public function obtenerSalas()
    {
        $salas = Sala::all();
        return Response::json($salas, 200);
    }
}
