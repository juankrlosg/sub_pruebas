@extends('layouts.fenix-app')
@section('content')
        <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Confirmación de pago realizado <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item"><a href="#">Suscriptores</a></li>
                        <li class="breadcrumb-item active">Pago realizado</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Confirmación </strong> de pago</h2>
                        </div>
                        <div class="body">
                            <div class="mega-card">
                                <div class="card xl-slategray" >
                                    <div class="card-header text-center bg-danger">
                                        <h6 class="pb-0 mb-0 text-white">Información importante</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row clearfix">
                                            <div class="col-lg-7 col-md-6 col-sm-12">
                                                <div class="card member-card" id="data-pay">
                                                    <div class="p-4">
                                                        <h6 class="m-t-10">Información del pago:</h6>
                                                    </div>

                                                    <div class="card-body pt-0 px-0 pull-right">
                                                        <div class="member-img float-left mt-2 ml-5">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-10 offset-1">
                                                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                    <small class="text-muted ">Mensualidad: </small>
                                                                    <h6>&dollar; {{$payment_data->amount-10}}.00</h6>
                                                                </div>
                                                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                                    <small class="text-muted ">Comisión: </small>
                                                                    <h6>$ 10.00</h6>
                                                                </div>
                                                                <hr class="mt-2 mx-3">
                                                                <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-muted">Total pagado: </span>
                                                                    </div>
                                                                    <div class="d-flex flex-column">
                                                                        <h6>${{$payment_data->amount}}.00</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row justify-content-between mt-2 mb-0 px-3">
                                                                    <div class="d-flex flex-column">
                                                                        <small class="text-muted mb-1">Metodo de pago:</small>
                                                                    </div>
                                                                    <div class="d-flex flex-column">
                                                                        <h6>Link MercadoPago</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                                    <div class="d-flex flex-column">
                                                                        <small class="text-muted mb-1">Fecha de pago:</small>
                                                                    </div>
                                                                    <div class="d-flex flex-column">
                                                                        <h6>{{\Carbon\Carbon::parse($payment_data->created_at)->format('d-m-Y h:i:s')}}</h6>
                                                                    </div>
                                                                </div>
                                                                <small class="d-flex justify-content-center text-muted">*Aplican terminos y restricciones</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-6 col-sm-12">
                                                <div class="card member-card" id="data-order">
                                                    <div class="p-4">
                                                        <h6 class="">Datos adicionales del pago</h6>
                                                    </div>
                                                    <div class="body">
                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                            <small class="text-muted ">Nombre completo del suscriptor: </small>
                                                        </div>
                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3 form-group">
                                                            <input type="text" id="id" value="{{$payment_data->id}}" hidden>
                                                            <input type="text" id="name" class="form-control focus" placeholder="Nombre registrado">
                                                        </div>
                                                        <div class="d-flex flex-row mb-0 px-3">
                                                            <button class="btn btn-round btn-success float-right saveSusc">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="bg-white" id="div-info">
                            <div class="card-body p-0 text-center">
                                <br>
                                <h6 class="title text-black" id="defaultModalLabel">Comprobante de pago</h6>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 text-center mt-0">
                                        <img class="rounded mx-auto d-block w-75" src="{{asset('assets/images/LOGO-PNG-SIN-FONDO.png')}}" alt="">
                                        <br>
                                        <img id="svg" class="img-fluid rounded mx-auto d-block w-75" src="" alt="">
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 mt-0">
                                        <br>
                                        <div class="card member-card text-black" id="data-pay">
                                            <div>
                                                <h6>Información del pago:</h6>
                                            </div>
                                            <div class="card-body pt-0 px-0 pull-right">
                                                <img class="position-absolute mr-0 pr-3 pt-3" style="width:40%;" src="{{asset('assets/images/pagado.png')}}" alt="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                            <small class="text-muted ">Mensualidad: </small>
                                                            <h6 id="monthly"></h6>
                                                        </div>
                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                            <small class="text-muted ">Comisión: </small>
                                                            <h6>$ 10.00</h6>
                                                        </div>
                                                        <hr class="mt-2 mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <div class="d-flex flex-column">
                                                                <span class="text-muted">Total pagado: </span>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <h6 id="amount"></h6>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                            <small class="text-muted ">Suscriptor: </small>
                                                            <h6 id="owner-name"></h6>
                                                        </div>
                                                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                                            <div class="d-flex flex-column">
                                                                <small class="text-muted mb-1">Metodo de pago:</small>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <h6>Link MercadoPago</h6>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <div class="d-flex flex-column">
                                                                <small class="text-muted mb-1">Fecha de pago:</small>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <h6 id="date"></h6>
                                                            </div>
                                                        </div>

                                                        <small class="d-flex justify-content-center text-muted">*Aplican terminos y restricciones</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-icon btn-round btn-danger float-right get-img"><i class="zmdi zmdi-download"></i></button>
                    </div>
                </div>

            </div>
        </div>

    <!-- Scripts -->
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/libscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/vendorscripts.bundle.js"></script>

    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/mainscripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="https://thememakker.com/templates/oreo/hospital/laravel/public/assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
        <script src="{{asset('assets/js/html2canvas.min.js')}}"></script>
        <script src="{{asset('assets/js/canvas2image.js')}}"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        swal({
            title: "Pago correcto",
            text: "Su pago ha sido procesado correctamente.\n\nA continuación, guarde el nombre del suscriptor para optener su comprobante de pago",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        })
        $('.get-img').click(function () {
            var element = $("#div-info");
            html2canvas(element, {
                onrendered: function (canvas) {
                    getCanvas = canvas;
                    var imgageData = getCanvas.toDataURL("image/jpeg");
                    // Now browser starts downloading it instead of just showing it
                    var newData = imgageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");
                    window.location.href=imgageData;
                }
            });
        });
        $('.saveSusc').click(function () {
            var id=$('#id').val();
            var name=$('#name').val();
            $.get('{{url('suscriptores/save_owner')}}/'+name+'/'+id,{},function (e) {
                if (e!='error'){
                    $('#owner-name').html(e.owner);
                    $('#amount').html('$'+e.amount+'.00');
                    $('#monthly').html('$'+(e.amount-10)+'.00');
                    $('#date').html(e.date)
                    $('#svg').attr('src','{{asset('qr-code-payments.svg')}}')
                    $('.modal').modal('show');
                }
                else{
                    swal({
                        title: "Error",
                        text: "No se ha podido realizar la operación",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true
                    });
                }
            });

        });
    </script>
    <!--End of Tawk.to Script-->
@endsection
