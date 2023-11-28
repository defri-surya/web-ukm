@extends('layouts.back-end.main')

@section('title', 'Detail Transaction')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transaction</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Detail Transaction</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    @php
                                        $tgl1 = $data->tgl_transaksi;
                                        $date1 = Carbon\Carbon::parse($tgl1);
                                        $formattedDate1 = $date1->locale('id')->translatedFormat('l, j F Y');
                                        $pengelola = App\Models\Pengelola::where('id', $item->pengelola_id)->first();
                                    @endphp
                                    <h6 class="mb-3 text-sm">{{ $custom->nama }}</h6>
                                    <span class="mb-2 text-xs">Pengelola: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $pengelola->nama }}</span></span>
                                    <span class="mb-2 text-xs">Transaction Date: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $formattedDate1 }}</span></span>
                                    <span class="mb-2 text-xs">Transaction Code: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $data->kode_transaksi }}</span></span>
                                    <span class="mb-2 text-xs">Product Code: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $data->kode_produk }}</span></span>
                                    <span class="mb-2 text-xs">Product Name: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $product->title }}</span></span>
                                    <span class="mb-2 text-xs">Quantity: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $data->qty }}</span></span>
                                    <span class="mb-2 text-xs">Price: <span class="text-dark ms-sm-2 font-weight-bold">Rp
                                            {{ number_format($data->harga) }}</span></span>
                                    <span class="mb-2 text-xs">Tax: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $data->pajak }}%</span></span>
                                    <span class="mb-2 text-xs">Total: <span class="text-dark ms-sm-2 font-weight-bold">Rp
                                            {{ number_format($data->total) }}</span></span>
                                    @if ($data->payment_status === 'Success')
                                        <span class="mb-2 text-xs">Payment Status: <span
                                                class="badge badge-sm bg-gradient-success">
                                                {{ $data->payment_status }}</span></span>
                                    @else
                                        <span class="mb-2 text-xs">Payment Status: <span
                                                class="badge badge-sm bg-gradient-secondary">
                                                {{ $data->payment_status }}</span></span>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
