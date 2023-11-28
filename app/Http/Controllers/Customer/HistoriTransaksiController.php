<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pengelola;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoriTransaksiController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        $data = Transaksi::where('customer_id', $customer->id)->get();
        return view('Customer.HistoriTransaksi.index', compact('data'));
    }

    public function show($id)
    {
        $data = Transaksi::where('kode_transaksi', $id)->first();
        $custom = Customer::where('id', $data->customer_id)->first();
        $pengelola = Pengelola::where('id', $data->pengelola_id)->first();
        $product = Produk::where('id', $data->produk_id)->first();
        return view('Customer.HistoriTransaksi.show', compact('data', 'pengelola', 'product', 'custom'));
    }
}
