@extends('layouts.fenix-error')
@section('content')
    <div class="has-bg-img bg-purple bg-blend-multiply">
        <div class="carousel-caption bg-red" style="right: 0% !important; left: 0% !important; bottom: 10% !important;">
            <h1>Error 404</h1>
            <span>No se ha encontrado la página</span>
            <br>
            <a href="{{URL::previous()}}" class="btn btn-warning btn-round" role="button"> Volver</a>
            <a href="{{url('/inicio')}}" class="btn btn-warning btn-round" role="button"> Inicio</a>
        </div>
        <img class="bg-img" src="{{URL::asset('assets/images/distorsion.jpg')}}" alt="Error">
    </div>
@endsection