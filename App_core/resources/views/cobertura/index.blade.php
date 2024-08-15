@extends('layouts.fenix-app')
@section('content')
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Cobertura <small class="text-muted">Bienvenido a Fenix Networks</small></h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('/inicio')}}"><i class="zmdi zmdi-home"></i> Fenix Networks</a></li>
                        <li class="breadcrumb-item active">Cobertura</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Gestión</strong> de cobertura</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach($estados as $estado)
                                            <a class="nav-link active" id="v-pills-{{$estado->descripcion}}-tab" data-toggle="pill" href="#v-pills-{{$estado->descripcion}}" role="tab" aria-controls="v-pills-{{$estado->descripcion}}" aria-selected="true">{{$estado->descripcion}}</a>
                                        @endforeach
                                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @foreach($estados as $estado)
                                            <div class="tab-pane fade show" id="v-pills-{{$estado->descripcion}}" role="tabpanel" aria-labelledby="v-pills-{{$estado->descripcion}}-tab">
                                                <ul class="nav nav-tabs">
                                                @foreach($estado->municipios as $municipio)
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{str_replace(' ','',$municipio->descripcion)}}">{{$municipio->descripcion}}</a></li>
                                                @endforeach
                                                </ul>
                                                <div class="tab-content">
                                                @foreach($estado->municipios as $municipio)
                                                        <div role="tabpanel" class="tab-pane" id="{{str_replace(' ','',$municipio->descripcion)}}"> <b>Localidades</b>
                                                            <div class="row clearfix">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="panel-group" id="accordion_{{$municipio->id}}" role="tablist" aria-multiselectable="true">
                                                                        @for($i=0; $i< sizeof($municipio->localidades);$i++)
                                                                            <div class="panel panel-primary">
                                                                                <div class="panel-heading" role="tab" id="heading{{str_replace(' ','',$municipio->localidades[$i]->descripcion)}}">
                                                                                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_{{$municipio->id}}" href="#collapse{{str_replace(' ','',$municipio->localidades[$i]->descripcion)}}" aria-expanded="false" aria-controls="collapse{{str_replace(' ','',$municipio->localidades[$i]->descripcion)}}" class="collapsed">{{$municipio->localidades[$i]->descripcion}}</a> </h4>
                                                                                </div>
                                                                                <div id="collapse{{str_replace(' ','',$municipio->localidades[$i]->descripcion)}}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="heading{{str_replace(' ','',$municipio->localidades[$i]->descripcion)}}" style="">
                                                                                    <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                                                                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                                                                        raw denim aesthetic synth nesciunt you probably haven't heard of them
                                                                                        accusamus labore sustainable VHS. </div>
                                                                                </div>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
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
    </script>
    <!--End of Tawk.to Script-->
@endsection