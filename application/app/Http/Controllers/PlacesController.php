<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Entry;
use App\Location;
use Illuminate\Support\Facades\Storage;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();

        return view('admin.places.index',['places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entries = Entry::all();
        $locations = Location::all();
        return view('admin.places.new',['entries' => $entries, 'locations' => $locations]);
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
            'name' => 'required',
            'entry_id' => 'required',
            'location_id' => 'required'
        ]);

        $place = New Place();

        $place->name = $request->input('name');
        $place->isactive = $request->input('isactive');
        $place->entry_id = $request->input('entry_id');
        $place->phone = $request->input('phone');
        $place->location_id = $request->input('location_id');
        $place->direction = $request->input('direction');
        $place->country = $request->input('country');
        $place->city = $request->input('city');
        if($request->hasFile('image')){
            $place->image =  $request->image->store('places');
        }else{
            $place->image = NULL;
        }
        $place->description = $request->input('description');
        
        $place->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findorfail($id);
        Storage::delete($place->image);
        $place->image = NULL;
        $place->update();

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
        $place = Place::findorfail($id);
        $entries = Entry::all();
        $locations = Location::all();
        return view('admin.places.edit',['place' => $place,'entries' => $entries, 'locations' => $locations]);
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

        $place = Place::findorfail($id);
        
        $place->name = $request->input('name');
        $place->isactive = $request->input('isactive');
        $place->entry_id = $request->input('entry_id');
        $place->phone = $request->input('phone');
        $place->location_id = $request->input('location_id');
        $place->direction = $request->input('direction');
        $place->country = $request->input('country');
        $place->city = $request->input('city');

        if($request->hasFile('image')){
            $place->image =  $request->image->store('places');
        }
        
        $place->description = $request->input('description');

        $place->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findorfail($id);

        Storage::delete($place->image);

        $place->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('places.index');
    }
}
