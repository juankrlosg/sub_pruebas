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
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @if(!\Illuminate\Support\Facades\Auth::guest())
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="header pb-0">
                                <h3 class="number count-to m-b-0" data-from="0" data-to="{{sizeof($nuevos_clientes)}}" data-speed="2500" data-fresh-interval="700"><a href="{{url('/nuevos_clientes')}}">{{sizeof($nuevos_clientes)}} <i class="zmdi zmdi-trending-up float-right"></i></a></h3>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" ><i class="zmdi zmdi-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body pt-0">
                                <p class="text-muted">
                                    <a href="{{url('/nuevos_clientes')}}" class="text-danger">Nuevos clientes</a></p>
                                <div class="progress">
                                    <div class="progress-bar l-blush" role="progressbar" aria-valuenow="{{sizeof($nuevos_clientes)*100/sizeof($numero_de_clientes)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{sizeof($nuevos_clientes)*100/sizeof($numero_de_clientes)}}%;"></div>
                                </div>
                                <small>Correspondiente al {{round(sizeof($nuevos_clientes)*100/sizeof($numero_de_clientes))}}%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="header pb-0">
                                <h3 class="number count-to m-b-0" data-from="0" data-to="{{sizeof($numero_de_clientes)}}" data-speed="2500" data-fresh-interval="1000">{{sizeof($numero_de_clientes)}} <i class="zmdi zmdi-trending-up float-right"></i></h3>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" ><i class="zmdi zmdi-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body pt-0">
                                <p class="text-muted">Total clientes</p>
                                <div class="progress">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="{{100-round(sizeof($nuevos_clientes)*100/sizeof($numero_de_clientes))}}" aria-valuemin="0" aria-valuemax="100" style="width: {{100-round(sizeof($nuevos_clientes)*100/sizeof($numero_de_clientes))}}%;"></div>
                                </div>
                                <small>Incrementó un {{round(sizeof($nuevos_clientes)*100/(sizeof($numero_de_clientes)-sizeof($nuevos_clientes)))}}%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="header pb-0">
                                <h3 class="number count-to m-b-0" data-from="0" data-to="{{sizeof($al_dia)}}" data-speed="2500" data-fresh-interval="1000">{{sizeof($al_dia)}} <i class="zmdi zmdi-trending-up float-right"></i></h3>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" ><i class="zmdi zmdi-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body pt-0">
                                <p class="text-muted">Clientes al corriente <i class="zmdi zmdi-mood"></i></p>
                                <div class="progress">
                                    <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="{{round(sizeof($al_dia)*100/sizeof($numero_de_clientes))}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round(sizeof($al_dia)*100/sizeof($numero_de_clientes))}}%;"></div>
                                </div>
                                <small>Alrededor del {{round(sizeof($al_dia)*100/sizeof($numero_de_clientes))}}%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="header pb-0">
                                <h3 class="number count-to m-b-0" data-from="0" data-to="{{sizeof($con_retraso)}}" data-speed="2500" data-fresh-interval="1000">{{sizeof($con_retraso)}} <i class="zmdi zmdi-trending-up float-right"></i></h3>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a href="{{route('deudores')}}" role="button" ><i class="zmdi zmdi-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body pt-0">
                                <p class="text-muted">Clientes con adeudo <i class="zmdi zmdi-mood-bad"></i></p>
                                <div class="progress">
                                    <div class="progress-bar l-blush" role="progressbar" aria-valuenow="{{round(sizeof($con_retraso)*100/sizeof($numero_de_clientes))}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round(sizeof($con_retraso)*100/sizeof($numero_de_clientes))}}%;"></div>
                                </div>
                                <small>Alrededor del {{round(sizeof($con_retraso)*100/sizeof($numero_de_clientes))}}%</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Ingresos</strong> por Instalaciones Mensuales</h2>
                                <ul class="header-dropdown">
                                    {{--<li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                        <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                            <li><a href="javascript:void(0);">Edit</a></li>
                                            <li><a href="javascript:void(0);">Delete</a></li>
                                            <li><a href="javascript:void(0);">Report</a></li>
                                        </ul>
                                    </li>
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>--}}
                                </ul>
                            </div>
                            <div class="body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs padding-0">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#chart-view">Gráfica</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#table-view">Tabla de datos</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content m-t-10">
                                    <div class="tab-pane active" id="chart-view">
                                        {{--                                <div id="echarts-google-map" class="align-items-center" style="width: 100%;height:400px;"></div>--}}
                                        <div id="main" class="align-items-center" style="width: 100%;height:400px;"></div>

                                        <div class="xl-slategray">
                                            <div class="header">
                                                <h2><strong>Resumen</strong> ingresos</h2>
                                            </div>
                                            <div class="body">
                                                <div class="row text-center">
                                                    <div class="col-sm-3 col-6">
                                                        <h4 class="margin-0">${{number_format(array_sum($datos_grafica[2]))}}</h4>
                                                        <p class="text-muted margin-0"> {{date("Y")-2}}</p>
                                                    </div>
                                                    <div class="col-sm-3 col-6">
                                                        <h4 class="margin-0">${{number_format(array_sum($datos_grafica[1]))}}</h4>
                                                        <p class="text-muted margin-0"> {{date("Y")-1}}</p>
                                                    </div>
                                                    <div class="col-sm-3 col-6">
                                                        <h4 class="margin-0">${{number_format(array_sum($datos_grafica[0]))}}</h4>
                                                        <p class="text-muted margin-0">{{date("Y")}}</p>
                                                    </div>
                                                    <div class="col-sm-3 col-6">
                                                        <h4 class="margin-0">${{number_format(array_sum($datos_grafica[0])+array_sum($datos_grafica[1])+array_sum($datos_grafica[2]))}}</h4>
                                                        <p class="text-muted margin-0">Total</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="table-view">
                                        <div class="table-responsive">
                                            <table class="table m-b-0 table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>IP</th>
                                                    <th>Servicio</th>
                                                    <th>Pago</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($servicios as $servicio)
                                                    <tr>
                                                        <td>{{$servicio->nombre.' '.$servicio->ap.' '.$servicio->am}}</td>
                                                        <td>{{$servicio->IP}}</td>
                                                        <td>{{$servicio->descripcion}}</td>
                                                        <td>${{$servicio->costo}}.00</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
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
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="body">
                                <div class="sparkline m-b-10" data-type="bar" data-width="97%" data-height="38px" data-bar-Width="2" data-bar-Spacing="6" data-bar-Color="#555555">{{$usuarios_sector}}</div>
                                <h6 class="text-center m-b-15">Clientes por Sector</h6>
{{--                                <div id="world-map-markers2" style="height:125px;"></div>--}}
                                <div class="table-responsive m-t-20">
                                    <table class="table table-striped m-b-0">
                                        <thead>
                                        <tr>
                                            <th>Sectorial</th>
                                            <th>Clientes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sectores as $sector)
                                            <tr>
                                                <td>{{$sector->descripcion}}</td>
                                                <td>{{sizeof($sector->users)}} <a href="#"><i class="zmdi zmdi-plus m-l-10 text-danger pull-right"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Dr.</strong> Timeline</h2>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="new_timeline">
                                    <div class="header">
                                        <div class="color-overlay">
                                            <div class="day-number">8</div>
                                            <div class="date-right">
                                                <div class="day-name">Monday</div>
                                                <div class="month">February 2018</div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="bullet pink"></div>
                                            <div class="time">5pm</div>
                                            <div class="desc">
                                                <h3>New Icon</h3>
                                                <h4>Mobile App</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <div class="time">3 - 4pm</div>
                                            <div class="desc">
                                                <h3>Design Stand Up</h3>
                                                <h4>Hangouts</h4>
                                                <ul class="list-unstyled team-info margin-0 p-t-5">
                                                    <li><img src="http://via.placeholder.com/35x35" alt="Avatar"></li>
                                                    <li><img src="http://via.placeholder.com/35x35" alt="Avatar"></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet orange"></div>
                                            <div class="time">12pm</div>
                                            <div class="desc">
                                                <h3>Lunch Break</h3>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <div class="time">9 - 11am</div>
                                            <div class="desc">
                                                <h3>Finish Home Screen</h3>
                                                <h4>Web App</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-6">
                                <div class="card top_counter">
                                    <div class="body">
                                        <div class="icon xl-slategray"><i class="zmdi zmdi-account"></i> </div>
                                        <div class="content">
                                            <div class="text">New Patient</div>
                                            <h5 class="number">27</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card top_counter">
                                    <div class="body">
                                        <div class="icon xl-slategray"><i class="zmdi zmdi-account"></i> </div>
                                        <div class="content">
                                            <div class="text">OPD Patient</div>
                                            <h5 class="number">19</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card top_counter">
                                    <div class="body">
                                        <div class="icon xl-slategray"><i class="zmdi zmdi-bug"></i> </div>
                                        <div class="content">
                                            <div class="text">Operations</div>
                                            <h5 class="number">08</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card visitors-map">
                            <div class="header">
                                <h2><strong>Our</strong> Location <small>Contrary to popular belief, Lorem Ipsum is not simply random text</small></h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div id="world-map-markers" style="height:280px;"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="body">
                                            <ul class="row location_list list-unstyled">
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-turquoise">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="453" data-speed="2500" data-fresh-interval="700">453</h4>
                                                        <span>America</span>
                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-khaki">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="124" data-speed="2500" data-fresh-interval="700">124</h4>
                                                        <span>Australia</span>
                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-parpl">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="215" data-speed="2500" data-fresh-interval="700">215</h4>
                                                        <span>Canada</span>
                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-salmon">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="155" data-speed="2500" data-fresh-interval="700">155</h4>
                                                        <span>India</span>
                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-blue">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="78" data-speed="2500" data-fresh-interval="700">78</h4>
                                                        <span>UK</span>
                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-6">
                                                    <div class="body xl-slategray">
                                                        <i class="zmdi zmdi-pin"></i>
                                                        <h4 class="number count-to" data-from="0" data-to="55" data-speed="2500" data-fresh-interval="700">55</h4>
                                                        <span>Other</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Heart</strong> Surgeries <small>18% High then last month</small></h2>
                            </div>
                            <div class="body">
                                <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                                     data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(96, 125, 139)" data-spot-Color="rgb(96, 125, 139, 0.7)"
                                     data-offset="90" data-width="100%" data-height="50px" data-line-Width="1" data-line-Color="rgb(96, 125, 139, 0.7)"
                                     data-fill-Color="rgba(96, 125, 139, 0.3)"> 6,4,7,8,4,3,2,2,5,6,7,4,1,5,7,9,9,8,7,6 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Medical</strong> Treatment <small>18% High then last month</small></h2>
                            </div>
                            <div class="body">
                                <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                                     data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(120, 184, 62, 0.7)"
                                     data-offset="90" data-width="100%" data-height="50px" data-line-Width="1" data-line-Color="rgb(120, 184, 62, 0.7)"
                                     data-fill-Color="rgba(120, 184, 62, 0.3)"> 6,4,7,6,9,3,3,5,7,4,2,3,7,6 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>New</strong> Patient <small >18% High then last month</small></h2>
                            </div>
                            <div class="body">
                                <div class="sparkline" data-type="bar" data-width="97%" data-height="50px" data-bar-Width="4" data-bar-Spacing="10" data-bar-Color="#00ced1">2,8,5,3,1,7,9,5,6,4,2,3,1</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card tasks_report">
                            <div class="header">
                                <h2><strong>Total</strong> Revenue</h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                                            <li><a href="javascript:void(0);">2017 Year</a></li>
                                            <li><a href="javascript:void(0);">2016 Year</a></li>
                                            <li><a href="javascript:void(0);">2015 Year</a></li>
                                        </ul>
                                    </li>
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body text-center">
                                <h4 class="margin-0">Total Sale</h4>
                                <h6 class="m-b-20">2,45,124</h6>
                                <input type="text" class="knob dial1" value="66" data-width="100" data-height="100" data-thickness="0.1" data-fgColor="#212121" readonly>
                                <h6 class="m-t-20">Satisfaction Rate</h6>
                                <small class="displayblock">47% Average <i class="zmdi zmdi-trending-up"></i></small>
                                <div class="sparkline m-t-20" data-type="bar" data-width="97%" data-height="28px" data-bar-Width="2" data-bar-Spacing="8" data-bar-Color="#212121">3,2,6,5,9,8,7,8,4,5,1,2,9,5,1,3,5,7,4,6</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card patient_list">
                            <div class="header">
                                <h2><strong>New</strong> Patient List</h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                                            <li><a href="javascript:void(0);">2017 Year</a></li>
                                            <li><a href="javascript:void(0);">2016 Year</a></li>
                                            <li><a href="javascript:void(0);">2015 Year</a></li>
                                        </ul>
                                    </li>
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Diseases</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="http://via.placeholder.com/35x35" alt="Avatar" class="rounded-circle"></td>
                                            <td>Virginia</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td><span class="badge badge-danger">Fever</span> </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="http://via.placeholder.com/35x35" alt="Avatar" class="rounded-circle"></td>
                                            <td>Julie </td>
                                            <td>71 Pilgrim Avenue Chevy Chase, MD 20815</td>
                                            <td><span class="badge badge-info">Cancer</span> </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><img src="http://via.placeholder.com/35x35" alt="Avatar" class="rounded-circle"></td>
                                            <td>Woods</td>
                                            <td>70 Bowman St. South Windsor, CT 06074</td>
                                            <td><span class="badge badge-warning">Lakva</span> </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><img src="http://via.placeholder.com/35x35" alt="Avatar" class="rounded-circle"></td>
                                            <td>Lewis</td>
                                            <td>4 Goldfield Rd.Honolulu, HI 96815</td>
                                            <td><span class="badge badge-success">Dental</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Página </strong> principal</h2>
                            </div>
                            <div class="body">
                                <div class="mega-card">
                                    <div class="d-none d-lg-block">

                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                                            </ol>
                                            <div class="carousel-inner">

                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner1.png')}}" alt="First slide">
                                                    <div class="carousel-caption d-none d-md-block mb-0 pb-0">
                                                        <button class="btn btn-round btn-danger">Obtener información</button>
                                                        <p>...</p>
                                                    </div>
                                                </div>

                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner2.png')}}" alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner9.png')}}" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner3.png')}}" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner5.jpg')}}" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner6.jpg')}}" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner7.jpg')}}" alt="Third slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{URL::asset('/assets/images/carousel/banner8.jpg')}}" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                        {{--<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="40000">
                                            <ol class="carousel-indicators">
                                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="first-slide img-fluid" src="{{URL::asset('/img/banner1.only.png')}}" alt="First slide" >
                                                    <div class="container">
                                                        <div class="carousel-caption row">
                                                            <div class="col-md-4 m-b--5" style="text-shadow: black 0em 0em 0.4em;">
                                                                <h2>Contrata</h2>
                                                                <h2 style="text-shadow: red 0em 0em 0.4em; color: red; -webkit-text-fill-color: white; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: rgba(255,0,0,0.5);">internet</h2>
                                                                <br><br>
                                                            </div>
                                                            <div class="col-md-4 offset-4 text-center align-content-center" style="text-shadow: black 0em 0em 0.4em;">
                                                                <h2>y disfruta del <span style="text-shadow: red 0em 0em 0.4em; color: red; -webkit-text-fill-color: white; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: rgba(255,0,0,0.5);">primer mes</span> de servicio <span style="text-shadow: red 0em 0em 0.4em; color: red; -webkit-text-fill-color: white; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: rgba(255,0,0,0.5);">GRATIS</span></h2>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-12 text-center"><a class="btn btn-lg btn-danger" href="{{url('/planes-y-paquetes')}}" role="button">Contratar</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="second-slide img-fluid" src="{{URL::asset('/img/banner2.only.png')}}" alt="Second slide">
                                                    <div class="container">
                                                        <div class="carousel-caption">
                                                            <h1 class="text-danger">¿Tu internet esta lento?</h1>
                                                            <h4 class="text-black-50">Disfruta de los beneficios que internet</h4>
                                                            <br><br><br><br><br>
                                                            <h4 class="text-black-50">tiene para ti</h4>
                                                            <p><a class="btn btn-lg btn-primary" href="#lo-mejor" role="button">Leer más</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="third-slide img-fluid" src="{{URL::asset('/img/banner3.png')}}" alt="Third slide">
                                                    <div class="container">
                                                        <div class="carousel-caption text-center">
                                                            <p><a class="btn btn-lg btn-danger" href="{{url('/precontrato/2')}}" role="button">¡Lo quiero!</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="fourth -slide img-fluid border border-bottom " src="{{URL::asset('/img/banner4.1.only.png')}}" alt="Fourth  slide">
                                                    <div class="container">
                                                        <div class="carousel-caption text-left text-black-50">
                                                            <h1>La zona donde vives </h1>
                                                            <h1 class="text-danger">¿es insegura?</h1>
                                                            <h5>Instala sistemas de <span class="text-info">alarma, CCTV y cercas electrificadas</span></h5>
                                                            <h5>en tu hogar y <span class="text-success">deja de preocuparte</span></h5>
                                                            <br>
                                                            <p><a class="btn btn-lg btn-danger" href="{{url('/otros-servicios')}}" role="button">Obtener información</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>--}}
                                    </div>
                                    <div class="d-lg-none">
                                        <div id="myCarousel2" class="carousel slide" data-ride="carousel2" data-interval="4000">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="first-slide img-fluid" src="{{URL::asset('/img/banner1.3.png')}}" alt="First slide">
                                                    <div class="container d-none d-md-block">
                                                        <div class="carousel-caption mb-0 pb-0">
                                                            <a class="btn btn-lg btn-danger" href="{{url('/planes-y-paquetes')}}" role="button">Contratar</a>
                                                        </div>
                                                    </div>
                                                    <div class="container d-md-none">
                                                        <div class="mb-0 pb-0 d-flex flex-column">
                                                            <a class="btn btn-lg btn-danger align-content-end" href="{{url('/planes-y-paquetes')}}" role="button">Contratar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="second-slide img-fluid" src="{{URL::asset('/assets/images/carousel/f1.jpg')}}" alt="Second slide">
                                                    <div class="container d-none d-md-block">
                                                        <div class="carousel-caption mb-0 pb-0 d-flex pull-left">
                                                            <a class="btn btn-lg btn-danger" href="#lo-mejor" role="button">Leer más</a>
                                                        </div>
                                                    </div>
                                                    <div class="container d-md-none">
                                                        <div class="mb-0 pb-0 d-flex flex-column">
                                                            <a class="btn btn-lg btn-danger align-content-end" href="#lo-mejor" role="button">Leer más</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="third-slide img-fluid" src="{{URL::asset('/img/banner3.png')}}" alt="Third slide">
                                                    <div class="container d-none d-md-block">
                                                        <div class="carousel-caption mb-0 pb-0">
                                                            <a class="btn btn-lg btn-danger" href="{{url('/precontrato/2')}}" role="button">¡Lo quiero!</a>
                                                        </div>
                                                    </div>
                                                    <div class="container d-md-none">
                                                        <div class="mb-0 pb-0 d-flex flex-column">
                                                            <a class="btn btn-lg btn-danger align-content-end" href="{{url('/precontrato/2')}}" role="button">¡Lo quiero!</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="fourth -slide img-fluid border border-bottom " src="{{URL::asset('/img/banner4.png')}}" alt="Fourth  slide">
                                                    <div class="container d-none d-md-block">
                                                        <div class="carousel-caption mb-0 pb-0">
                                                            <a class="btn btn-lg btn-danger" href="{{url('/otros-servicios')}}" role="button">Obtener información</a>
                                                        </div>
                                                    </div>
                                                    <div class="container d-md-none">
                                                        <div class="mb-0 pb-0 d-flex flex-column">
                                                            <a class="btn btn-lg btn-danger align-content-end" href="{{url('/otros-servicios')}}" role="button">Obtener información</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#myCarousel2" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#myCarousel2" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- <div id="carouselHome" class="carousel slide" data-ride="carousel" data-interval="4000">
                                         <div class="carousel-inner">
                                             <div class="carousel-item active img_container">
                                                 <img class="d-block w-100" src="{{URL::asset('/img/banner1.png')}}" alt="First slide">
                                                 <a href="#" class="btn btn-danger btn-5 btn-float-banner btn-float-center font-weight-bold">Contratar</a>
                                             </div>
                                             <div class="carousel-item">
                                                 <img class="d-block w-100" src="{{URL::asset('/img/banner2.png')}}" alt="Second slide">
                                                 <a href="#" class="btn btn-danger btn-5 btn-float-banner btn-float-rigth font-weight-bold">Comprar</a>
                                             </div>
                                             <div class="carousel-item">
                                                 <img class="d-block w-100" src="{{URL::asset('/img/banner3.png')}}" alt="Third slide">
                                                 <a href="#" class="btn btn-danger btn-5 btn-float-banner btn-float-center font-weight-bold">¡Lo quiero!</a>
                                             </div>
                                             <div class="carousel-item">
                                                 <img class="d-block w-100" src="{{URL::asset('/img/banner4.1.png')}}" alt="Third slide">
                                                 <a href="#" class="btn btn-danger btn-5 btn-float-banner btn-float-center font-weight-bold">¡Lo quiero!</a>
                                             </div>
                                         </div>
                                         <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                             <span class="sr-only">Previous</span>
                                         </a>
                                         <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                             <span class="sr-only">Next</span>
                                         </a>
                                     </div>--}}
                                    <br>

                                </div>
                                <div class="mega-card" id="lo-mejor">
                                    <div class="card-body text-center">
                                        <h3>¿Por qué somos la mejor opción?</h3>

                                        <div class="row align-center">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="card m-l-5 m-r-5">
                                                    <br>
                                                    <div class="container-fluid text-center">
                                                        <i class="zmdi zmdi-run zmdi-hc-5x"></i>
                                                        <p><h5>Internet super rapido</h5></p>
                                                        <p class="text-justify">Gracias a nuestra red diseñada minuciosamente 100% inalámbrica hasta tu hogar, se puede garantizar una velocidad constante en tu internet permitiendo que puedas llevar a cabo tus tareas domésticas, laborales o de ocio sin inconvenientes.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="card m-l-5 m-r-5">
                                                    <br>
                                                    <div class="container-fluid text-center">
                                                        <i class="zmdi zmdi-sun zmdi-hc-5x"></i>
                                                        <i class="zmdi zmdi-cloud zmdi-hc-5x"></i>
                                                        <p><h5>Independencia al clima</h5></p>
                                                        <p class="text-justify">Debido a que el 95% de nuestra red se encuentra en la troposfera a nivel del suelo, las dependencias de velocidad o conectividad debido a las condiciones climáticas no suceden con la misma frecuencia como sucede con los proveedores de internet satelital o por redes móviles.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="card m-l-5 m-r-5">
                                                    <br>
                                                    <div class="container-fluid text-center">
                                                        <i class="zmdi zmdi-lock-open zmdi-hc-5x"></i>
                                                        <p><h5>Servicio sin restricciones</h5></p>
                                                        <p class="text-justify">Porque lo primordial para nosotros es que puedas disfrutar de una buena conexión a internet, te ofrecemos un servicio libre de restricciones de ancho de banda y contenido para que puedas acceder a tus sitios favoritos a la hora que lo desees y/o el día que lo necesites.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="col-md-3">
                                                <div class="card m-l-5 m-r-10">
                                                    <br>
                                                    <div class="container-fluid text-center">
                                                        <i class="fa fa-hand-holding-usd fa-5x"></i>
                                                        <p><h5>Prepago</h5></p>
                                                    </div>
                                                </div>
                                            </div>--}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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

        $(document).ready(function () {
            años=@JSON($year_grafica);
            datos=@JSON($datos_grafica);
            console.log(años[1])

            // Initialize the echarts instance based on the prepared dom
            var myChart = echarts.init(document.getElementById('main'));

            // Specify the configuration items and data for the chart
            option = {
                color: ['#37A2FF', '#FF0087', '#FFBF00'],
                title: {
                    text: 'Ventas / mes'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: años
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: false,
                        data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                    }
                ],
                series:  [
                    {
                        name: años[0],
                        type: 'line',
                        stack: 'Total',
                        smooth: true,
                        lineStyle: {
                            width: 0
                        },
                        showSymbol: false,
                        areaStyle: {
                            opacity: 0.8,
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                {
                                    offset: 0,
                                    color: 'rgb(55, 162, 255)'
                                },
                                {
                                    offset: 1,
                                    color: 'rgb(116, 21, 219)'
                                }
                            ])
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: datos[0]
                    },
                    {
                        name: años[1],
                        type: 'line',
                        stack: 'Total',
                        smooth: true,
                        lineStyle: {
                            width: 0
                        },
                        showSymbol: false,
                        areaStyle: {
                            opacity: 0.8,
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                {
                                    offset: 0,
                                    color: 'rgb(255, 0, 135)'
                                },
                                {
                                    offset: 1,
                                    color: 'rgb(135, 0, 157)'
                                }
                            ])
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: datos[1]
                    },
                    {
                        name: años[2],
                        type: 'line',
                        stack: 'Total',
                        smooth: true,
                        lineStyle: {
                            width: 0
                        },
                        showSymbol: false,
                        label: {
                            show: true,
                            position: 'top'
                        },
                        areaStyle: {
                            opacity: 0.8,
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                {
                                    offset: 0,
                                    color: 'rgb(255, 191, 0)'
                                },
                                {
                                    offset: 1,
                                    color: 'rgb(224, 62, 76)'
                                }
                            ])
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: datos[2]
                    }
                ]
            };

            // Display the chart using the configuration items and data just specified.
            myChart.setOption(option);
        })


    </script>
    <!--End of Tawk.to Script-->
@endsection
