<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pengelola;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HistoriTransaksiController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        $data = Transaksi::where('customer_id', $customer->id)->distinct()
            ->get(['kode_transaksi', 'tgl_transaksi', 'total', 'payment_status']);

        return view('Customer.HistoriTransaksi.index', compact('data'));
    }

    public function show($id)
    {
        $data = Transaksi::where('kode_transaksi', $id)->first();
        $custom = Customer::where('id', $data->customer_id)->first();
        $transaksi = Transaksi::where('kode_transaksi', $id)->get();

        $subTotal = 0;
        foreach ($transaksi as $item) {
            $itemPrice = $item->subtotal;
            $subTotal += $itemPrice;
        }

        $tax = $subTotal * (12 / 100);
        $totalfix = $subTotal + $tax;

        return view('Customer.HistoriTransaksi.show', compact('data', 'custom', 'subTotal', 'tax', 'totalfix', 'transaksi'));
    }
}
