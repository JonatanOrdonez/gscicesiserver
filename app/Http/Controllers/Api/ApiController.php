<?php

namespace App\Http\Controllers\Api;

use App\Models\Computador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualizarFechaComputador(Request $request)
    {
        $idsala = $request -> idsala;
        $idpc = $request -> idpc;
        $fecha = Carbon::now();
        DB::table('computadores')->where([
            ['sala_id', '=', $idsala],
            ['idComputador', '=', $idpc],
        ])->update(['last_connection' => $fecha, 'estado' => "no disponible"]);

        return $fecha;
    }

    public function actualizarEstados()
    {
        $computadores = Computador::all();
        $fechaActual = Carbon::now();
        foreach ($computadores as $computador)
        {
            $fechaComputador = $computador -> last_connection;
            $diferencia = $fechaActual->diffInSeconds($fechaComputador);
            if($diferencia > 25)
            {
                $computador -> estado = "disponible";
                $computador -> save();
            }
        }
        return Response::json($computadores, 200);
    }

    public function obtenerComputadores(Request $request)
    {
        $idSala = $request -> idsala;
        $computadores = DB::table('computadores')->where([['sala_id', '=', $idSala]])->get();
        return Response::json($computadores, 200);
    }
    
    public function getpcstotales()
    {
        $computadores=Computador::all();
        return Response::json($computadores, 200);
    }
}
