<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Order;
use App\Product;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = Payment::pluck('title','id')->all();
        $products = Product::pluck('name','id')->all();
        return view('admin.orders.create', compact('payments','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'address' =>'required',
            
        ]);
        $order = Order::create($request->all());
        $order->setPayment($request->get('payments_id'));
        $order->setProducts($request->get('products'));

        return redirect()->route('orders.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $products = Product::pluck('name','id')->all();
        $payments = Payment::pluck('title','id')->all();
        return view('admin.orders.edit', compact('payments','products', 'order'
    ));
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
        $this->validate($request,[
            'address' =>'required',
        ]);

        $order = Order::find($id);
        $order->edit($request->all());
        $order->setPayment($request->get('payments_id'));
        
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('orders.index');
    }
}
