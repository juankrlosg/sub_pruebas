@extends('layouts.fenix-app')
@section('content')
    <style>
        .contimg {
            width: 100%;
            height: 350px;
            overflow: hidden;
            /*margin: 10px;*/
            position: relative;
        }
        .contimg > .img {
            position:absolute;
            left: -100%;
            right: -100%;
            top: -120%;
            bottom: -100%;
            margin: auto;
            min-height: 100%;
            min-width: 100%;
        }
    </style>
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Solicitud de servicio <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item"><a href="{{route('planes')}}">Planes y paquetes</a></li>
                        <li class="breadcrumb-item active">Orden capturada</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Catura </strong> de orden</h2>
                        </div>
                        <div class="body">
                            <div class="mega-card">
                                    <div class="card xl-slategray">
                                        <div class="card-header text-center bg-danger">
                                            <h6 class="pb-0 mb-0 text-white">Datos de la orden capturada</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row clearfix">
                                                <div class="col-lg-7 col-md-6 col-sm-12">
                                                    <div class="card member-card">
                                                        <div class="p-4">
                                                            <h6 class="m-t-10">{{$orden->nombre}}</h6>
                                                        </div>

                                                        <div class="card-body pt-0 px-0 pull-right">
                                                            <div class="member-img float-left mt-2 ml-5">
                                                                <a href="#"><img src="{{URL::asset('assets/svg/'.$orden->imagen)}}" class="rounded-circle" alt="profile-image"></a>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-10 offset-1">
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted ">Instalación desdes</small>
                                                                        <h6>&dollar;800&ast;</h6>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted ">Costo: </small>
                                                                        <h6>&dollar;{{$orden->costo}} / mes</h6>
                                                                    </div>
                                                                    <hr class="mt-2 mx-3">
                                                                    <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-muted">Velocidad</span>
                                                                            <small class="text-muted">Carga/Descarga</small>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <h5 class="mb-0">{{$orden->up}}/{{$orden->down}} *</h5>
                                                                            <small class="text-muted text-right">(Mbps/Mbps)</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-between p-3 mt-0 mid">
                                                                        <div class="d-flex flex-column">
                                                                            <small class="text-muted mb-1">Descargas</small>
                                                                            <div class="d-flex flex-row">
                                                                                <div class="d-flex flex-column ml-1">
                                                                                    <h6 class="ml-1">ILIMITADAS</h6>
                                                                                    <small class="ghj">24/7</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <small class="text-muted mb-1">Ancho de banda</small>
                                                                            <div class="d-flex flex-row">
                                                                                <div class="d-flex flex-column ml-1">
                                                                                    <h6 class="ml-1"> ILIMITADO</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <small class="d-flex justify-content-center text-muted">*Aplican terminos y restricciones</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-6 col-sm-12">
                                                    <div class="card member-card" id="data-order">
                                                        <div class="p-4">
                                                            <h6 class="">Datos del solicitante</h6>
                                                        </div>
                                                        <div class="body">
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Solicitante: </small>
                                                                <strong class="text-right">{{$orden->nom}} {{$orden->ap}} {{$orden->am}}</strong>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Dirección: </small>
                                                                <strong class="text-right">{{$orden->nom_loc}}, {{$orden->nom_mun}}, {{$orden->nom_est}}</strong>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Referencia: </small>
                                                                <strong class="text-right">{{$orden->referencia}}</strong>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Teléfono: </small>
                                                                <strong class="text-right">{{$orden->telefono}}</strong>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Correo: </small>
                                                                <strong class="text-right">{{$orden->email}}</strong>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                <small class="text-muted ">Contraseña: </small>
                                                                <strong class="text-right">{{$orden->pass}}</strong>
                                                            </div>
                                                            <br>
                                                            <button class="btn btn-icon btn-round btn-danger float-right get-img"><i class="zmdi zmdi-download"></i></button>
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
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="{{asset('assets/js/dom-to-image.js')}}"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        swal({
            title: "Guardado",
            text: "Su orden ha sido capturada en el sistema",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        });
        $('.get-img').click(function () {
            var node = document.getElementById('data-order');

            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    window.location.href=img.src;
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                });
        })
    </script>
    <!--End of Tawk.to Script-->
@endsection
