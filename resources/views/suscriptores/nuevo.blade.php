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
                            <h2><strong>Precontrato </strong> de servicio</h2>
                        </div>
                        <div class="body">
                            <div class="mega-card">
                                @foreach($paquete as $pack)
                                    <div class="row">
                                        <div class="card xl-slategray">
                                            <div class="card-header text-center {{$pack->color2}}">
                                                <button class="btn btn-danger btn-icon btn-icon-mini btn-round float-left" data-toggle="modal" data-target="#largeModal"><i class="zmdi zmdi-settings"></i></button>
                                                <h6 class="pb-0 mb-0">{{$pack->descripcion}}</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="card member-card">
                                                                <div class="header l-{{$pack->color}}">
                                                                    <h4 class="m-t-10">{{$pack->nombre}}</h4>
                                                                </div>
                                                                <div class="member-img">
                                                                    <a href="#"><img src="{{URL::asset('assets/svg/'.$pack->imagen)}}" class="rounded-circle" alt="profile-image"></a>
                                                                </div>
                                                                <br>
                                                                <div class="card-body pt-0 px-0">
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted ">Instalación desdes</small>
                                                                        <h6>&dollar;800&ast;</h6>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                        <small class="text-muted ">Costo: </small>
                                                                        <h6>&dollar;{{$pack->costo}} / mes</h6>
                                                                    </div>
                                                                    <hr class="mt-2 mx-3">
                                                                    <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-muted">Velocidad</span>
                                                                            <small class="text-muted">Carga/Descarga</small>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <h5 class="mb-0">{{$pack->up}}/{{$pack->down}} *</h5>
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
                                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h2><strong>Datos </strong> de quien solicita</h2>
                                                            </div>
                                                            <div class="body">
                                                                <form method="POST" action="{{ url('/suscriptores')  }} " >
                                                                    @csrf
                                                                    <div id="test-l-1" class="content">
                                                                        <div class="row">
                                                                            <input type="text" hidden name="id_servicio" value="{{$pack->id_servicio}}">
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Nombre(s)">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-account-circle"></i>
                                                                                    </span>
                                                                                    @error('name')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <input id="app" type="app" class="form-control @error('app') is-invalid @enderror" name="app" value="{{ old('app') }}" autocomplete="app" placeholder="Apellido Paterno">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-account-circle"></i>
                                                                                    </span>
                                                                                    @error('app')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <input id="apm" type="apm" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm') }}" autocomplete="apm" placeholder="Apellido Materno">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-account-circle"></i>
                                                                                    </span>
                                                                                    @error('apm')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <select id="estado" class="form-control show-tick" tabindex="-98">
                                                                                        <option value="" selected>- Estado -</option>
                                                                                        @foreach($estados as $estado)
                                                                                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <select id="municipio" class="form-control show-tick" tabindex="-98">
                                                                                        <option value="">- Municipio -</option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <select id="localidad" class="form-control show-tick @error('localidad') is-invalid @enderror" tabindex="-98" id="localidad" name="localidad" value="{{ old('localidad') }}" required autocomplete="localidad" >
                                                                                        <option value="">- Localidad -</option>

                                                                                    </select>
                                                                                    @error('localidad')
                                                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <div class="input-group">
                                                                                    <input id="referencia" type="referencia" class="form-control @error('referencia') is-invalid @enderror" name="referencia" value="{{ old('referencia') }}" required autocomplete="referencia" placeholder="Referencia del domicilio">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-assignment-o"></i>
                                                                                    </span>
                                                                                    @error('referencia')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="input-group">
                                                                                    <input id="telefono" type="telefono" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" placeholder="Telefono">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-smartphone-android"></i>
                                                                                    </span>
                                                                                    @error('telefono')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="input-group">
                                                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Correo electrónico">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="zmdi zmdi-email"></i>
                                                                                    </span>
                                                                                    @error('email')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-info btn-round row col-12">Enviar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Cambiar paquete</h4>
                </div>
                <div class="modal-body">
                    @foreach($paquetes as $paquete)
                        <div class="card border">
                            <div class="header">
                                <h2><strong>{{$paquete->descripcion}}</strong></h2>
                            </div>
                            <div class="body widget popular-post">
                                <ul class="list-unstyled m-b-0 row justify-content-center">
                                    @foreach($paquete->planes as $plan)
                                        <div class="card btn text-left text-dark xl-slategray col-5 m-1 btn-nuevo-paquete" data-url="{{url('/suscriptores/nuevo')}}/{{$plan->id_servicio}}">
                                            <li class="row mt-3">
                                                <div class="icon-box col-4">
                                                    <img class="img-fluid img-thumbnail" src="{{asset('assets/svg/'.$plan->imagen)}}" alt="Awesome Image">
                                                </div>
                                                <div class="text-box col-8 p-l-0">
                                                    <h5 class="m-b-0"><a href="#">{{$plan->nombre}}</a></h5>
                                                    <small class="author-name">Velocidad: <a href="#">{{$plan->up}}Mbps <i class="zmdi zmdi-upload"></i> / {{$plan->down}}Mbps <i class="zmdi zmdi-download"></i></a></small>
                                                    <p>$ {{$plan->costo}}.00<small class="date"> al mes</small>
                                                        <br>
                                                    <small class="date">Descargas </small><strong>ILIMITADAS</strong></p>
                                                </div>
                                            </li>
                                        </div>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        $('#estado').on('change',function () {
            estado=$(this).val();
            var opc_municipios="<option value='' selected>- Municipio - </option>";
            $.get("{{url('/servicios/get_municipios')}}/"+estado,function (result) {
                $.each(result, function (i, item) {
                    opc_municipios+="<option value='"+item.id+"'>"+item.nombre+"</option>";
                });
                $('#municipio').html(opc_municipios);
                $('#municipio').selectpicker("refresh");
            });
        })

        $('#municipio').on('change',function () {
            municipio=$(this).val();
            var opc_localidades="<option value='' selected>- Localidad - </option>";
            $.get("{{url('/servicios/get_localidades')}}/"+municipio,function (result) {
                $.each(result, function (i, item) {
                    opc_localidades+="<option value='"+item.id+"'>"+item.nombre+"</option>";
                });
                $('#localidad').html(opc_localidades);
                $('#localidad').selectpicker("refresh");
            });
        })

        $('.btn-nuevo-paquete').click(function () {
            var url=$(this).data('url');
            swal({
                title: "¿Está seguro?",
                text: "Se cambiará el paquete actual por el seleccionado",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, estoy seguro!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function () {
                location.href=url;
            });
        });
    </script>
    <!--End of Tawk.to Script-->
@endsection
