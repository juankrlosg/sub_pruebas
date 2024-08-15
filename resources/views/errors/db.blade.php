@extends('layouts.fenix-error')
@section('content')
    <div class="has-bg-img bg-purple bg-blend-multiply">
        <div class="carousel-caption bg-red" style="right: 0% !important; left: 0% !important; bottom: 10% !important;">
            <h1>Error crítico</h1>
            <span>No se ha podido establecer la conexión con la base de datos</span>
            <br>
            <a href="{{URL::current()}}" class="btn btn-warning btn-round" role="button"> Volver a cargar</a>
        </div>
        <img class="bg-img" src="{{URL::asset('assets/images/distorsion.jpg')}}" alt="...">
    </div>
@endsection