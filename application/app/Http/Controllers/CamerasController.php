<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camera;

class CamerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cameras = Camera::all();

        return view('admin.cameras.index',['cameras' => $cameras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cameras.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $camera = New Camera();
        $camera->name = $request->input('name');
        $camera->description = $request->input('description');
        $camera->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('cameras.index');
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
        $camera = Camera::findorfail($id);

        return view('admin.cameras.edit',['camera' => $camera]);
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
        $request->validate([
            'name' => 'required'
        ]);

        $camera = Camera::findorfail($id);
        $camera->name = $request->input('name');
        $camera->description = $request->input('description');
        $camera->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('cameras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camera = Camera::findorfail($id);
        $camera->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('cameras.index');
    }
}
