<?php

namespace App;


use Guzzle\Http\Message\Request;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;
use Cart;
use App\User;
Use App\Product;
Use App\Order_Product;

class Order extends Model
{


    protected $fillable = ['address','payments_id','total','status'];
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_product',
            'order_id',
            'product_id'
        );
    }
    public function payments()
    {
        return $this->belongsTo(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function add($fields)
    {
        $order = new static;
        $order->fill($fields);
        $order->user_id = 1;
        $order->save();

        return $order;
    }
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
    public function remove()
    {
        $this->delete();
    }
     public function removeImage()
    {
        if($this->image != null)
        {
            Storage::delete('uploads/' . $this->image);  
        }
    }
    public function setProducts($ids)
    {
        if($ids == null) { return; }

        $this->products()->sync($ids);
    }
    public function setPayment($id)
    {
        if($id == null) { return; }

        $this->payments_id = $id;
        $this->save();
    }

    public function getProductsTitles()
    {
        $str = '';
        $products = $this->products->all();
        for($i = 0; count($products) > $i; $i++) {
            $qty = Order_Product::where('product_id', '=', $products[$i]->pivot->product_id)->
            where('order_id', '=', $products[$i]->pivot->order_id)->first()->qty;

            $str .= $products[$i]->name." $qty шт.";
            $str .= ($i == count($products) - 1) ? '' : ', ';
        }

        return $str;
    }

    public function getPaymentTitle()
    {
        if($this->payments != null)
        {
          return  $this->payments->title;
        }
        return 'Нет категории';
    }

    public function setCompleted()
    {
        $this->status = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value == null)
        {
            return $this->setStandart();
        }
        return $this->setCompleted();

    }

    public function inDone()
    {
        if($this->status)
        {
            return  'Выполнен';
        }
        return 'Ожидается';
    }

    public function orderCols()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function createOrder($request)
    {


        $user = Auth::user();
        $order = $user->order()->create([
            'total' => Cart::total(),
            'payments_id' =>$request->payments_id,
            'address' =>$request->address,
        ]);

        foreach (Cart::content() as $cData) {
            $order->orderCols()->attach($cData->id,[
                'total' => $cData->qty * $cData->price,
                'qty' => $cData->qty
            ]);
        }

        Cart::destroy();
    }

}
