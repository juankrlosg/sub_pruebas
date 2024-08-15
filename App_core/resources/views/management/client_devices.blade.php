@extends('layouts.fenix-app')
@section('content')
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Estatus <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Mantenimiento</a></li>
                        <li class="breadcrumb-item active">Estatus equipo</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Estatus</strong> de los suscriptores</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabla" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>IP</th>
                                        <th>Estatus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($servicios as $servicio)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$servicio->nombre}}</td>
                                            <td>{{$servicio->ap}}</td>
                                            <td>{{$servicio->am}}</td>
                                            <td>{{$servicio->IP}}</td>
                                            <td class="media-middle text-center" id="{{$servicio->id_servicio_usuario}}">
                                                <span id="'+id+'" class="badge badge-default"><i class="zmdi zmdi-spinner zmdi-hc-spin"></i><br>Cargando</span>

                                               {{-- <img class="media-object" src="{{URL::asset('assets/images/loading.gif')}}" alt="Cargando..." width="20"
                                                height="20">--}}
                                            </td>
{{--                                            <td id="{{$servicio->id_servicio_usuario}}" data-ip="{{$servicio->IP}}" class="pagination {{$servicio->status=='Ok'?'pagination-success':'pagination-danger'}} content-center text-center">--}}
{{--                                                <div class="page-item active"><span class="refresh-ping page-link" data-ip="{{$servicio->IP}}" data-id="{{$servicio->id_servicio_usuario}}">{{$servicio->status=='Ok'?'Online':($servicio->status=='Unreachable'?'Offline':'Error')}}</span></div>--}}
{{--                                            </td>--}}

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
    </section>
    <!-- Scripts -->
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/tables/jquery-datatable.js"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">


        $(document).ready(function () {
            var servicios = {{\Illuminate\Support\Js::from($js_servicios)}};
            for(i=0;i<servicios.length;i++){
                const ip=servicios[i]['IP']+"";
                const id=servicios[i]['id_servicio_usuario'];
                const td=$('#'+id);

                $.get('{{url('/management/ex_ping')}}/'+ip,function (data) {
                    console.log(data)
                    if (data=='Ok') {
                        var html='<span id="'+id+'" class="badge badge-success" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-up"></i><br>Online</span>';
                        td.empty();
                        td.html(html);
                    }
                    else if(data=='Error' || data=='Unreachable'){
                        var html='<span id="'+id+'" class="badge badge-danger" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-down"></i><br>Online</span>';
                        td.empty();
                        td.html(html);
                    }
                });

                /*var url = 'http://'+ip;
                console.log(url);
                status=$.ajax({url: url,
                    type: "HEAD",
                    timeout:500,
                    statusCode: {
                        200: function (response) {
                            var html='<div class="page-item active"><span id="'+id+'" class="refresh-ping page-link" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)">Online</span></div>';
                            td.empty();
                            td.html(html);
                            td.toggleClass('pagination pagination-success')
                        },
                        400: function (response) {
                            var html='<div class="page-item active"><span id="'+id+'" class="refresh-ping page-link" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)">Offline</span></div>';
                            td.empty();
                            td.html(html);
                            td.toggleClass('pagination pagination-danger')
                        },
                        0: function (response) {
                            var html='<div class="page-item active"><span id="'+id+'" class="refresh-ping page-link" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)">Offline</span></div>';
                            td.empty();
                            td.html(html);
                            td.toggleClass('pagination pagination-danger')
                        }
                    }
                });*/
            }
        });

        function refreshPing (element) {
            //alert($(this).data('ip'))
            var span_status=element;
            var ip=element.dataset.ip;
            var span_origin=$('span#'+ip);
            span_origin.hide();
            var id_servicio_u=element.dataset.id;
            var url = 'http://'+ip;
            $.ajax({url: url,
                type: "HEAD",
                timeout:1000,
                statusCode: {
                    200: function (response) {
                        var td=$('#'+id_servicio_u);
                        td.addClass('pagination-success')
                        td.removeClass('pagination-danger')
                        span_origin.empty().html('Online')
                    },
                    400: function (response) {
                        var td=$('#'+id_servicio_u);
                        td.removeClass('pagination-success')
                        td.addClass('pagination-danger')
                        span_origin.empty().html('Offline')
                    },
                    0: function (response) {
                        var td=$('#'+id_servicio_u);
                        td.removeClass('pagination-success')
                        td.addClass('pagination-danger')
                        span_origin.empty().html('Offline')
                    }
                }
            });
            span_origin.fadeIn(500);
        };

        $('#tabla').DataTable( {
            paging: false
        } );
    </script>
    <!--End of Tawk.to Script-->
@endsection
