@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar reserva</div>
                    <div class="card-body">
                        <p>Reserva creada con exito</p>
                        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("home") }}'">Regresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection