<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiAdminController extends Controller
{
    public function index()
    {
        $data = Transaksi::all();
        return view('Superadmin.Transaction.index', compact('data'));
    }

    public function show($id)
    {
        $data = Transaksi::where('kode_transaksi', $id)->first();
        $custom = Customer::where('id', $data->customer_id)->first();
        $product = Produk::where('id', $data->produk_id)->first();
        return view('Superadmin.Transaction.show', compact('data', 'custom', 'product'));
    }
}
