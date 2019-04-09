<?php

namespace App;


use Guzzle\Http\Message\Request;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;
use Cart;
use App\User;
Use App\Product;

class Order_Product extends Model
{
    protected $table = 'order_product';
}
