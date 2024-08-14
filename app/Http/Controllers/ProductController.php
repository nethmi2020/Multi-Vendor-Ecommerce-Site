<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewAny',Product::class);
       if(Auth::user()->hasRole('admin')) {
            $products=Product::paginate(10);
        }
        else{
            $products=Product::where('seller_id','=',Auth::id())->paginate(10);
        }


        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all()->pluck('name','id');
        return view('product.create', compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('hi');
        $product=new Product();

         $product->seller_id   =  Auth::id();
         $product->category_id =  $request->category_id;
         $product->name        =  $request->name;
         $product->description =  $request->description;
         $product->price       =  $request->price;
         $product->qty         =  $request->qty;
         $product->image       =  $request->image;
        //  dd($product);
         $product->save();
         return redirect(route('products.index'));
            // ->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if($product->seller_id == Auth::id()){
            dd('hi');
        }
        abort(403);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if(Auth::user()->hasRole('admin') || $product->seller_id == Auth::id()){
            dd('hi');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
