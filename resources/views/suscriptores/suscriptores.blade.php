@extends('layouts.fenix-app')
@section('content')
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Servicios <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
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
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item active">Servicios</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Detalles generales</strong> de los servicios</h2>
                            <button class="btn btn-danger btn-round btn-icon float-right" id="add_serv"><i class="zmdi zmdi-plus"></i></button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
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
                                                        <form action="{{ route('suscriptores.destroy', $servicio->id_servicio_usuario) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-round btn-neutral text-danger delete_serv" data-id="{{$servicio->id_servicio_usuario}}"><i class="zmdi zmdi-delete"></i></button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-round btn-neutral text-warning edit-data" data-url="{{route('edit_agreement',$servicio->id_servicio_usuario)}}"><i class="zmdi zmdi-edit"></i></button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-round btn-neutral text-info view-agreement" data-url="{{route('print_agreement',$servicio->id_servicio_usuario)}}" role="button"><i class="zmdi zmdi-file"></i></button>
                                                        </form>
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
            </div>
        </div>
    </section>

    <form  method="POST" role="form" id="form_delete_suscriptor">
        {{ method_field('DELETE') }}
        @csrf
    </form>

    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/morrisscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/jvectormap.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/knob.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/index.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/plugins/sweetalert/sweetalert.min.js"></script>

    <script type="application/javascript">
        $('.view-agreement').click(function () {
            var url=$(this).data('url')
            window.open(url, '_blank')
        });
        $('.edit-data').click(function () {
            var url=$(this).data('url')
            window.location.href=url
        });
        $('#add_serv').click(function () {
            swal("Hola");
        });
        $('.delete_servv').click(function () {
            var id=$(this).data('id');
            swal({
                title: "¿Está seguro?",
                text: "Se eliminará el servicio seleccionado",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, estoy seguro!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function () {
                $("#form_delete_suscriptor").attr("action","/suscriptores/"+id).submit();
            });
        });
    </script>

@endsection