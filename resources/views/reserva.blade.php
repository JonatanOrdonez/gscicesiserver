@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar reserva</div>
                    <div class="card-body">
                        {{ Form::open(['route'=>'reservas.store', 'method'=>'POST']) }}
                        <div class="form-group row">
                            {!! Form::label('labsala', "Seleccione una sala",  array('class' => 'col-md-4 col-form-label text-md-right')) !!}
                            <div class="col-md-6">
                                {!!  Form::select('sala', ['1' => 'Laboratiorio de Ingeniería y Arquitectura de Software'],  '1', ['class' => 'form-control' ]) !!}

                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('labdia', "Seleccione una día",  array('class' => 'col-md-4 col-form-label text-md-right')) !!}
                            <div class="col-md-6">
                                {!!  Form::select('dia', ['1' => 'Lunes', '2' => 'Martes', '3' => 'Miercoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sabado', '7' => 'Domingo'],  '1', ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('labfechai', "Seleccione fecha de inicio YYYY-MM-DD hh:mm:ss",  array('class' => 'col-md-4 col-form-label text-md-right')) !!}
                            <div class="col-md-6">
                                {!! Form::text('fechainicio', null, ['class'=>'form-control', 'placeholder'=>'Ingrese la fecha de inicio']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('labfechaf', "Seleccione fecha finalización YYYY-MM-DD hh:mm:ss",  array('class' => 'col-md-4 col-form-label text-md-right')) !!}
                            <div class="col-md-6">
                                {!! Form::text('fechafin', null, ['class'=>'form-control', 'placeholder'=>'Ingrese la fecha de finalización']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('labactividad', "Seleccione una actividad",  array('class' => 'col-md-4 col-form-label text-md-right')) !!}
                            <div class="col-md-6">
                                {!! Form::text('actividad', null, ['class'=>'form-control', 'placeholder'=>'Ingrese la actividad que se va a realizar en la sala']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        {{ Form::close() }}
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection