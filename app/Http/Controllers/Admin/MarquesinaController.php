<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Marquesina\StoreMarquesinaRequest;
use App\Http\Requests\Marquesina\UpdateMarquesinaRequest;

use App\Models\Marquesina;

class MarquesinaController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        $marquesinas = Marquesina::all();

        return view("admin.marquesinas.index", compact('marquesinas'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        return view("admin.marquesinas.create");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreMarquesinaRequest $request)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Marquesina $marquesina)
    {
        $marquesinas = Marquesina::all();

        return view("admin.marquesinas.show", compact('marquesinas'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Marquesina $marquesina)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateMarquesinaRequest $request, Marquesina $marquesina)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Marquesina $marquesina)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
