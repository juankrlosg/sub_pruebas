@extends('layouts.fenix-app')
@section('content')
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Dashboard <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                <div class="inlineblock text-center m-r-15 m-l-15 d-none d-lg-inline-block">
                    <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
                    <small class="col-white">Visitors</small>
                </div>
                <div class="inlineblock text-center m-r-15 m-l-15 d-none d-lg-inline-block">
                    <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
                    <small class="col-white">Operations</small>
                </div>



                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="https://thememakker.com/templates/oreo/hospital/laravel/public/dashboard/index"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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
                        <h2><strong>Hospital</strong> Survey</h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
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
                                    <div class="body">
                                        <div class="row text-center">
                                            <div class="col-sm-3 col-6">
                                                <h4 class="margin-0">$106</h4>
                                                <p class="text-muted margin-0"> Today's</p>
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <h4 class="margin-0">$907</h4>
                                                <p class="text-muted margin-0">This Week's</p>
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <h4 class="margin-0">$4210</h4>
                                                <p class="text-muted margin-0">This Month's</p>
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <h4 class="margin-0">$7,000</h4>
                                                <p class="text-muted margin-0">This Year's</p>
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
                        <div class="sparkline m-b-10" data-type="bar" data-width="97%" data-height="38px" data-bar-Width="2" data-bar-Spacing="6" data-bar-Color="#555555">2,8,5,3,1,7,9,5,6,4,2,3,1,2,8,5,3,1,7,9,5,6,4,2,3,1</div>
                        <h6 class="text-center m-b-15">Total New Patient</h6>
                        <div id="world-map-markers2" style="height:125px;"></div>
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
                                    <td>{{sizeof($sector->users)}} <i class="zmdi zmdi-plus m-l-10 text-danger"></i></td>
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
    </div>
