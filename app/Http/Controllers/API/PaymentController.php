<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function statusbayar(Request $request)
    {
        $json = json_decode($request->getContent());
        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        // Ubah Status Payment
        $data = Transaksi::where('kode_transaksi', $json->order_id)->get();
        if ($json->transaction_status == 'pending') {
            foreach ($data as $value) {
                $value->update([
                    'payment_status' => 'Process',
                ]);
            }
        }
        if ($json->transaction_status == 'settlement') {
            foreach ($data as $value) {
                $value->update([
                    'payment_method' => $json->payment_type,
                    'payment_status' => 'Success',
                ]);
            }
        }
        if ($json->transaction_status == 'expire') {
            foreach ($data as $value) {
                $value->update([
                    'payment_status' => 'Expired',
                ]);
            }
        }
    }
}
