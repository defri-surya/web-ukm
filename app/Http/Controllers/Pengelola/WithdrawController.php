<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use App\Models\Transaksi;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
        $data = Withdraw::where('pengelola_id', $pengelola->id)->get();
        $WD = Withdraw::where('pengelola_id', $pengelola->id)->where('status', 'Success')->sum('nominal');
        $saldo = Transaksi::where('pengelola_id', $pengelola->id)->where('payment_status', 'Success')
            ->distinct()
            ->get('total');

        $totalSaldo = 0;
        foreach ($saldo as $item) {
            $itemPrice = $item->total;
            $totalSaldo += $itemPrice;
        }

        $afterWD = $totalSaldo - $WD;

        return view('Pengelola.Withdraw.index', compact('data', 'afterWD'));
    }

    public function create()
    {
        return view('Pengelola.Withdraw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:100000'
        ]);

        $pengelola = Pengelola::where('user_id', auth()->user()->id)->first();
        $data = $request->all();
        $data['pengelola_id'] = $pengelola->id;
        $data['status'] = 'Process';
        $lastWithdraw = Withdraw::latest()->first();
        $nextWithdrawId = $lastWithdraw ? $lastWithdraw->id + 1 : 1;

        // Menambahkan beberapa angka '0' sebelum kode registrasi
        $paddedWithdrawId = str_pad($nextWithdrawId, 7, '0', STR_PAD_LEFT);
        $data['kode_wd'] = $paddedWithdrawId;

        Withdraw::create($data);
        return redirect()->route('withdraw.index');
    }

    public function show($id)
    {
        $data = Withdraw::where('kode_wd', $id)->first();
        return view('Pengelola.Withdraw.show', compact('data'));
    }
}
