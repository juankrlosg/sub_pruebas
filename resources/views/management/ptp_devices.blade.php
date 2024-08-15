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
                        <li class="breadcrumb-item active">Estatus Troncales</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Estatus</strong> de enlaces troncales</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabla" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th colspan="2">Origen</th>
                                        <th colspan="2">Destino</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($troncales as $troncal)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><strong>{{$troncal->origen}}</strong><br>{{$troncal->ip_o}}</td>
                                            <td class="media-middle text-center" id="origen_{{$troncal->id_troncal}}">
                                                <img class="media-object" src="{{URL::asset('assets/images/loading.gif')}}" alt="Cargando..." width="20"
                                                     height="20">
                                            </td>
                                            <td><strong>{{$troncal->destino}}</strong><br>{{$troncal->ip_d}}</td>
                                            <td class="media-middle text-center" id="destino_{{$troncal->id_troncal}}">
                                                <img class="media-object" src="{{URL::asset('assets/images/loading.gif')}}" alt="Cargando..." width="20"
                                                     height="20">
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
            var sectores = {{\Illuminate\Support\Js::from($js_troncales)}};
            for(i=0;i<sectores.length;i++){
                const ip_o=sectores[i]['ip_o']+"";
                const ip_d=sectores[i]['ip_d']+"";
                const id=sectores[i]['id_troncal'];
                const td_o=$('#origen_'+id);
                const td_d=$('#destino_'+id);
                $.get('{{url('/management/ex_ping')}}/'+ip_o,function (data) {
                    console.log(data)
                    if (data=='Ok') {
                        var html='<span id="'+id+'" class="badge badge-success" data-ip="'+ip_o+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-up"></i><br>Online</span>';
                        td_o.empty();
                        td_o.html(html);

                    }
                    else if(data=='Error' || data=='Unreachable'){
                        var html='<span id="'+id+'" class="badge badge-danger" data-ip="'+ip_o+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-down"></i><br>Offline</span>';
                        td_o.empty();
                        td_o.html(html);
                    }
                });
                $.get('{{url('/management/ex_ping')}}/'+ip_d,function (data) {
                    console.log(data)
                    if (data=='Ok') {
                        var html='<span id="'+id+'" class="badge badge-success" data-ip="'+ip_d+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-up"></i><br>Online</span>';
                        td_d.empty();
                        td_d.html(html);

                    }
                    else if(data=='Error' || data=='Unreachable'){
                        var html='<span id="'+id+'" class="badge badge-danger" data-ip="'+ip_d+'" data-id="'+id+'" onclick="refreshPing(this)"><i class="zmdi zmdi-thumb-down"></i><br>Offline</span>';
                        td_d.empty();
                        td_d.html(html);
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
