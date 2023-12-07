<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class WebStoreController extends Controller
{
    public function homepage()
    {
        $kategori = Kategori::all();
        $produk = Produk::take(8)->get();

        return view('Web-store.welcome', compact('kategori', 'produk'));
    }

    public function product()
    {
        return view('Web-store.product');
    }

    public function detailProduct()
    {
        return view('Web-store.product_detail');
    }

    public function cart()
    {
        return view('Web-store.cart');
    }

    public function order()
    {
        return view('Web-store.order');
    }

    public function list_ukm()
    {
        return view('Web-store.view_more_ukm');
    }
}
