<?php

namespace App\Http\Controllers;

use App\Models\Produt;
use App\Models\Category;
use App\Http\Requests\StoreProdutRequest;
use App\Http\Requests\UpdateProdutRequest;
use Illuminate\Support\Facades\Auth;

class ProdutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('hi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Produt();
        $categories = Category::all()->pluck('name','id');
        return view('product.create', compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutRequest $request)
    {
        dd('ho');
        $product=new Produt();

         $product->seller_id   =  Auth::id();
         $product->category_id =  $request->category_id;
         $product->name        =  $request->name;
         $product->description =  $request->description;
         $product->price       =  $request->price;
         $product->qty         =  $request->qty;
         $product->image       =  $request->image;
         $product->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Produt $produt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produt $produt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutRequest $request, Produt $produt)
    {
         // category_id
        // seller_id
        // name
        // description
        // price
        // qty
        // image
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produt $produt)
    {
        //
    }
}
