<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        $user = User::where('id', auth()->user()->id)->first();
        $custom = Customer::where('user_id', auth()->user()->id)->first();

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

        // Make Cookie for payment
        $payment = json_decode(request()->cookie('payment'), true);
        foreach ($cart as $as) {
            $payment = [
                'order_code' => $transaksi->kode_transaksi,
                'total_bayar' => $request->total,
                'nama' => $custom->nama,
                'email' => $user->email,
                'no_hp' => $custom->no_hp,
            ];
        }

        $cookie = cookie('payment', json_encode($payment), 2880);
        return redirect()->route('payment')->cookie($cookie);
    }

    public function payment()
    {
        $payment = json_decode(request()->cookie('payment'), true);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment['order_code'],
                'gross_amount' => $payment['total_bayar'],
            ),
            'customer_details' => array(
                'first_name' => $payment['nama'],
                'email' => $payment['email'],
                'phone' => $payment['no_hp'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $url = "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken";

        return redirect()->away($url);
    }

    public function invoice()
    {
        $payment = json_decode(request()->cookie('payment'), true);
        $user = User::where('id', auth()->user()->id)->first();
        $custom = Customer::where('user_id', auth()->user()->id)->first();
        $data = Transaksi::where('kode_transaksi', $payment['order_code'])->latest()->first();
        $transaksi = Transaksi::where('kode_transaksi', $payment['order_code'])->latest()->get();

        $subTotal = 0;
        foreach ($transaksi as $item) {
            $itemPrice = $item->subtotal;
            $subTotal += $itemPrice;
        }

        $tax = $subTotal * (12 / 100);
        $totalfix = $subTotal + $tax;

        return view('Customer.Invoice.index', compact('user', 'custom', 'data', 'transaksi', 'subTotal', 'tax', 'totalfix'));
    }
}
