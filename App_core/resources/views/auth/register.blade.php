@extends('layouts.fenix-general')
@section('content')

{{--@section('content')
    <div class="page-header">
        <div class="page-header-image" style="background-image:url('{{URL::asset('assets/images/login2.jpg')}}')"></div>

        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain">



                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="header">
                            <div class="logo-container">
                                <img src="{{URL::asset('assets/images/LOGO-REDONDO-SF.png')}}" alt="Fenix Networks">
                            </div>
                            <h5>Sign Up</h5>
                            <span>Register a new membership</span>
                        </div>
                        <div class="content">
                            <div class="input-group">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="name" autofocus placeholder="Nombre">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-account-circle"></i>
                                </span>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input id="ap" type="text" class="form-control @error('ap') is-invalid @enderror" name="ap" value="{{ old('ap') }}" required autocomplete="last_name" autofocus placeholder="Apellido Paterno">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-account-circle"></i>
                                </span>
                                @error('ap')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <input id="am" type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am') }}" required autocomplete="last_name" autofocus placeholder="Apellido Materno">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-account-circle"></i>
                                </span>
                                @error('am')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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

                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Logins</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Various information</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger"></div>
                                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container">
                <nav>
                    <ul>
                        <li><a href="http://thememakker.com/contact/" target="_blank">Contact Us</a></li>
                        <li><a href="http://thememakker.com/about/" target="_blank">About Us</a></li>
                        <li><a href="javascript:void(0);">FAQ</a></li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    <span>Designed by <a href="http://thememakker.com/" target="_blank">ThemeMakker</a></span>
                </div>
            </div>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

    <script type="application/javascript" src="{{URL::asset('assets/js/bs-stepper.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            var stepper = new Stepper($('.bs-stepper')[0])
        })
    </script>
