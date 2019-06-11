<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use Illuminate\Support\Facades\Storage;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::all();

        return view('admin.entries.index',['entries' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entries.new');
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

        $entry = New Entry();
        $entry->name = $request->input('name');
        $entry->description = $request->input('description');
        if($request->hasFile('image')){
            $entry->image =  $request->image->store('entries');
        }else{
            $entry->image = NULL;
        }   
        $entry->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('entries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = Entry::findorfail($id);
        Storage::delete($entry->image);
        $entry->image = NULL;
        $entry->update();

         print json_encode(['deleted' => 'yes']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = Entry::findorfail($id);

        return view('admin.entries.edit',['entry' => $entry]);
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

        $entry = Entry::findorfail($id);
        
        $entry->name = $request->input('name');
        $entry->description = $request->input('description');

        if($request->hasFile('image')){
            $entry->image =  $request->image->store('entries');
        }

        $entry->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('entries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = Entry::findorfail($id);

        Storage::delete($entry->image);

        $entry->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('entries.index');
    }
}
