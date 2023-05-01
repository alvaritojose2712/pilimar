<?php

namespace App\Http\Controllers;

use App\Models\devoluciones;
use App\Http\Requests\StoredevolucionesRequest;
use App\Http\Requests\UpdatedevolucionesRequest;

class DevolucionesController extends Controller
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
     * @param  \App\Http\Requests\StoredevolucionesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredevolucionesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\devoluciones  $devoluciones
     * @return \Illuminate\Http\Response
     */
    public function show(devoluciones $devoluciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\devoluciones  $devoluciones
     * @return \Illuminate\Http\Response
     */
    public function edit(devoluciones $devoluciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedevolucionesRequest  $request
     * @param  \App\Models\devoluciones  $devoluciones
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedevolucionesRequest $request, devoluciones $devoluciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\devoluciones  $devoluciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(devoluciones $devoluciones)
    {
        //
    }
}
