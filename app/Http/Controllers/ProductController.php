<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Trait\TestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use TestTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($this->tt(1,2));
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
    public function store(StoreProductRequest $request)
    {

        $product=new Product();

         $product->seller_id   =  Auth::id();
         $product->category_id =  $request->category_id;
         $product->name        =  $request->name;
         $product->description =  $request->description;
         $product->price       =  $request->price;
         $product->qty         =  $request->qty;

        $path=NULL;
        if($request->file('image')){
            $path=$request->file('image')->store('products');
        }
        $product->image  =  $path;
        $product->save();
         return redirect(route('products.index'))
            ->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories=Category::all();
        if($product->seller_id == Auth::id()){

            return view('product.edit', compact('product','categories'));
        }

        abort(403);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        // echo '<pre>';
        // print_r($request->all()); // Print only the request data
        // echo '</pre>';
        // die();

        $product->category_id=$request->category_id;
        $product->seller_id=$product->seller_id;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->qty=$request->qty;


        if($request->hasFile('image')){
            if($product->image){
                \Storage::delete($product->image);
            }
            $product->image=$request->file('image')->store('products');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

       $product=Product::find($id);

       if(!$product){
        return redirect()->route('product.index')
        ->with('error','Product Not Found');
       }

        if($product->seller_id == Auth::id()){
            Product::find($id)->delete();
            return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
        }

        return redirect()->route('products.index')
        ->with('Error', 'Unauthorized');

    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

   
}
