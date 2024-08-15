<div class="overlay"></div>
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="https://thememakker.com/templates/oreo/hospital/laravel/public/dashboard/index"><img src="{{URL::asset('assets/images/LOGO-PNG-SIN-FONDO.png')}}" width="30" alt="Fenix Networks"><span class="m-l-10">Fenix Networks</span></a>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        @if(!\Illuminate\Support\Facades\Auth::guest())
        <li class="d-none d-lg-inline-block"><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/doctor/events" title="Events"><i class="zmdi zmdi-calendar"></i></a></li>
        <li class="d-none d-lg-inline-block"><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/app/inbox" title="Inbox"><i class="zmdi zmdi-email"></i></a></li>
        <li><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/app/contact-list" title="Contact List"><i class="zmdi zmdi-account-box-phone"></i></a></li>

        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i>
                <div class="notify">
                    <span class="heartbit"></span>
                    <span class="point"></span>
                </div>
            </a>
        </li>
        <li class="d-none d-md-inline-block">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-search"></i>
                </span>
            </div>
        </li>
        @endif
        <li class="float-right">
            @if(!\Illuminate\Support\Facades\Auth::guest())
                <a href="{{route('logout')}}" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a>
            @endif
            <a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a>
        </li>
    </ul>
</nav>        <!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home m-r-5"></i>Fenix Networks</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    @if(!\Illuminate\Support\Facades\Auth::guest())
                    <li>
                        <div class="user-info">
                            <div class="image"><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/doctor/profile"><img src="../assets/images/profile_av.jpg" alt="User"></a></div>
                            <div class="detail">
                                    <span class="header">Bienvenido --</span>
                                    <br>
                                    <span>{{Auth::user()->getName()}}</span>
                            </div>
                        </div>
                    </li>
                    @else
                        <li>
                            <div class="user-info">
                                <div class="detail">
                                    <span class="header">Invitado --</span>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="header">MENÚ</li>

                    <li class="active open"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i><span>Inicio</span></a></li>
                    <li class=""><a href="{{route('planes')}}"><i class="zmdi zmdi-shape"></i><span>Planes y paquetes</span></a></li>
                    @if(!\Illuminate\Support\Facades\Auth::guest())
                    <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/appointment/book-appointment"><i class="zmdi zmdi-calendar-check"></i><span>Agenda</span></a></li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Servicios</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="{{route('servicios')}}">General</a></li>
                            <li class=""><a href="{{route('deudores')}}">Deudores</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Usuarios</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="{{route('agregar_u')}}">Agregar</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/patients/all-patients">Gestión</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance-wallet"></i><span>Pagos</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/payment/all-payment">Estadisticas generales</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/patients/invoice">Repostar pago</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/patients/invoice">Estatus de mi pago</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-pin"></i><span>Cobertura</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="{{route('cobertura')}}">Mapa de cobertura</a></li>
                            @if(!\Illuminate\Support\Facades\Auth::guest())
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/departments/all-departments">Localidades</a></li>
                            <li><a href="{{route('aps')}}">Puntos de acceso</a></li>
                            <li><a href="javascript:void(0);">PtP</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(!\Illuminate\Support\Facades\Auth::guest())
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-pin"></i><span>Mantenimiento</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="{{route('ptp_devices')}}">Estatus PtP</a></li>
                            <li class=""><a href="{{route('aps_devices')}}">Estatus APs</a></li>
                            <li class=""><a href="{{route('client_devices')}}">Estatus Clientes</a></li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>Autenticación</span></a>
                        <ul class="ml-menu">
                            <li><a href="{{route('login')}}">Iniciar sesión</a></li>
                            <li><a href="{{route('register')}}">Registrarse</a></li>
                            <li><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/authentication/forgot-password">Olvide mi contraseña</a></li>
                        </ul>
                    </li>
                    <li class=""><a href="{{url('/contacto')}}"><i class="zmdi zmdi-phone-msg"></i><span>Contácto</span></a></li>
                    @if(!\Illuminate\Support\Facades\Auth::guest())
                    <li class="header">EXTRA COMPONENTS</li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Blog</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/blog/dashboard">Dashboard</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/blog/new-post">New Post</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/blog/list">Blog List</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/blog/grid">Blog Grid</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/blog/detail">Blog Detail</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-folder"></i><span>File Manager</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/file-manager/dashboard">All File</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/file-manager/documents" >Documents</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/file-manager/media">Media</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/file-manager/image">Images</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>App</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/app/inbox">Inbox</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/app/chat">Chat</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/app/contact-list">Contact list</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-delicious"></i><span>Widgets</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/widgets/apps">Apps Widgetse</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/widgets/data">Data Widgetse</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>Sample Pages</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/blank-page">Blank Page</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/rtl">RTL Support</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/image-gallery">Image Gallery</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/profile">Profile</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/timeline">Timeline</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/invoices">Invoices</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/pages/search-results">Search Results</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>User Interface (UI)</span></a>
                        <ul class="ml-menu">
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/ui-kit">UI KIT</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/alerts">Alerts</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/collapse">Collapse</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/colors">Colors</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/dialogs">Dialogs</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/icons">Icons</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/list-group">List Group</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/media-object">Media Object</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/modals">Modals</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/notifications">Notifications</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/progressbars">Progress Bars</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/range-sliders">Range Sliders</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/sortable-nestable">Sortable Nestable</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/tabs">Tabs</a></li>
                            <li class=""><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/ui/waves">Waves</a></li>
                        </ul>
                    </li>
                    <li class="header">Extra</li>
                    <li>
                        <div class="progress-container progress-primary m-t-10">
                            <span class="progress-badge">Traffic this Month</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                                    <span class="progress-value">67%</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-container progress-info">
                            <span class="progress-badge">Server Load</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                    <span class="progress-value">86%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="tab-pane stretchLeft" id="user">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info m-b-20 p-b-15">
                            <div class="image"><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/doctor/profile"><img src="../assets/images/profile_av.jpg" alt="User"></a></div>
                            <div class="detail">
                                <h4>Dr. Charlotte</h4>
                                <small>Neurologist</small>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a>
                                    <a title="twitter" href="#"><i class="zmdi zmdi-twitter"></i></a>
                                    <a title="instagram" href="#"><i class="zmdi zmdi-instagram"></i></a>
                                </div>
                                <div class="col-4 p-r-0">
                                    <h5 class="m-b-5">18</h5>
                                    <small>Exp</small>
                                </div>
                                <div class="col-4">
                                    <h5 class="m-b-5">125</h5>
                                    <small>Awards</small>
                                </div>
                                <div class="col-4 p-l-0">
                                    <h5 class="m-b-5">148</h5>
                                    <small>Clients</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <small class="text-muted">Location: </small>
                        <p>795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                        <hr>
                        <small class="text-muted">Email address: </small>
                        <p>Charlotte@example.com</p>
                        <hr>
                        <small class="text-muted">Phone: </small>
                        <p>+ 202-555-0191</p>
                        <hr>
                        <small class="text-muted">Website: </small>
                        <p>http://dr.charlotte.com/ </p>
                        <hr>
                        <ul class="list-unstyled">
                            <li>
                                <div>Colorectal Surgery</div>
                                <div class="progress m-b-20">
                                    <div class="progress-bar l-blue " role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%"> <span class="sr-only">62% Complete</span></div>
                                </div>
                            </li>
                            <li>
                                <div>Endocrinology</div>
                                <div class="progress m-b-20">
                                    <div class="progress-bar l-green " role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%"> <span class="sr-only">87% Complete</span></div>
                                </div>
                            </li>
                            <li>
                                <div>Dermatology</div>
                                <div class="progress m-b-20">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%"> <span class="sr-only">32% Complete</span></div>
                                </div>
                            </li>
                            <li>
                                <div>Neurophysiology</div>
                                <div class="progress m-b-20">
                                    <div class="progress-bar l-blush" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%"> <span class="sr-only">56% Complete</span></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat"><i class="zmdi zmdi-comments"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity">Activity</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane slideRight active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Report Panel Usage</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" checked="">
                                <label for="checkbox2">Email Redirect</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" checked="">
                                <label for="checkbox3">Notifications</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox4" type="checkbox" checked="">
                                <label for="checkbox4">Auto Updates</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>Skins</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blush" class="active">
                            <div class="blush"></div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>Account Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox5" type="checkbox" checked="">
                                <label for="checkbox5">Offline</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox6" type="checkbox" checked="">
                                <label for="checkbox6">Location Permission</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card theme-light-dark">
                    <h6>Left Menu</h6>
                    <button class="t-light btn btn-default btn-simple btn-round btn-block">Light</button>
                    <button class="t-dark btn btn-default btn-round btn-block">Dark</button>
                    <button class="m_img_btn btn btn-primary btn-round btn-block">Sidebar Image</button>
                </div>
                <div class="card">
                    <h6>Information Summary</h6>
                    <div class="row m-b-20">
                        <div class="col-7">
                            <small class="displayblock">MEMORY USAGE</small>
                            <h5 class="m-b-0 h6">512</h5>
                        </div>
                        <div class="col-5">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="5" data-bar-Spacing="3" data-bar-Color="#00ced1">8,7,9,5,6,4,6,8</div>
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-7">
                            <small class="displayblock">CPU USAGE</small>
                            <h5 class="m-b-0 h6">90%</h5>
                        </div>
                        <div class="col-5">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="5" data-bar-Spacing="3" data-bar-Color="#F15F79">6,5,8,2,6,4,6,4</div>
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-7">
                            <small class="displayblock">DAILY TRAFFIC</small>
                            <h5 class="m-b-0 h6">25 142</h5>
                        </div>
                        <div class="col-5">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="5" data-bar-Spacing="3" data-bar-Color="#78b83e">7,5,8,7,4,2,6,5</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <small class="displayblock">DISK USAGE</small>
                            <h5 class="m-b-0 h6">60.10%</h5>
                        </div>
                        <div class="col-5">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="5" data-bar-Spacing="3" data-bar-Color="#457fca">7,5,2,5,6,7,6,4</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane right_chat stretchLeft" id="chat">
            <div class="slim_scroll">
                <div class="card">
                    <div class="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>        <!-- Chat-launcher -->
<div class="chat-launcher"></div>
