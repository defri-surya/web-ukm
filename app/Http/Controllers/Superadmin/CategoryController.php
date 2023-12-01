<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('Superadmin.Category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tumb' => 'image|mimes:jpg,png,jpeg|max:500'
        ]);

        $data = $request->all();
        $baseSlug = Str::slug($data['title'], '-');
        $data['slug'] = $baseSlug;

        if ($request->has('tumb')) {
            $foto1 = $request->tumb;
            $new_foto = time() . 'FotoProduct' . $foto1->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto1->move($tujuan_uploud, $new_foto);
            $data['tumb'] = $tujuan_uploud . $new_foto;
        }

        Kategori::create($data);
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $data = Kategori::where('id', $id)->first();
        return view('Superadmin.Category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tumb' => 'image|mimes:jpg,png,jpeg|max:500'
        ]);

        $data = $request->all();

        if ($request->has('tumb')) {
            $foto1 = $request->tumb;
            $new_foto = time() . 'FotoProduct' . $foto1->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProduct/';
            $foto1->move($tujuan_uploud, $new_foto);
            $data['tumb'] = $tujuan_uploud . $new_foto;
        }

        $kat = Kategori::where('id', $id)->first();
        $kat->update($data);
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Kategori::where('id', $id)->first()->delete();
        return redirect()->route('category.index');
    }
}
