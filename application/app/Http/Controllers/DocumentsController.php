<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Document;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();

        return view('admin.documents.index',['documents' => $documents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.documents.new',['categories' => $categories]);
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

        $document = New Document();
        $document->title = $request->input('title');
        $document->category_id = $request->input('category_id');
        $document->description = $request->input('description');
        if($request->hasFile('image')){
            $document->image = $request->image->store('documents');
        }else{
            $document->image = NULL;
        }
        if($request->hasFile('file')){
            $document->file = $request->file->store('documents_files');
        }else{
            $document->file = NULL;
        }
        $document->content = $request->input('content');
        $document->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::findorfail($id);
        Storage::delete($document->image);
        $document->image = NULL;
        $document->update();

        print json_encode(['deleted' => 'yes']);
    }

    public function delete_document($id)
    {
        $document = Document::findorfail($id);
        Storage::delete($document->file);
        $document->file = NULL;
        $document->update();

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
        $document = Document::findorfail($id);
        $categories = Category::all();
        return view('admin.documents.edit',['document' => $document, 'categories' => $categories]);
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

        $document = Document::findorfail($id);
        $document->title = $request->input('title');
        $document->category_id = $request->input('category_id');
        $document->description = $request->input('description');
        if($request->hasFile('image')){
            $document->image = $request->image->store('documents');
        }else{
            $document->image = NULL;
        }
        if($request->hasFile('file')){
            $document->file = $request->file->store('documents_files');
        }else{
            $document->file = NULL;
        }
        $document->content = $request->input('content');
        $document->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findorfail($id);
        Storage::delete($document->image);
        Storage::delete($document->file);
        $document->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('documents.index');
    }
}
