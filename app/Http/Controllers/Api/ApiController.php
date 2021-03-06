<?php

namespace App\Http\Controllers\Api;

use App\Models\Computador;
use App\Models\Dia;
use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Integer;

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
            if($diferencia > 5)
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
     * @return JSON: Lista en formato JSON con los computadores de una sala
     */
    public function obtenerSalas()
    {
        $salas = Sala::all();
        return Response::json($salas, 200);
    }

    /**
     * Obtiene una lista con todos los días de la semana
     * @return JSON: Lista en formato JSON con los computadores de una sala
     */
    public function obtenerDias()
    {
        $dias = Dia::all();
        return Response::json($dias, 200);
    }

    /**
     * Guarda una reserva en la base de datos y retorna una lista de reservas de la sala
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Lista en formato JSON con las reservas de la sala
     */
    public function agregarReserva(Request $request)
    {
        $reserva = new Reserva();
        $reserva -> fecha_inicio = Carbon::createFromTimeString( $request -> fecha_inicio );
        $reserva -> fecha_fin = Carbon::createFromTimeString( $request -> fecha_fin );
        $reserva -> descripcion = $request -> descripcion;
        $reserva -> dia_semana = DB::table('dias')->where([['id', '=', $reserva -> dia_id]])->first()->dia_semana;
        $reserva -> dia_id = $request -> dia_id;
        $reserva -> sala_id = $request -> sala_id;
        $reserva -> save();

        $reservas = DB::table('reservas')->where([
            ['sala_id', '=', $request -> sala_id]])->get();
        return Response::json($reservas, 200);
    }

    /**
     * Obtiene la lista de reservas de una sala
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Lista en formato JSON con las reservas de la sala
     */
    public function obtenerReservasPorSala(Request $request)
    {
        $idSala = $request -> idsala;
        $reservas = DB::table('reservas')->where([
            ['sala_id', '=', $idSala]])->get();
        return Response::json($reservas, 200);
    }

    /**
     * Obtiene un día de la semana por su id
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Día de la semana en formato JSON
     */
    public function obtenerDiaSemana(Request $request)
    {
        $dia = DB::table('dias')->where([
            ['id', '=', $request -> id]])->first();
        return Response::json($dia, 200);
    }

    /**
     * Calcula la disponibilidad de una sala a partir de sus reservas
     */
    public function calcularDisponibilidadSalas()
    {
        $salas = Sala::all();
        foreach ($salas as $sala)
        {
            $idSala = $sala -> idSala;
            $reservas = DB::table('reservas')->where([
                ['sala_id', '=', $idSala]])->get();
            $cambio = 0;
            foreach ($reservas as $reserva)
            {
                $fechaActual = Carbon::now();
                $fechaInicio = $reserva -> fecha_inicio;
                $fechaFin = $reserva -> fecha_fin;
                $difMin = $fechaActual -> diffInSeconds($fechaInicio);
                $difMax = $fechaActual -> diffInSeconds($fechaFin);
                if ($difMin > 0 && $difMax < 0)
                {
                    $cambio = 1;
                }
            }
            if ($cambio == 1)
            {
                $sala -> estado = "Ocupada";
                $sala -> save();
            }
            else
            {
                $sala -> estado = "Disponible";
                $sala -> save();
            }
        }
    }

    /**
     * Obtiene la lista de reservas a partir de un día y la sala
     * @param  \Illuminate\Http\Request  $request
     * @return JSON: Reservas de una sala en un día determinado en formato JSON
     */
    public function obtenerReservasPorSalaDia(Request $request)
    {
        $idSala = $request -> idSala;
        $idDia = $request -> idDia;
        $reservas = DB::table('reservas')->where([
            ['sala_id', '=', $idSala],
            ['dia_id', '=', $idDia],
        ])->get();
        return Response::json($reservas, 200);
    }
}
