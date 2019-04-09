<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(\Auth::check())
        {
            $products = Product::paginate(6);

            return view('pages.index',[
                'products' => $products
            ]);
        }
        else
            {
                return redirect('/login');
            }

    }
    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();
        return view('pages.show',compact('product'));
    }

    public function category($slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();

        $products = $category->products()->where('status',1)->paginate(2);

        return view('pages.category',['products' => $products]);

    }
}
