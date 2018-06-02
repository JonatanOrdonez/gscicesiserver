<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reserva');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sala' => 'required',
            'dia' => 'required',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'actividad' => 'required'
        ]);

        $sala = (int)($request -> sala);
        $dia = (int)($request -> dia);
        $fechainicio = $request -> fechainicio;
        $fechafin = $request -> fechafin;
        $actividad = $request -> actividad;

        $diasemana = DB::table('dias')->where([['id', '=', $dia]])->first()->dia_semana;
        $reserva = new Reserva();
        $reserva -> fecha_inicio = Carbon::createFromTimeString( $fechainicio );
        $reserva -> fecha_fin = Carbon::createFromTimeString( $fechafin );
        $reserva -> descripcion = $actividad;
        $reserva -> dia_semana = $diasemana;
        $reserva -> dia_id = $dia;
        $reserva -> sala_id = $sala;
        $reserva -> save();
        return view('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
