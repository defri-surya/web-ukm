<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Pengelola;
use App\Models\Produk;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        if (auth()->user() != null) {
            if (auth()->user()->role === 'customer') {
                $custom = Customer::where('user_id', auth()->user()->id)->first();
                $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $prod = Produk::all();
                $cartCount = Cart::where('customer_id', $custom->id)->count();
                return view('front-end.welcome', compact('cat', 'prod', 'cartCount', 'custom', 'pengelola'));
            } else {
                $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $prod = Produk::all();
                return view('front-end.welcome', compact('cat', 'prod', 'pengelola'));
            }
        } else {
            $cat = Kategori::all();
            $prod = Produk::all();
            return view('front-end.welcome', compact('cat', 'prod'));
        }
    }

    public function contact()
    {
        $cat = Kategori::all();
        $custom = Customer::where('user_id', auth()->user()->id)->first();
        $cartCount = Cart::where('customer_id', $custom->id)->count();
        return view('front-end.contact', compact('cat', 'cartCount'));
    }

    public function product()
    {
        if (auth()->user() != null) {
            if (auth()->user()->role === 'customer') {
                $custom = Customer::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $produk = Produk::paginate(9);
                $cartCount = Cart::where('customer_id', $custom->id)->count();
                return view('front-end.product', compact('cat', 'produk', 'cartCount', 'custom'));
            } else {
                $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $produk = Produk::paginate(9);
                return view('front-end.product', compact('cat', 'produk', 'pengelola'));
            }
        } else {
            $cat = Kategori::all();
            $prod = Produk::paginate(9);
            return view('front-end.product', compact('cat', 'prod'));
        }
    }

    public function productdetail($id)
    {
        if (auth()->user() != null) {
            if (auth()->user()->role === 'customer') {
                $cat = Kategori::all();
                $prod = Produk::where('kode_produk', $id)->first();
                $kategori = Kategori::where('id', $prod->kategori_id)->first();
                $produk = Produk::where('kode_produk', '!=', $id)->get();
                $custom = Customer::where('user_id', auth()->user()->id)->first();
                $cartCount = Cart::where('customer_id', $custom->id)->count();
                return view('front-end.product-detail', compact('cat', 'prod', 'kategori', 'produk', 'custom', 'cartCount'));
            } else {
                $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $prod = Produk::where('kode_produk', $id)->first();
                $kategori = Kategori::where('id', $prod->kategori_id)->first();
                $produk = Produk::where('kode_produk', '!=', $id)->get();
                return view('front-end.product-detail', compact('cat', 'prod', 'pengelola', 'kategori', 'produk'));
            }
        } else {
            $cat = Kategori::all();
            $prod = Produk::where('kode_produk', $id)->first();
            $produk = Produk::where('kode_produk', '!=', $id)->get();
            $kategori = Kategori::where('id', $prod->kategori_id)->first();
            $custom = Customer::where('user_id', auth()->user()->id)->first();
            $cartCount = Cart::where('customer_id', $custom->id)->count();
            return view('front-end.product-detail', compact('cat', 'prod', 'kategori', 'produk', 'custom', 'cartCount'));
        }
    }

    public function filterProduk($slug)
    {
        if (auth()->user() != null) {
            if (auth()->user()->role === 'customer') {
                $cat = Kategori::all();
                $kategori = Kategori::where('slug', $slug)->first();
                $produk = Produk::where('kategori_id', $kategori->id)->paginate(9);
                $custom = Customer::where('user_id', auth()->user()->id)->first();
                $cartCount = Cart::where('customer_id', $custom->id)->count();
                return view('front-end.filterProduct', compact('cat', 'kategori', 'produk', 'custom', 'cartCount'));
            } else {
                $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
                $cat = Kategori::all();
                $kategori = Kategori::where('slug', $slug)->first();
                $produk = Produk::where('kategori_id', $kategori->id)->paginate(9);
                return view('front-end.filterProduct', compact('cat', 'pengelola', 'kategori', 'produk'));
            }
        } else {
            $cat = Kategori::all();
            $kategori = Kategori::where('slug', $slug)->first();
            $produk = Produk::where('kategori_id', $kategori->id)->paginate(9);
            $custom = Customer::where('user_id', auth()->user()->id)->first();
            $cartCount = Cart::where('customer_id', $custom->id)->count();
            return view('front-end.filterProduct', compact('cat', 'kategori', 'produk', 'custom', 'cartCount'));
        }
    }
}
