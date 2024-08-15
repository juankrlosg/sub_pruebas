<?php

namespace App\Http\Controllers;

use Acamposm\Ping\Ping;
use Acamposm\Ping\PingCommandBuilder;
use App\Models\sectors;
use App\Models\ServicioUsuario;
use App\Models\Sites;
use App\Models\Troncales;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    public function clients(){
        $servicios = ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
            ->join('users','servicio_usuario.id_usuario','=','users.id_user')
            ->join('persona','users.id_persona','=','persona.id_persona')
            //->where('persona.id_persona','<',20)
            ->select('servicio_usuario.id_servicio_usuario','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
            ->get();
        /*foreach ($servicios as $servicio) {
            $command = (new PingCommandBuilder($servicio->IP))->count(1)->packetSize(56)->ttl(1);

            try {
                $ping = (new Ping($command))->run()->host_status;
            } catch (\Exception $e) {
                $ping="error";
            }
            $ping="Ok";
            $servicio->status=$ping;
        }*/
        $js_servicios=$servicios->toArray();
        return view('management.client_devices', compact('servicios', 'js_servicios'));
    }

    public function aps(){
        $sectores = sectors::all();

        $js_sectores=$sectores->toArray();
        return view('management.ap_devices', compact('sectores', 'js_sectores'));
    }

    public function ptp(){
        $troncales = Troncales::select('id_troncal','id_site_o as origen','ip_o','id_site_d as destino','ip_d')
        ->get();
        foreach ($troncales as $troncal){
            $origen=Sites::where('id_site',$troncal->origen)->first();
            $destino=Sites::where('id_site',$troncal->destino)->first();
            $troncal->origen=$origen->descripcion;
            $troncal->destino=$destino->descripcion;
        }

        $js_troncales=$troncales->toArray();
        return view('management.ptp_devices', compact('troncales', 'js_troncales'));
    }
    public static function ex_ping($ip){
        $command = (new PingCommandBuilder($ip))->count(1);

        try {
            $ping = (new Ping($command))->run()->host_status;
        } catch (\Exception $e) {
            $ping="Error";
        }
        return $ping;
    }
}
