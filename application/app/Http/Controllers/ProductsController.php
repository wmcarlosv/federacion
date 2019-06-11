<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use App\Entry;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entries = Entry::all();
        return view('admin.products.new',['entries' => $entries]);
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
            'price' => 'required',
            'entry_id' => 'required'
        ]);

        $product = New Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->entry_id = $request->input('entry_id');
        $product->description = $request->input('description');
        $product->phone = $request->input('phone');
        $product->whatsapp = $request->input('whatsapp');
        $product->email = $request->input('email');
        $product->direction = $request->input('direction');
        if($request->hasFile('cover')){
            $product->cover = $request->cover->store('products');
        }else{
            $product->cover = NULL;
        }
        $product->content = $request->input('content');
        $product->save();

        flash('Registro insertado con Exito!!')->success();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorfail($id);
        Storage::delete($product->cover);
        $product->cover = NULL;
        $product->update();

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
        $product = Product::findorfail($id);
        $entries = Entry::all();
        return view('admin.products.edit',['product' => $product, 'entries' => $entries]);
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
            'name' => 'required',
            'price' => 'required',
            'entry_id' => 'required'
        ]);

        $product = Product::findorfail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->entry_id = $request->input('entry_id');
        $product->description = $request->input('description');
        $product->phone = $request->input('phone');
        $product->whatsapp = $request->input('whatsapp');
        $product->email = $request->input('email');
        $product->direction = $request->input('direction');
        if($request->hasFile('cover')){
            $product->cover = $request->cover->store('products');
        }
        $product->content = $request->input('content');
        $product->update();

        flash('Registro actualizado con Exito!!')->success();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        Storage::delete($product->cover);
        $product->delete();

        flash('Registro Eliminado con Exito!!')->success();

        return redirect()->route('products.index');
    }
}
