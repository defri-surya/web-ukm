<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        return view('Superadmin.Product.index', compact('data'));
    }
}
