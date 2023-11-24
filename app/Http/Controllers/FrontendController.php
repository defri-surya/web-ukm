<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('front-end.welcome');
    }

    public function contact()
    {
        return view('front-end.contact');
    }

    public function product()
    {
        return view('front-end.product');
    }

    public function productdetail()
    {
        return view('front-end.product-detail');
    }

    public function cart()
    {
        return view('front-end.cart');
    }

    public function order()
    {
        return view('front-end.order');
    }
}
