<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::pluck('title','id')->all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required',
            'description' =>  'required',
            'price'  =>  'required',
            'picture'    =>  'required|image',
        ]);

        $product = Product::create($request->all());
        $product->uploadImage($request->file('picture'));
        $product->setCategory($request->get('category_id'));
        $product->toggleStatus($request->get('status'));
        $product->toggleFeatured($request->get('is_featured'));
        
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =  Product::find($id);
        $categories = Category::pluck('title','id')->all();
        return view('admin.products.edit', compact('categories',
            'product'));
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
        $this->validate($request, [
            'name'  =>  'required',
            'description' =>  'required',
            'price'  =>  'required',
            'picture'    =>  'image',
        ]);

        $product = Product::find($id);
        $product->edit($request->all());
        $product->uploadImage($request->file('picture'));
        $product->setCategory($request->get('category_id'));
        $product->toggleStatus($request->get('status'));
        $product->toggleFeatured($request->get('is_featured'));

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product.index');
    }
}
