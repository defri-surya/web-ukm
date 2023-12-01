<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cat = Kategori::all();
        $custom = Customer::where('user_id', auth()->user()->id)->first();
        $cartCount = Cart::where('customer_id', $custom->id)->count();
        $user = User::where('id', $custom->user_id)->first();
        $cart = Cart::where('customer_id', $custom->id)->get();
        $subTotal = 0;

        foreach ($cart as $item) {
            $itemPrice = $item->total;
            $subTotal += $itemPrice;
        }

        $tax = $subTotal * (12 / 100);
        $totalfix = $subTotal + $tax;
        return view('Customer.Order.index', compact('cat', 'custom', 'user', 'cart', 'subTotal', 'tax', 'totalfix', 'cartCount'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('customer_id', $request->customer_id)->get();

        $lastTransaksi = Transaksi::latest()->first();
        $nextTransaksiId = $lastTransaksi ? $lastTransaksi->id + 1 : 1;
        $addedTransaksiId = str_pad($nextTransaksiId, 9, '0', STR_PAD_LEFT);

        foreach ($cart as $carts) {
            $transaksi = new Transaksi;
            $transaksi->pengelola_id = $carts->pengelola_id;
            $transaksi->produk_id = $carts->produk_id;
            $transaksi->qty = $carts->qty;
            $transaksi->subtotal = $carts->total;
            $transaksi->customer_id = $request->customer_id;
            $transaksi->total = $request->total;
            $transaksi->kode_transaksi = 'CO-' . $addedTransaksiId;
            $transaksi->tgl_transaksi = date('Y-m-d');
            $transaksi->payment_method = 'bank_transfer';
            $transaksi->payment_status = 'Process';
            $transaksi->save();
        }

        $addedTransaksiId++;

        Cart::truncate();

        return redirect()->route('history');
    }
}
