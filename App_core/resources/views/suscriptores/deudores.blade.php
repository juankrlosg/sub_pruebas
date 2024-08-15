@extends('layouts.fenix-app')
@section('content')
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Deudores <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                    <li class="breadcrumb-item active">Deudores</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Detalles</strong> de los deudores</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>IP</th>
                                    <th>Plan contratado</th>
                                    <th>Fecha de pago</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($con_retraso as $deudor)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$deudor->nombre}}</td>
                                        <td>{{$deudor->ap}}</td>
                                        <td>{{$deudor->am}}</td>
                                        <td>{{$deudor->IP}}</td>
                                        <td>{{$deudor->descripcion}}</td>
                                        <td>{{\Carbon\Carbon::parse($deudor->fecha)->format('d-m').'-'.\Carbon\Carbon::now()->format('Y')}} / {{\Carbon\Carbon::now()->format('d')-\Carbon\Carbon::parse($deudor->fecha)->format('d')}} días</td>
                                        <td>
                                            <div class="row clearfix">
                                                <div class="col-lg-4">
                                                    <a href="{{route('detalle_deudor',$deudor->id_servicio_usuario)}}" class="zmdi zmdi-eye text-info"></a>
                                                </div>
                                                <div class="col-lg-4">
                                                    <a href="#" class="zmdi zmdi-check text-success"></a>
                                                </div>
                                                <div class="col-lg-4">
                                                    <a href="#" class="zmdi zmdi-block text-danger"></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Scripts -->
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/datatablescripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/tables/jquery-datatable.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/59f5afbbbb0c3f433d4c5c4c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
@endsection
