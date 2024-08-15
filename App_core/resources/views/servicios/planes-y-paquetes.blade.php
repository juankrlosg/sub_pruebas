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
                    <h2>Contacto <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item active">Planes y paquetes</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Planes </strong> y paquetes</h2>
                        </div>
                        <div class="body">
                            <div class="mega-card">
                                <h5 class="text-center">Elije el plan que mas te convenga</h5>
                                @foreach($paquetes as $paquete)
                                    <div class="row">
                                        <div class="card xl-slategray">
                                            <div class="card-header text-center {{$paquete->color2}}">
                                                <h6 class="pb-0 mb-0">{{$paquete->descripcion}}</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row clearfix">
                                                    @foreach($paquete->planes as $plan)
                                                            {{--<div class="col-sm-4">
                                                                <div class="card">
                                                                    <img src="{{URL::asset('assets/svg/'.$plan->imagen)}}" class="card-img-top p-15" width="100%">
                                                                    <div class="card-body pt-0 px-0">
                                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                            <small class="text-muted mt-1">STARTING AT</small>
                                                                            <h6>&dollar;22,495&ast;</h6>
                                                                        </div>
                                                                        <hr class="mt-2 mx-3">
                                                                        <div class="d-flex flex-row justify-content-between px-3 pb-4">
                                                                            <div class="d-flex flex-column"><span class="text-muted">Fuel Efficiency</span><small class="text-muted">L/100KM&ast;</small></div>
                                                                            <div class="d-flex flex-column"><h5 class="mb-0">8.5/7.1</h5><small class="text-muted text-right">(city/Hwy)</small></div>
                                                                        </div>
                                                                        <div class="d-flex flex-row justify-content-between p-3 mid">
                                                                            <div class="d-flex flex-column"><small class="text-muted mb-1">ENGINE</small><div class="d-flex flex-row"><img src="https://imgur.com/iPtsG7I.png" width="35px" height="25px"><div class="d-flex flex-column ml-1"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div>
                                                                            <div class="d-flex flex-column"><small class="text-muted mb-2">HORSEPOWER</small><div class="d-flex flex-row"><img src="https://imgur.com/J11mEBq.png"><h6 class="ml-1">135 hp&ast;</h6></div></div>
                                                                        </div>
                                                                        <small class="text-muted key pl-3">Standard key Features</small>
                                                                        <div class="mx-3 mt-3 mb-2"><button type="button" class="btn btn-danger btn-block"><small>BUILD & PRICE</small></button></div>
                                                                        <small class="d-flex justify-content-center text-muted">*Legal Disclaimer</small>
                                                                    </div>
                                                                </div>
                                                            </div>--}}
                                                        <div class="col-lg-4 offset-lg-{{$loop->iteration==1?(12-(sizeof($paquete->planes)*4))/2:0}} col-md-6 col-sm-12">
                                                            <div class="card member-card">
                                                                <div class="header l-{{$paquete->color}}">
                                                                    <h4 class="m-t-10">{{$plan->nombre}}</h4>
                                                                </div>
                                                                <div class="member-img">
                                                                    <a href="#"><img src="{{URL::asset('assets/svg/'.$plan->imagen)}}" class="rounded-circle" alt="profile-image"></a>
                                                                </div>
                                                                <br>
                                                                <div class="card-body pt-0 px-0">
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted">Instalación desdes</small>
                                                                        <h6>&dollar;800&ast;</h6>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted ">Costo: </small>
                                                                        <h6>&dollar;{{$plan->costo}} / mes</h6>
                                                                    </div>
                                                                    <hr class="mt-2 mx-3">
                                                                    <div class="d-flex flex-row justify-content-between px-3 pb-4">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-muted">Velocidad</span>
                                                                            <small class="text-muted">Carga/Descarga</small>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <h5 class="mb-0">{{$plan->up}}/{{$plan->down}} *</h5>
                                                                            <small class="text-muted text-right">(Mbps/Mbps)</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-between p-3 mid">
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
                                                                    <div class="mx-3 mt-3 mb-2"><a href="{{url('/suscriptores/nuevo').'/'.$plan->id_servicio}}" class="btn btn-danger btn-block" data-id-pack="{{$plan->id_servicio}}"><small>LO QUIERO</small></a></div>
                                                                    <small class="d-flex justify-content-center text-muted">*Aplican terminos y restricciones</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
