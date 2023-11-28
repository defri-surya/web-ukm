<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawAdminController extends Controller
{
    public function index()
    {
        $data = Withdraw::all();
        return view('Superadmin.Withdraw.index', compact('data'));
    }

    public function show($id)
    {
        $data = Withdraw::where('kode_wd', $id)->first();
        return view('Superadmin.Withdraw.show', compact('data'));
    }

    public function approve($id)
    {
        $data = Withdraw::where('kode_wd', $id)->first();
        $data->update([
            'status' => 'Success'
        ]);

        return redirect()->route('withdrawAdmin.index');
    }

    public function reject($id)
    {
        $data = Withdraw::where('kode_wd', $id)->first();
        $data->update([
            'status' => 'Rejected'
        ]);

        return redirect()->route('withdrawAdmin.index');
    }
}
