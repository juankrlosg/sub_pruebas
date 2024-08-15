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
                        <li class="breadcrumb-item active">Estatus APs</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Estatus</strong> de puntos de acceso</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabla" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descripcion</th>
                                        <th>IP</th>
                                        <th>Estatus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sectores as $sector)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$sector->descripcion}}</td>
                                            <td>{{$sector->ip}}</td>
                                            <td class="media-middle text-center" id="{{$sector->id_sector}}">
                                                <img class="media-object" src="{{URL::asset('assets/images/loading.gif')}}" alt="Cargando..." width="20"
                                                     height="20">
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
            var sectores = {{\Illuminate\Support\Js::from($js_sectores)}};
            for(i=0;i<sectores.length;i++){
                const ip=sectores[i]['ip']+"";
                const id=sectores[i]['id_sector'];
                const td=$('#'+id);
                $.get('{{url('/management/ex_ping')}}/'+ip,function (data) {
                    console.log(data)
                    if (data=='Ok') {
                        var html='<div class="page-item active"><span id="'+id+'" class="refresh-ping page-link" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)">Online</span></div>';
                        td.empty();
                        td.html(html);
                        td.toggleClass('pagination pagination-success')
                    }
                    else if(data=='Error' || data=='Unreachable'){
                        var html='<div class="page-item active"><span id="'+id+'" class="refresh-ping page-link" data-ip="'+ip+'" data-id="'+id+'" onclick="refreshPing(this)">Offline</span></div>';
                        td.empty();
                        td.html(html);
                        td.toggleClass('pagination pagination-danger')
                    }
                });
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
