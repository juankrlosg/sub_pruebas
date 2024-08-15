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
                        <li class="breadcrumb-item active"><a href="{{route('deudores')}}">Deudores</a></li>
                        <li class="breadcrumb-item active">Detalle del deudor</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card mt-0 pt-0">
                        <div class="header">
                            <h2><strong>Detalles</strong> del deudor</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 offset-1">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 mb-2"><strong>Nombre: </strong>{{$deudor->nombre.' '.$deudor->ap.' '.$deudor->am}}</div>
                                        <div class="col-lg-12 mb-2"><strong>Teléfono: </strong>{{$deudor->telefono}}</div>
                                        <div class="col-lg-12 mb-2"><strong>Direccion: </strong>Aquí va la dirección</div>
                                        <div class="col-lg-12 mb-2"><strong>IP: </strong>{{$deudor->IP}}</div>
                                        <div class="col-lg-12 mb-2"><strong>Servicio contratado: </strong>Paquete {{$deudor->descripcion}}</div>
                                        <div class="col-lg-12 mb-2"><strong>Su pago: </strong>${{$deudor->costo}}.00</div>
                                        <div class="col-lg-12 mb-2"><strong>Fecha de contratación: </strong>{{$deudor->fecha}}</div>
                                        <div class="col-lg-12 mb-2"><strong>Estatus: </strong><span class="{{$deudor->estatus=="Activo"?'badge badge-success':'badge badge-danger'}}">{{$deudor->estatus}}</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="body pt-0">
                                            <div class="row">
                                                <div class="l-slategray text-center col-lg-12 pt-3 pb-3 rounded-top">
                                                    <h3 class="mt-0 mb-0">Calendario de pagos</h3>
                                                    <span class="l-amber pt-2 pb-2 pr-3 pl-3 rounded-pill">{{\Carbon\Carbon::now()->format('Y')}}</span>
                                                </div>
                                            </div>
                                            <div class="row clearfix text-center">
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Enero
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[0]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} text-success':'zmdi-assignment-alert text-danger'}}':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Febrero
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[1]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Marzo
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[2]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Abril
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[3]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix text-center ">
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Mayo
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[4]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Junio
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[5]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Julio
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[6]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Agosto
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[7]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix text-center rounded-bottom">
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Septiembre
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[8]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Octubre
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[9]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Noviembre
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[10]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3 border pt-4 pb-4 bg-blue-grey">Diciembre
                                                    <div class="alert-icon">
                                                        <i class="zmdi {{$estatus_pago[11]==1?'zmdi-assignment-check text-success':'zmdi-assignment-alert text-danger'}} zmdi-hc-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
