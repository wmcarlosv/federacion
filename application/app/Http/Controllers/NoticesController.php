<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use Illuminate\Support\Facades\Storage;
use App\Category;

class NoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::all();

        return view('admin.notices.index',['notices' => $notices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.notices.new',['categories' => $categories]);
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

        $notice = New Notice();
        $notice->title = $request->input('title');
        $notice->category_id = $request->input('category_id');
        $notice->description = $request->input('description');
        if($request->hasFile('image')){
            $notice->image = $request->image->store('notices');
        }else{
            $notice->image = NULL;
        }
        $notice->content = $request->input('content');
        $notice->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('notices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::findorfail($id);
        Storage::delete($notice->image);
        $notice->image = NULL;
        $notice->update();

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
        $notice = Notice::findorfail($id);
        $categories = Category::all();
        return view('admin.notices.edit',['notice' => $notice, 'categories' => $categories]);
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

        $notice = Notice::findorfail($id);
        $notice->title = $request->input('title');
        $notice->category_id = $request->input('category_id');
        $notice->description = $request->input('description');

        if($request->hasFile('image')){
            $notice->image = $request->image->store('notices');
        }

        $notice->content = $request->input('content');
        $notice->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('notices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::findorfail($id);
        Storage::delete($notice->image);
        $notice->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('notices.index');
    }
}