</section>
<!-- Scripts -->
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/morrisscripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/jvectormap.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/knob.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/index.js"></script>

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

    años=@JSON($años_grafica);
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
                type: 'value'
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


    var data = [
        { name: "海门", value: 9 },
        { name: "鄂尔多斯", value: 12 },
        { name: "招远", value: 12 },
        { name: "舟山", value: 12 },
        { name: "齐齐哈尔", value: 14 },
        { name: "盐城", value: 15 },
        { name: "赤峰", value: 16 },
        { name: "青岛", value: 18 },
        { name: "乳山", value: 18 },
        { name: "金昌", value: 19 },
        { name: "泉州", value: 21 },
        { name: "莱西", value: 21 },
        { name: "日照", value: 21 },
        { name: "胶南", value: 22 },
        { name: "南通", value: 23 },
        { name: "拉萨", value: 24 },
        { name: "云浮", value: 24 },
        { name: "梅州", value: 25 },
        { name: "文登", value: 25 },
        { name: "上海", value: 25 },
        { name: "攀枝花", value: 25 },
        { name: "威海", value: 25 },
        { name: "承德", value: 25 },
        { name: "厦门", value: 26 },
        { name: "汕尾", value: 26 },
        { name: "潮州", value: 26 },
        { name: "丹东", value: 27 },
        { name: "太仓", value: 27 },
        { name: "曲靖", value: 27 },
        { name: "烟台", value: 28 },
        { name: "福州", value: 29 },
        { name: "瓦房店", value: 30 },
        { name: "即墨", value: 30 },
        { name: "抚顺", value: 31 },
        { name: "玉溪", value: 31 },
        { name: "张家口", value: 31 },
        { name: "阳泉", value: 31 },
        { name: "莱州", value: 32 },
        { name: "湖州", value: 32 },
        { name: "汕头", value: 32 },
        { name: "昆山", value: 33 },
        { name: "宁波", value: 33 },
        { name: "湛江", value: 33 },
        { name: "揭阳", value: 34 },
        { name: "荣成", value: 34 },
        { name: "连云港", value: 35 },
        { name: "葫芦岛", value: 35 },
        { name: "常熟", value: 36 },
        { name: "东莞", value: 36 },
        { name: "河源", value: 36 },
        { name: "淮安", value: 36 },
        { name: "泰州", value: 36 },
        { name: "南宁", value: 37 },
        { name: "营口", value: 37 },
        { name: "惠州", value: 37 },
        { name: "江阴", value: 37 },
        { name: "蓬莱", value: 37 },
        { name: "韶关", value: 38 },
        { name: "嘉峪关", value: 38 },
        { name: "广州", value: 38 },
        { name: "延安", value: 38 },
        { name: "太原", value: 39 },
        { name: "清远", value: 39 },
        { name: "中山", value: 39 },
        { name: "昆明", value: 39 },
        { name: "寿光", value: 40 },
        { name: "盘锦", value: 40 },
        { name: "长治", value: 41 },
        { name: "深圳", value: 41 },
        { name: "珠海", value: 42 },
        { name: "宿迁", value: 43 },
        { name: "咸阳", value: 43 },
        { name: "铜川", value: 44 },
        { name: "平度", value: 44 },
        { name: "佛山", value: 44 },
        { name: "海口", value: 44 },
        { name: "江门", value: 45 },
        { name: "章丘", value: 45 },
        { name: "肇庆", value: 46 },
        { name: "大连", value: 47 },
        { name: "临汾", value: 47 },
        { name: "吴江", value: 47 },
        { name: "石嘴山", value: 49 },
        { name: "沈阳", value: 50 },
        { name: "苏州", value: 50 },
        { name: "茂名", value: 50 },
        { name: "嘉兴", value: 51 },
        { name: "长春", value: 51 },
        { name: "胶州", value: 52 },
        { name: "银川", value: 52 },
        { name: "张家港", value: 52 },
        { name: "三门峡", value: 53 },
        { name: "锦州", value: 54 },
        { name: "南昌", value: 54 },
        { name: "柳州", value: 54 },
        { name: "三亚", value: 54 },
        { name: "自贡", value: 56 },
        { name: "吉林", value: 56 },
        { name: "阳江", value: 57 },
        { name: "泸州", value: 57 },
        { name: "西宁", value: 57 },
        { name: "宜宾", value: 58 },
        { name: "呼和浩特", value: 58 },
        { name: "成都", value: 58 },
        { name: "大同", value: 58 },
        { name: "镇江", value: 59 },
        { name: "桂林", value: 59 },
        { name: "张家界", value: 59 },
        { name: "宜兴", value: 59 },
        { name: "北海", value: 60 },
        { name: "西安", value: 61 },
        { name: "金坛", value: 62 },
        { name: "东营", value: 62 },
        { name: "牡丹江", value: 63 },
        { name: "遵义", value: 63 },
        { name: "绍兴", value: 63 },
        { name: "扬州", value: 64 },
        { name: "常州", value: 64 },
        { name: "潍坊", value: 65 },
        { name: "重庆", value: 66 },
        { name: "台州", value: 67 },
        { name: "南京", value: 67 },
        { name: "滨州", value: 70 },
        { name: "贵阳", value: 71 },
        { name: "无锡", value: 71 },
        { name: "本溪", value: 71 },
        { name: "克拉玛依", value: 72 },
        { name: "渭南", value: 72 },
        { name: "马鞍山", value: 72 },
        { name: "宝鸡", value: 72 },
        { name: "焦作", value: 75 },
        { name: "句容", value: 75 },
        { name: "北京", value: 79 },
        { name: "徐州", value: 79 },
        { name: "衡水", value: 80 },
        { name: "包头", value: 80 },
        { name: "绵阳", value: 80 },
        { name: "乌鲁木齐", value: 84 },
        { name: "枣庄", value: 84 },
        { name: "杭州", value: 84 },
        { name: "淄博", value: 85 },
        { name: "鞍山", value: 86 },
        { name: "溧阳", value: 86 },
        { name: "库尔勒", value: 86 },
        { name: "安阳", value: 90 },
        { name: "开封", value: 90 },
        { name: "济南", value: 92 },
        { name: "德阳", value: 93 },
        { name: "温州", value: 95 },
        { name: "九江", value: 96 },
        { name: "邯郸", value: 98 },
        { name: "临安", value: 99 },
        { name: "兰州", value: 99 },
        { name: "沧州", value: 100 },
        { name: "临沂", value: 103 },
        { name: "南充", value: 104 },
        { name: "天津", value: 105 },
        { name: "富阳", value: 106 },
        { name: "泰安", value: 112 },
        { name: "诸暨", value: 112 },
        { name: "郑州", value: 113 },
        { name: "哈尔滨", value: 114 },
        { name: "聊城", value: 116 },
        { name: "芜湖", value: 117 },
        { name: "唐山", value: 119 },
        { name: "平顶山", value: 119 },
        { name: "邢台", value: 119 },
        { name: "德州", value: 120 },
        { name: "济宁", value: 120 },
        { name: "荆州", value: 127 },
        { name: "宜昌", value: 130 },
        { name: "义乌", value: 132 },
        { name: "丽水", value: 133 },
        { name: "洛阳", value: 134 },
        { name: "秦皇岛", value: 136 },
        { name: "株洲", value: 143 },
        { name: "石家庄", value: 147 },
        { name: "莱芜", value: 148 },
        { name: "常德", value: 152 },
        { name: "保定", value: 153 },
        { name: "湘潭", value: 154 },
        { name: "金华", value: 157 },
        { name: "岳阳", value: 169 },
        { name: "长沙", value: 175 },
        { name: "衢州", value: 177 },
        { name: "廊坊", value: 193 },
        { name: "菏泽", value: 194 },
        { name: "合肥", value: 229 },
        { name: "武汉", value: 273 },
        { name: "大庆", value: 279 }
    ];

    var geoCoordMap = {
        海门: [121.15, 31.89],
        鄂尔多斯: [109.781327, 39.608266],
        招远: [120.38, 37.35],
        舟山: [122.207216, 29.985295],
        齐齐哈尔: [123.97, 47.33],
        盐城: [120.13, 33.38],
        赤峰: [118.87, 42.28],
        青岛: [120.33, 36.07],
        乳山: [121.52, 36.89],
        金昌: [102.188043, 38.520089],
        泉州: [118.58, 24.93],
        莱西: [120.53, 36.86],
        日照: [119.46, 35.42],
        胶南: [119.97, 35.88],
        南通: [121.05, 32.08],
        拉萨: [91.11, 29.97],
        云浮: [112.02, 22.93],
        梅州: [116.1, 24.55],
        文登: [122.05, 37.2],
        上海: [121.48, 31.22],
        攀枝花: [101.718637, 26.582347],
        威海: [122.1, 37.5],
        承德: [117.93, 40.97],
        厦门: [118.1, 24.46],
        汕尾: [115.375279, 22.786211],
        潮州: [116.63, 23.68],
        丹东: [124.37, 40.13],
        太仓: [121.1, 31.45],
        曲靖: [103.79, 25.51],
        烟台: [121.39, 37.52],
        福州: [119.3, 26.08],
        瓦房店: [121.979603, 39.627114],
        即墨: [120.45, 36.38],
        抚顺: [123.97, 41.97],
        玉溪: [102.52, 24.35],
        张家口: [114.87, 40.82],
        阳泉: [113.57, 37.85],
        莱州: [119.942327, 37.177017],
        湖州: [120.1, 30.86],
        汕头: [116.69, 23.39],
        昆山: [120.95, 31.39],
        宁波: [121.56, 29.86],
        湛江: [110.359377, 21.270708],
        揭阳: [116.35, 23.55],
        荣成: [122.41, 37.16],
        连云港: [119.16, 34.59],
        葫芦岛: [120.836932, 40.711052],
        常熟: [120.74, 31.64],
        东莞: [113.75, 23.04],
        河源: [114.68, 23.73],
        淮安: [119.15, 33.5],
        泰州: [119.9, 32.49],
        南宁: [108.33, 22.84],
        营口: [122.18, 40.65],
        惠州: [114.4, 23.09],
        江阴: [120.26, 31.91],
        蓬莱: [120.75, 37.8],
        韶关: [113.62, 24.84],
        嘉峪关: [98.289152, 39.77313],
        广州: [113.23, 23.16],
        延安: [109.47, 36.6],
        太原: [112.53, 37.87],
        清远: [113.01, 23.7],
        中山: [113.38, 22.52],
        昆明: [102.73, 25.04],
        寿光: [118.73, 36.86],
        盘锦: [122.070714, 41.119997],
        长治: [113.08, 36.18],
        深圳: [114.07, 22.62],
        珠海: [113.52, 22.3],
        宿迁: [118.3, 33.96],
        咸阳: [108.72, 34.36],
        铜川: [109.11, 35.09],
        平度: [119.97, 36.77],
        佛山: [113.11, 23.05],
        海口: [110.35, 20.02],
        江门: [113.06, 22.61],
        章丘: [117.53, 36.72],
        肇庆: [112.44, 23.05],
        大连: [121.62, 38.92],
        临汾: [111.5, 36.08],
        吴江: [120.63, 31.16],
        石嘴山: [106.39, 39.04],
        沈阳: [123.38, 41.8],
        苏州: [120.62, 31.32],
        茂名: [110.88, 21.68],
        嘉兴: [120.76, 30.77],
        长春: [125.35, 43.88],
        胶州: [120.03336, 36.264622],
        银川: [106.27, 38.47],
        张家港: [120.555821, 31.875428],
        三门峡: [111.19, 34.76],
        锦州: [121.15, 41.13],
        南昌: [115.89, 28.68],
        柳州: [109.4, 24.33],
        三亚: [109.511909, 18.252847],
        自贡: [104.778442, 29.33903],
        吉林: [126.57, 43.87],
        阳江: [111.95, 21.85],
        泸州: [105.39, 28.91],
        西宁: [101.74, 36.56],
        宜宾: [104.56, 29.77],
        呼和浩特: [111.65, 40.82],
        成都: [104.06, 30.67],
        大同: [113.3, 40.12],
        镇江: [119.44, 32.2],
        桂林: [110.28, 25.29],
        张家界: [110.479191, 29.117096],
        宜兴: [119.82, 31.36],
        北海: [109.12, 21.49],
        西安: [108.95, 34.27],
        金坛: [119.56, 31.74],
        东营: [118.49, 37.46],
        牡丹江: [129.58, 44.6],
        遵义: [106.9, 27.7],
        绍兴: [120.58, 30.01],
        扬州: [119.42, 32.39],
        常州: [119.95, 31.79],
        潍坊: [119.1, 36.62],
        重庆: [106.54, 29.59],
        台州: [121.420757, 28.656386],
        南京: [118.78, 32.04],
        滨州: [118.03, 37.36],
        贵阳: [106.71, 26.57],
        无锡: [120.29, 31.59],
        本溪: [123.73, 41.3],
        克拉玛依: [84.77, 45.59],
        渭南: [109.5, 34.52],
        马鞍山: [118.48, 31.56],
        宝鸡: [107.15, 34.38],
        焦作: [113.21, 35.24],
        句容: [119.16, 31.95],
        北京: [116.46, 39.92],
        徐州: [117.2, 34.26],
        衡水: [115.72, 37.72],
        包头: [110, 40.58],
        绵阳: [104.73, 31.48],
        乌鲁木齐: [87.68, 43.77],
        枣庄: [117.57, 34.86],
        杭州: [120.19, 30.26],
        淄博: [118.05, 36.78],
        鞍山: [122.85, 41.12],
        溧阳: [119.48, 31.43],
        库尔勒: [86.06, 41.68],
        安阳: [114.35, 36.1],
        开封: [114.35, 34.79],
        济南: [117, 36.65],
        德阳: [104.37, 31.13],
        温州: [120.65, 28.01],
        九江: [115.97, 29.71],
        邯郸: [114.47, 36.6],
        临安: [119.72, 30.23],
        兰州: [103.73, 36.03],
        沧州: [116.83, 38.33],
        临沂: [118.35, 35.05],
        南充: [106.110698, 30.837793],
        天津: [117.2, 39.13],
        富阳: [119.95, 30.07],
        泰安: [117.13, 36.18],
        诸暨: [120.23, 29.71],
        郑州: [113.65, 34.76],
        哈尔滨: [126.63, 45.75],
        聊城: [115.97, 36.45],
        芜湖: [118.38, 31.33],
        唐山: [118.02, 39.63],
        平顶山: [113.29, 33.75],
        邢台: [114.48, 37.05],
        德州: [116.29, 37.45],
        济宁: [116.59, 35.38],
        荆州: [112.239741, 30.335165],
        宜昌: [111.3, 30.7],
        义乌: [120.06, 29.32],
        丽水: [119.92, 28.45],
        洛阳: [112.44, 34.7],
        秦皇岛: [119.57, 39.95],
        株洲: [113.16, 27.83],
        石家庄: [114.48, 38.03],
        莱芜: [117.67, 36.19],
        常德: [111.69, 29.05],
        保定: [115.48, 38.85],
        湘潭: [112.91, 27.87],
        金华: [119.64, 29.12],
        岳阳: [113.09, 29.37],
        长沙: [113, 28.21],
        衢州: [118.88, 28.97],
        廊坊: [116.7, 39.53],
        菏泽: [115.480656, 35.23375],
        合肥: [117.27, 31.86],
        武汉: [114.31, 30.52],
        大庆: [125.03, 46.58]
    };

    var convertData = function (data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
            }
        }
        return res;
    };

    var option = {
        // google map component
        gmap: {
            // initial options of Google Map
            // See https://developers.google.com/maps/documentation/javascript/reference/map#MapOptions for details
            // initial map center, accepts an array like [lng, lat] or an object like { lng, lat }
            center: [108.39, 39.9],
            // center: { lng: 108.39, lat: 39.9 },
            // initial map zoom
            zoom: 4,

            // whether ECharts layer should be re-rendered when the map is moving. `true` by default.
            // if false, it will only be re-rendered after the map `moveend`.
            // It's better to set this option to false if data is large.
            renderOnMoving: true,
            // the zIndex of echarts layer for Google Map. `2000` by default.
            echartsLayerZIndex: 2019,
            // whether to enable gesture handling. `true` by default.
            // since v1.4.0
            roam: true

            // More initial options...
        },
        tooltip: {
            trigger: "item"
        },
        animation: true,
        series: [
            {
                name: "PM2.5",
                type: "scatter",
                // use `amap` as the coordinate system
                coordinateSystem: "gmap",
                // data items [[lng, lat, value], [lng, lat, value], ...]
                data: convertData(data),
                symbolSize: function (val) {
                    return val[2] / 10;
                },
                encode: {
                    value: 2,
                    lng: 0,
                    lat: 1
                },
                label: {
                    formatter: "{b}",
                    position: "right",
                    show: false
                },
                itemStyle: {
                    color: "#00c1de"
                },
                emphasis: {
                    label: {
                        show: true
                    }
                }
            },
            {
                name: "Top 5",
                type: "effectScatter",
                coordinateSystem: "gmap",
                data: convertData(
                    data
                        .sort(function (a, b) {
                            return b.value - a.value;
                        })
                        .slice(0, 6)
                ),
                symbolSize: function (val) {
                    return val[2] / 10;
                },
                encode: {
                    value: 2,
                    lng: 0,
                    lat: 1
                },
                showEffectOn: "render",
                rippleEffect: {
                    brushType: "stroke"
                },
                label: {
                    formatter: "{b}",
                    position: "right",
                    show: true
                },
                itemStyle: {
                    color: "#fff",
                    shadowBlur: 10,
                    shadowColor: "#333"
                },
                zlevel: 1
            },
            {
                type: "pie",
                name: "Category",
                coordinateSystem: "gmap",
                center: [121, 23],
                radius: 20,
                data: [
                    {
                        name: "A",
                        value: 100
                    },
                    {
                        name: "B",
                        value: 80
                    },
                    {
                        name: "C",
                        value: 120
                    }
                ]
            }
        ]
    };
    // initialize chart
    var chart = echarts.init(document.getElementById("echarts-google-map"));
    chart.setOption(option);
    // get google map instance
    var gmap = chart.getModel().getComponent("gmap").getGoogleMap();
    // Add some markers to map
    var marker = new google.maps.Marker({ position: gmap.getCenter() });
    marker.setMap(gmap);
    // Add TrafficLayer to map
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(gmap);



</script>
@endsection
<!--End of Tawk.to Script-->
