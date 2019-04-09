<?php
namespace App\Http\Controllers;
use App\Payment;
use App\Order;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cartItems = Cart::content();
        $payments = Payment::all();
        return view('cart.index', compact('cartItems', 'payments'));
    }

    public function addItem(Request $request, $id)
    {
        $product = Product::find($id);

        Cart::add($id, $product->name, 1, $product->price, ['img' => $product->picture]);


        return back();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back();
    }

    public function checkout(Request $request)
    {
        $this->validate($request,[
            'address'=> 'required'
        ]);
        Order::createOrder($request);

        return redirect('story')->with('status', 'Ваш заказ принят,спасибо! Ожидайте ответа.');
    }

    public function update(Request $request, $id)
    {
        $qty = $request->qty;
        $proId = $request->proId;
        $rowId = $request->rowId;
        Cart::update($rowId, $qty);
        $cartItems = Cart::content();
        return view('cart.upCart', compact('cartItems'))->with('status', 'Корзина обновлена');
        /*  $products = products::find($proId);
          $stock = $products->stock;
          if($qty<$stock){
              $msg = 'Cart is updated';
             Cart::update($id,$request->qty);
             return back()->with('status',$msg);
          }else{
               $msg = 'Please check your qty is more than product stock';
                return back()->with('error',$msg);
          }        */
    }
}