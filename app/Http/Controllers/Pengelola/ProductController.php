<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengelola;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
        $data = Produk::where('pengelola_id', $pengelola->id)->get();
        return view('Pengelola.Product.index', compact('data'));
    }

    public function create()
    {
        $kat = Kategori::all();
        return view('Pengelola.Product.create', compact('kat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_1' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_2' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_3' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_4' => 'image|mimes:jpg,png,jpeg|max:500',
        ]);

        $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
        $data = $request->all();
        $data['pengelola_id'] = $pengelola->id;
        $lastProduct = Produk::latest()->first();
        $nextProductId = $lastProduct ? $lastProduct->id + 1 : 1;

        // Menambahkan beberapa angka '0' sebelum kode registrasi
        $paddedProductId = str_pad($nextProductId, 9, '0', STR_PAD_LEFT);
        $data['kode_produk'] = 'PROD-' . $paddedProductId;


        if ($request->has('foto_1')) {
            $foto1 = $request->foto_1;
            $new_foto = time() . 'FotoProduct' . $foto1->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto1->move($tujuan_uploud, $new_foto);
            $data['foto_1'] = $tujuan_uploud . $new_foto;
        }

        if ($request->has('foto_2')) {
            $foto2 = $request->foto_2;
            $new_foto2 = time() . 'FotoProduct' . $foto2->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto2->move($tujuan_uploud, $new_foto2);
            $data['foto_2'] = $tujuan_uploud . $new_foto2;
        }

        if ($request->has('foto_3')) {
            $foto3 = $request->foto_3;
            $new_foto3 = time() . 'FotoProduct' . $foto3->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto3->move($tujuan_uploud, $new_foto3);
            $data['foto_3'] = $tujuan_uploud . $new_foto3;
        }

        if ($request->has('foto_4')) {
            $foto4 = $request->foto_4;
            $new_foto4 = time() . 'FotoProduct' . $foto4->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto4->move($tujuan_uploud, $new_foto4);
            $data['foto_4'] = $tujuan_uploud . $new_foto4;
        }

        Produk::create($data);

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $data = Produk::where('kode_produk', $id)->first();
        $kat = Kategori::all();
        return view('Pengelola.Product.edit', compact('data', 'kat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_1' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_2' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_3' => 'image|mimes:jpg,png,jpeg|max:500',
            'foto_4' => 'image|mimes:jpg,png,jpeg|max:500',
        ]);

        $data = $request->all();

        if ($request->has('foto_1')) {
            $foto1 = $request->foto_1;
            $new_foto = time() . 'FotoProduct' . $foto1->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto1->move($tujuan_uploud, $new_foto);
            $data['foto_1'] = $tujuan_uploud . $new_foto;
        }

        if ($request->has('foto_2')) {
            $foto2 = $request->foto_2;
            $new_foto2 = time() . 'FotoProduct' . $foto2->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto2->move($tujuan_uploud, $new_foto2);
            $data['foto_2'] = $tujuan_uploud . $new_foto2;
        }

        if ($request->has('foto_3')) {
            $foto3 = $request->foto_3;
            $new_foto3 = time() . 'FotoProduct' . $foto3->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto3->move($tujuan_uploud, $new_foto3);
            $data['foto_3'] = $tujuan_uploud . $new_foto3;
        }

        if ($request->has('foto_4')) {
            $foto4 = $request->foto_4;
            $new_foto4 = time() . 'FotoProduct' . $foto4->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto4->move($tujuan_uploud, $new_foto4);
            $data['foto_4'] = $tujuan_uploud . $new_foto4;
        }

        $produk   = Produk::where('kode_produk', $id)->first();
        $produk->update($data);

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        Produk::where('kode_produk', $id)->first()->delete();
        return redirect()->route('product.index');
    }
}
