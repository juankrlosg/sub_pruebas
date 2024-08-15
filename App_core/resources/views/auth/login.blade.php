@extends('layouts.fenix-general')
@section('content')
    <div class="page-header">
        <div class="page-header-image" style="background-image:url('{{URL::asset('assets/images/login2.jpg')}}')"></div>

        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="header">
                            <div class="logo-container">
                                <img src="{{URL::asset('assets/images/LOGO-REDONDO-SF.png')}}" alt="Fenix Networks">
                            </div>
                            <h5>Inicio de sesión</h5>
                        </div>
                        <div class="content">
                            <div class="input-group input-lg">
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

                            <div class="input-group input-lg">
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
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block ">ENTRAR</button>
                            @if (Route::has('password.request'))
                                <h5><a href="{{ route('password.request') }}" class="link">Olvidaste la contraseña?</a></h5>
                            @endif
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

@endsection