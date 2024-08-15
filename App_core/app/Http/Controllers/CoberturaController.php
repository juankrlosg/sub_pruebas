<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\Localidades;
use App\Models\Municipios;
use Illuminate\Http\Request;

class CoberturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function gestion(){
        $estados=Estados::where('status',2)->get();
        foreach ($estados as $estado){
            $estado->municipios=Municipios::where('status',2)
                ->where('estado_id',$estado->id)
                ->get();
        }
        foreach ($estados as $estado){
            foreach ($estado->municipios as $municipio){
                $municipio->localidades=Localidades::where('status',2)
                    ->where('municipio_id',$municipio->id)
                    ->get();
            }
        }
        //dd($estados);
        return view('cobertura.index', compact('estados'));
    }
}
