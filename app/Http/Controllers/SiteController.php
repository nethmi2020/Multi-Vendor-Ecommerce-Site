<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Events\VisitToCartEvent;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    public function index()
    {
        $cart=(Session::has('cart')) ? Session::get('cart') :[];
        $categories = Category::orderBy('created_at')->limit(3)->get();
        $products = Product::orderBy('created_at')->limit(4)->get();
        return view('shop',compact('categories','products','cart'));
    }

    public function addToCart(Product $product)
    {
        // Session::forget('cart');
        $cart=(Session::has('cart')) ? Session::get('cart') :[];

        if(isset($cart[$product->id]))
        {
            $cart[$product->id]['qty'] +=1;
        }
        else{
            $cart[$product->id]=[
                'product'=>$product,
                'qty'=>1
            ];

        }


        Session::put('cart',$cart);

        return redirect(route('shop'));
    }

    public function cart()
    {
        event(new VisitToCartEvent("test message"));
        // Session::forget('cart');
        $cart=(Session::has('cart')) ? Session::get('cart') :[];
        return view('cart',compact('cart'));
    }

    public function changeLanguage($language)
    {
        Session::put(['language' =>$language]);
        return redirect()->back();
    }
    public function apiIndex()
    {
        $response= Http::put('https://fakestoreapi.com/products/1' ,
            [
                'title'=> 'test product',
                'price'=> 13.5,
                'description'=> 'lorem ipsum set',
                'image'=> 'https://i.pravatar.cc',
                'category'=> 'electronic'
            ]);

        // dd($response->body());
       $products= Http::get('https://fakestoreapi.com/products')->object();
       return view('api-shop',compact('products'));
    }

    public function apiShow($id)
    {
       $product= Http::get('https://fakestoreapi.com/products/' .$id)->object();
    //    dd($product);
       return view('api-shop-single',compact('product'));
    }
}
