@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='{{ url("/reservas") }}'">Registrar reserva</button></p>
                        <p class="text-center"><a type="button" class="btn btn-primary" href="https://gscicesiview.herokuapp.com/">Ver información de salas</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
