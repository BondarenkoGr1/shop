<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orders();
        return view('pages.orders',['orders' => $orders]);
    }
}
