<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\Localidades;
use App\Models\Municipios;
use App\Models\Servicio;
use App\Models\ServicioUsuario;
use App\Models\TipoPaquete;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicios = ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
            ->join('users','servicio_usuario.id_usuario','=','users.id_user')
            ->join('persona','users.id_persona','=','persona.id_persona')
            ->select('servicio_usuario.id_servicio_usuario','servicio_usuario.id_servicio','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
            ->get();
        return view('suscriptores.suscriptores', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados=Estados::orderBy('nombre')
            ->get();
        return view('servicios.agregar', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('servicios.nuevo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function planes(){
        $paquetes=TipoPaquete::orderBy('id_tipo_paquete')->get();
        foreach ($paquetes as $paquete){
            $paquete->planes=Servicio::where('id_tipo_paquete',$paquete->id_tipo_paquete)->get();
        }

        return view('servicios.planes-y-paquetes', compact('paquetes'));
    }

    public function get_municipios($estado){
        return $municipios=Municipios::select('id', 'nombre')->where('estado_id',$estado)->where('activo',1)->orderBy('nombre')->get()->toArray();
    }
    public function get_localidades($municipio){
        return $localidades=Localidades::select('id', 'nombre')->where('municipio_id',$municipio)->where('activo',1)->orderBy('nombre')->get()->toArray();
    }
}
