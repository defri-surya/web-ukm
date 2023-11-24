<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pengelola;
use App\Models\User;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->role === 'superadmin') {
            $data = User::where('id', auth()->user()->id)->first();
            return view('Other.Profile.index', compact('data'));
        } elseif ($user->role === 'customer') {
            $user = User::where('id', auth()->user()->id)->first();
            $data = Customer::where('user_id', auth()->user()->id)->first();
            return view('Other.Profile.index', compact('data', 'user'));
        } else {
            $user = User::where('id', auth()->user()->id)->first();
            $data = Pengelola::where('user_id', auth()->user()->id)->first();
            return view('Other.Profile.index', compact('data', 'user'));
        }
    }

    public function edit($id)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->role === 'superadmin') {
            $data = User::where('id', auth()->user()->id)->first();
            return view('Other.Profile.edit', compact('data'));
        } elseif ($user->role === 'customer') {
            $data = Customer::where('kode_regis', $id)->first();
            return view('Other.Profile.edit', compact('data', 'user'));
        } else {
            $data = Pengelola::where('kode_regis', $id)->first();
            return view('Other.Profile.edit', compact('data', 'user'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,png,jpeg|max:500',
        ]);

        $data = $request->all();

        if ($request->has('foto')) {
            $foto = $request->foto;
            $new_foto = time() . 'FotoProfil' . $foto->getClientOriginalName();
            $tujuan_uploud = 'upload/FotoProfil/';
            $foto->move($tujuan_uploud, $new_foto);
            $data['foto'] = $tujuan_uploud . $new_foto;
        }

        $user = User::where('id', auth()->user()->id)->first();
        if ($user->role === 'customer') {
            $profil = Customer::where('kode_regis', $id)->first();
            $profil->update($data);

            $user->update([
                'name' => $profil->nama
            ]);
            return redirect()->route('profile');
        } else {
            $profil = Pengelola::where('kode_regis', $id)->first();
            $profil->update($data);

            $user->update([
                'name' => $profil->nama
            ]);
            return redirect()->route('profile');
        }
    }
}
