<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return proveedor::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($empresa, $rfc, $giro)
    {
        $response = proveedor::create([
            'empresa' => $empresa,
            'rfc' => $rfc,
            'giro' => $giro
        ]);

        if ($response !== null) {
            return $response;
        } else {
            return false;
        }
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
     * @param  \App\Models\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id_proveedor)
    {
        return proveedor::where('id_proveedor', $id_proveedor)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id_proveedor, $empresa, $rfc, $giro)
    {
        $response = proveedor::where('id_proveedor', $id_proveedor)->create([
            'empresa' => $empresa,
            'rfc' => $rfc,
            'giro' => $giro
        ]);

        if ($response !== null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_proveedor)
    {
        return proveedor::where('id_proveedor', $id_proveedor)->destroy();
    }
}
