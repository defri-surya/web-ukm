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
        $data = Transaksi::where('pengelola_id', $pengelola->id)->distinct()
            ->get(['kode_transaksi', 'tgl_transaksi', 'total', 'payment_status']);

        return view('Pengelola.Transaksi.index', compact('data'));
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
        return view('Pengelola.Transaksi.show', compact('data', 'custom', 'subTotal', 'tax', 'totalfix', 'transaksi'));
    }
}
