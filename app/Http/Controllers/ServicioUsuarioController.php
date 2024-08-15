<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\PagoServicioUsuario;
use App\Models\ServicioUsuario;
use Illuminate\Http\Request;

class ServicioUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $systemcfg=Estados::cpe();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function deudores(){
        $con_retraso=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
            ->join('users','servicio_usuario.id_usuario','=','users.id_user')
            ->join('persona','users.id_persona','=','persona.id_persona')
            ->whereDay('fecha','<=',date('d')-5)
            ->select('servicio_usuario.id_servicio_usuario','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo','servicio_usuario.fecha')
            ->get();

        return view('servicios.deudores',compact('con_retraso'));
    }

    public function detalle_deudor($id){
        $deudor=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
            ->join('users','servicio_usuario.id_usuario','=','users.id_user')
            ->join('estatus','servicio_usuario.id_estatus','=','estatus.id_estatus')
            ->join('persona','users.id_persona','=','persona.id_persona')
            ->where('servicio_usuario.id_servicio_usuario',$id)
            ->select('servicio_usuario.id_servicio_usuario','persona.nombre','persona.ap','persona.am', 'persona.telefono','servicio_usuario.IP','servicio.descripcion','servicio.costo','servicio_usuario.fecha', 'estatus.descripcion as estatus')
            ->first();

        $fecha_pago=date('d',strtotime($deudor->fecha));
        $año=date('Y');

        $estatus_pago=[];
        for ($i=1;$i<13;$i++){
            $estatus_pago[]=PagoServicioUsuario::where('fecha',$año.'-'.$i.'-'.$fecha_pago)
            ->where('id_servicio_usuario',$id)
            ->get()->count();
        }

        $config = new \RouterOS\Config([
            'host' => '172.21.0.200',
            'user' => 'admin',
            'pass' => 'Fenix2021Net',
            'port' => 8728,
        ]);
        $client = new \RouterOS\Client($config);

        return view('servicios.detalle_deudor',compact('deudor', 'estatus_pago'));
    }
}
