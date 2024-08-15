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
                        <li class="breadcrumb-item active">Contacto</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Página </strong> de contacto</h2>
                        </div>
                        <div class="body">
                            <div class="mega-card">
                                <div class="contimg">
                                    <img class="img" src="{{URL::asset('assets/images/f26.jpg')}}" alt="">
                                </div>
                                <h6 class="text-center mt-3 mb-0">Fenix Networks</h6>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <h6 class="text-center m-3">Contacto</h6>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p><i class="zmdi zmdi-phone"> Teléfono:</i> </p>
                                                <span>7225547216</span>
                                            </div>
                                            <div class="col-lg-3">
                                                <p><i class="zmdi zmdi-whatsapp"> WhatsApp:</i></p>
                                                <span>7225547216</span>
                                                <br>
                                                <span>7228352010</span>
                                                <br>
                                                <span>7223038577</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <p><i class="zmdi zmdi-email"> Email:</i></p>
                                                <span>soporte.fenixnetworks@gmail.com</span>
                                                <br>
                                                <span>contacto@fenix-networks.com.mx</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <h6 class="text-center m-3">¿Tienes alguna duda?</h6>
                                        <p>Dejanos tus datos y nosotros te contactamos</p>
                                        <form action="#" class="">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Nombre completo">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-smartphone"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Teléfono">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Email">
                                            </div>
                                            <textarea class="form-control border rounded" placeholder="Escribe tu mensaje" rows="3"></textarea>
                                            <button class="btn btn-round btn-success float-right" type="button">Enviar</button>
                                        </form>
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
