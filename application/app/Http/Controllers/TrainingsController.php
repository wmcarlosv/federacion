<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use Illuminate\Support\Facades\Storage;
use App\Category;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::all();

        return view('admin.trainings.index',['trainings' => $trainings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.trainings.new',['categories' => $categories]);
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
            'title' => 'required',
            'category_id' => 'required'
        ]);

        $training = New Training();
        $training->title = $request->input('title');
        $training->category_id = $request->input('category_id');
        $training->description = $request->input('description');
        if($request->hasFile('image')){
            $training->image = $request->image->store('trainings');
        }else{
            $training->image = NULL;
        }
        $training->content = $request->input('content');
        $training->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('trainings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training = Training::findorfail($id);
        Storage::delete($training->image);
        $training->image = NULL;
        $training->update();

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
        $training = Training::findorfail($id);
        $categories = Category::all();
        return view('admin.trainings.edit',['training' => $training, 'categories' => $categories]);
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
            'title' => 'required'
        ]);

        $training = Training::findorfail($id);
        $training->title = $request->input('title');
        $training->category_id = $request->input('category_id');
        $training->description = $request->input('description');

        if($request->hasFile('image')){
            $training->image = $request->image->store('trainings');
        }

        $training->content = $request->input('content');
        $training->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('trainings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training = Training::findorfail($id);
        Storage::delete($training->image);
        $training->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('trainings.index');
    }
}
