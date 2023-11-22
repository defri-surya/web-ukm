<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pengelola;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    public function createPengelola()
    {
        return view('auth.registerPengelola');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mendapatkan kode registrasi berikutnya dari entri sebelumnya
        $lastCustomer = Customer::latest()->first();
        $nextCustomerId = $lastCustomer ? $lastCustomer->id + 1 : 1;

        $lastPengelola = Pengelola::latest()->first();
        $nextPengelolaId = $lastPengelola ? $lastPengelola->id + 1 : 1;

        // Menambahkan beberapa angka '0' sebelum kode registrasi
        $paddedCustomerId = str_pad($nextCustomerId, 6, '0', STR_PAD_LEFT);
        $paddedPengelolaId = str_pad($nextPengelolaId, 6, '0', STR_PAD_LEFT);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->role === 'customer') {
            Customer::create([
                'user_id' => $user->id,
                'kode_regis' => 'CUST-' . $paddedCustomerId,
                'nama' => $user->name,
            ]);
        }

        if ($request->role === 'pengelola') {
            Pengelola::create([
                'user_id' => $user->id,
                'kode_regis' => 'ADM-' . $paddedPengelolaId,
                'nama' => $user->name,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
