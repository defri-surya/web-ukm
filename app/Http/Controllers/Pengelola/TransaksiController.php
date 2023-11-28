<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pengelola;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
        $data = Transaksi::where('pengelola_id', $pengelola->id)->get();
        return view('Pengelola.Transaksi.index', compact('data'));
    }

    public function show($id)
    {
        $data = Transaksi::where('kode_transaksi', $id)->first();
        $custom = Customer::where('id', $data->customer_id)->first();
        $product = Produk::where('id', $data->produk_id)->first();
        return view('Pengelola.Transaksi.show', compact('data', 'custom', 'product'));
    }
}
