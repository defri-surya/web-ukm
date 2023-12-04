<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cat = Kategori::all();
        $custom = Customer::where('user_id', auth()->user()->id)->first();
        $cart = Cart::where('customer_id', $custom->id)->get();
        $cartCount = Cart::where('customer_id', $custom->id)->count();
        $subTotal = 0;

        foreach ($cart as $item) {
            $itemPrice = $item->total;
            $subTotal += $itemPrice;
        }

        $tax = $subTotal * (12 / 100);
        $totalfix = $subTotal + $tax;
        return view('Customer.Cart.index', compact('cat', 'cart', 'subTotal', 'tax', 'totalfix', 'cartCount'));
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id', $request->produk_id)->first();
        $custom = Customer::where('user_id', auth()->user()->id)->first();
        $cekCart = Cart::where('produk_id', $request->produk_id)->where('customer_id', $custom->id)->exists();
        if ($cekCart) {
            toast('The product is already available in your cart!', 'info');
            return redirect()->back();
        } else {
            $data = $request->all();
            $data['total'] = $request->qty * $produk->harga;

            Cart::create($data);
            return redirect()->route('cart.index');
        }
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->route('cart.index');
    }
}
