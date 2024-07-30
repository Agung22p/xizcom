<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart',['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
            $product = Product::find($request->id);
            Cart::instance('cart')->add($request->id,$product->name,$request->quantity,$product->price)->associate('App\Models\Product');
            return redirect()->back()->with('message','Success | item has been added to cart successfully!');

    }

    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('checkout',['cartItems' => $cartItems]);
    }


    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'kabupaten' => 'required',
            'phone' => 'required',
        ]);

        $user = new User;

        $user = User::findOrfail($request->user_id);

        $user->update($request->all());
        $cartItem = Cart::instance('cart')->content();
        foreach($cartItem as $cart){
            $id = $cart->id;
            $qty = (int)$cart->qty;
            $product = Product::find($id);
            $product->update(['quantity' => ($product->quantity - $qty)]);
        }


        Cart::instance('cart')->destroy();


        $text = "Halo nama saya ".$request->name." dengan alamat: ". $request->address." ingin melanjutkan pembayaran";

        return (redirect()->route('shop.index')."<script>window.open('"."https://wa.me/6285161602149?text=$text"."', '_blank')</script>");

    }

}