@endsection--}}
@section('content')
    <div class="page-header">
        <div class="page-header-image" style="background-image:url('{{URL::asset('assets/images/login2.jpg')}}')"></div>
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain2">
                    <div class="header">
                        <div class="logo-container">
                            <img src="{{URL::asset('assets/images/LOGO-REDONDO-SF.png')}}" alt="Fenix Networks">
                        </div>
                        <h5>Registro de usuario</h5>
                    </div>
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
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div id="test-l-1" class="content">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre(s)">
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
                                                    <input id="app" type="app" class="form-control @error('app') is-invalid @enderror" name="app" value="{{ old('app') }}" required autocomplete="app" autofocus placeholder="Apellido Paterno">
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
                                                    <input id="apm" type="apm" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm') }}" required autocomplete="apm" autofocus placeholder="Apellido Materno">
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
                                                        <option value="">- Estado -</option>
                                                        @foreach($estados as $estado)
                                                            <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <select id="municipio" class="form-control show-tick" tabindex="-98">
                                                        <option value="">- Municipio -</option>
                                                        @foreach($municipios as $municipio)
                                                            <option value="{{$municipio->id}}" data-estado="{{$municipio->id_estado}}">{{$municipio->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="input-group">
                                                    <select id="localidad" class="form-control show-tick @error('localidad') is-invalid @enderror" tabindex="-98" id="localidad" name="localidad" value="{{ old('localidad') }}" required autocomplete="localidad" >
                                                        <option value="">- Localidad -</option>
                                                        @foreach($localidades as $localidad)
                                                            <option value="{{$localidad->id}}" data-municipio="{{$localidad->id_municipio}}">{{$localidad->descripcion}}</option>
                                                        @endforeach
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
                                                    <input id="referencia" type="referencia" class="form-control @error('referencia') is-invalid @enderror" name="referencia" value="{{ old('referencia') }}" required autocomplete="referencia" autofocus placeholder="Referencia del domicilio">
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
                                                    <input id="telefono" type="telefono" class="form-control @error('telefono') is-invalid @enderror" telefono="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus placeholder="Telefono">
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
                                                    <input id="fecha" type="text" onfocus="(this.type='date')" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha" autofocus placeholder="Fecha de contratación">
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
                                                    <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio') }}" required autocomplete="folio" autofocus placeholder="Folio del contrato">
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
                                                        @foreach($paquetes as $paquete)
                                                            <option value="{{$paquete->id_servicio}}">{{$paquete->descripcion.' - $'.$paquete->costo.'.00'}}</option>
                                                        @endforeach
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
                                                    <input id="coordenada" type="text" class="form-control @error('coordenada') is-invalid @enderror" name="coordenada" value="{{ old('coordenada') }}" required autocomplete="coordenada" autofocus placeholder="Coordenada del domicilio">
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
                                                    <input id="router" type="text" class="form-control @error('router') is-invalid @enderror" name="router" value="{{ old('router') }}" required autocomplete="router" autofocus placeholder="ID del router">
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
                                                    <input id="senal" type="text" class="form-control @error('senal') is-invalid @enderror" name="senal" value="{{ old('senal') }}" required autocomplete="senal" autofocus placeholder="Intensidad de la señal">
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
                                        <button type="submit" class="btn btn-info btn-round" >Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <!--div id="stepper1" class="bs-stepper vertical">
                        <div class="row">
                            <div class="col col-lg-3 bs-stepper-header">
                                <div class="step" data-target="#test-lv-1">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label text-white">Dato<br>personales</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#test-lv-2">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label text-white">Datos del<br>servicio</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#test-lv-3">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label text-white">Datos<br>especificos</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col col-lg-9 bs-stepper-content pr-5">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div id="test-lv-1" class="content">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre(s)">
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
                                                    <input id="app" type="app" class="form-control @error('app') is-invalid @enderror" name="app" value="{{ old('app') }}" required autocomplete="app" autofocus placeholder="Apellido Paterno">
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
                                                    <input id="apm" type="apm" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm') }}" required autocomplete="apm" autofocus placeholder="Apellido Materno">
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
                                                    <select class="form-control show-tick" tabindex="-98">
                                                        <option value="">- Estado -</option>
                                                        @foreach($estados as $estado)
                                                            <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <select class="form-control show-tick" tabindex="-98">
                                                        <option value="">- Municipio -</option>
                                                        @foreach($municipios as $municipio)
                                                            <option value="{{$municipio->id}}">{{$municipio->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="input-group">
                                                    <select class="form-control show-tick @error('localidad') is-invalid @enderror" tabindex="-98" id="localidad" name="localidad" value="{{ old('localidad') }}" required autocomplete="localidad" >
                                                        <option value="">- Localidad -</option>
                                                        @foreach($localidades as $localidad)
                                                            <option value="{{$localidad->id}}">{{$localidad->descripcion}}</option>
                                                        @endforeach
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
                                                    <input id="referencia" type="referencia" class="form-control @error('referencia') is-invalid @enderror" name="referencia" value="{{ old('referencia') }}" required autocomplete="referencia" autofocus placeholder="Referencia del domicilio">
                                                    <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
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
                                                    <input id="telefono" type="telefono" class="form-control @error('telefono') is-invalid @enderror" telefono="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus placeholder="Telefono">
                                                    <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>
                                                    @error('telefono')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="test-lv-2" class="content">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio') }}" required autocomplete="folio" autofocus placeholder="Folio">
                                                    <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>
                                                    @error('folio')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="test-lv-3" class="content">
                                        <div class="input-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">
                                            <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                            <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-round" onclick="stepper1.previous()">Previo</button>
                                    <button type="button" class="btn btn-warning btn-round" onclick="stepper1.next()">Next</button>
                                </form>
                            </div>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </div>
    <script src="{{URL::asset('assets/js/bs-stepper.min.js')}}"></script>
    <script>
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
        $('#senal').inputmask({"mask":"-99"});
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
            dato=$(this).val();
            text="";
            $('li a span').parent().parent().show();
            $('#municipio option').each(function () {
                if ($(this).data('estado')!=dato){
                    text=$(this).text();
                    $('li a span:contains("'+text+'")').parent().parent().hide();
                }
            });
            $('li a span:contains("- Municipio -")').parent().parent().show();
            $('button:contains("- Municipio -")').removeClass('disabled');
        })

        $('#municipio').on('change',function () {
            dato=$(this).val();
            text="";
            $('li a span').parent().parent().show();
            $('#localidad option').each(function () {
                if ($(this).data('municipio')!=dato){
                    text=$(this).text();
                    $('li a span:contains("'+text+'")').parent().parent().hide();
                }
            });
            $('li a span:contains("- Localidad -")').parent().parent().show();
            $('button:contains("- Localidad -")').removeClass('disabled');
        })

        $(document).ready(function () {
            setTimeout(function () {
                $('button:contains("- Municipio -")').addClass('disabled');
                $('button:contains("- Localidad -")').addClass('disabled');
                console.log('cargó')
            },1500)
        })
    </script>
@endsection