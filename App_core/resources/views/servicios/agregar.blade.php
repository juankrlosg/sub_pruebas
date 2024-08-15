@extends('layouts.fenix-app')
@section('content')
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Inicio <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item active"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item active">Agregar Servicio</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Agregar</strong> nuevo servicio</h2>
                        </div>
                        <div class="body">
                            <div id="stepper1" class="bs-stepper">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#test-l-1">
                                        <button type="button" class="btn step-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label text-white">Dato<br>personales</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#test-l-2">
                                        <button type="button" class="btn step-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label text-white">Datos del<br>servicio</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#test-l-3">
                                        <button type="button" class="btn step-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label text-white">Datos<br>especificos</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <form method="POST" action="{{ url('/servicios')  }} " >
                                        @csrf
                                        <div id="test-l-1" class="content">
                                            <div class="row">
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
                                                        <input id="telefono" type="telefono" class="form-control @error('telefono') is-invalid @enderror" telefono="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" placeholder="Telefono">
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
                                            <button type="button" class="btn btn-warning btn-round" onclick="stepper1.next()">Siguiente</button>
                                        </div>
                                        <div id="test-l-2" class="content">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <input id="fecha" type="text" onfocus="(this.type='date')" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha"  placeholder="Fecha de contratación">
                                                        {{--<span class="input-group-addon">
                                                        <i class="zmdi zmdi-account-circle"></i>
                                                    </span>--}}
                                                        @error('fecha')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio') }}" required autocomplete="folio"  placeholder="Folio del contrato">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-tag"></i>
                                                </span>
                                                        @error('folio')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <select class="form-control show-tick @error('paquete') is-invalid @enderror" tabindex="-98" id="paquete" name="paquete" value="{{ old('paquete') }}" required autocomplete="paquete" >
                                                            <option value="">- Paquete contratado -</option>

                                                        </select>
                                                        @error('paquete')
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
                                                        <input id="coordenada" type="text" class="form-control @error('coordenada') is-invalid @enderror" name="coordenada" value="{{ old('coordenada') }}" required autocomplete="coordenada" placeholder="Coordenada del domicilio">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-pin-drop"></i>
                                                </span>
                                                        @error('coordenada')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <input id="router" type="text" class="form-control @error('router') is-invalid @enderror" name="router" value="{{ old('router') }}" required autocomplete="router" placeholder="ID del router">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-router"></i>
                                                </span>
                                                        @error('router')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <input id="senal" type="text" class="form-control @error('senal') is-invalid @enderror" name="senal" value="{{ old('senal') }}" required autocomplete="senal" placeholder="Intensidad de la señal">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-wifi-info"></i>
                                                </span>
                                                        @error('senal')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-round" onclick="stepper1.previous()">Anterior</button>
                                            <button type="button" class="btn btn-warning btn-round" onclick="stepper1.next()">Siguiente</button>
                                        </div>
                                        <div id="test-l-3" class="content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico">
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
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-key"></i>
                                                </span>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                                                        <span class="input-group-addon">
                                                    <i class="zmdi zmdi-key"></i>
                                                </span>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-round" onclick="stepper1.previous()">Anterior</button>
                                            <button type="button" class="btn btn-info btn-round" onclick="stepper1.submit()">Guardar</button>
                                        </div>
                                    </form>
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


    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/plugins/dropzone/dropzone.js"></script>

    <script src="{{URL::asset('assets/js/jquery.inputmask.min.js')}}"></script>

    <!--Start of Tawk.to Script-->
    <script src="{{URL::asset('assets/js/bs-stepper.min.js')}}"></script>
    <script type="text/javascript">
        var stepper1Node = document.querySelector('#stepper1')
        var stepper1 = new Stepper(document.querySelector('#stepper1'),{
            animation: true
        })

        stepper1Node.addEventListener('show.bs-stepper', function (event) {
            //console.warn('show.bs-stepper', event)
        })
        stepper1Node.addEventListener('shown.bs-stepper', function (event) {
            //console.warn('shown.bs-stepper', event)
        })

        $('#telefono').inputmask({"mask": "(999) 999-9999"})
        $('#folio').inputmask({"mask":"172-21-9{1,3}-9{1,3}"});
        $('#router').inputmask({"mask":"*{4,6}"});
        $('#senal').inputmask({"mask":"-99 dBm"});
        $('#coordenada').inputmask({"mask":"*{4,8}+*{2,4}"});
        $('#email').inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("email:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    casing: "lower"
                }
            }
        });

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
    </script>
    <!--End of Tawk.to Script-->
@endsection
