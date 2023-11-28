@extends('layouts.back-end.main')

@section('title', 'Record Transaction')

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
        <h6 class="font-weight-bolder mb-0">Record Transaction</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0"></div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Transaction Code
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product Name
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Product Code
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Transaction Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Payment Status
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $item->kode_transaksi }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            @php
                                                $prod = App\Models\Produk::where('id', $item->produk_id)->first();
                                            @endphp
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $prod->title }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->kode_produk }}</p>
                                            </td>
                                            @php
                                                $tgl1 = $item->tgl_transaksi;
                                                $date1 = Carbon\Carbon::parse($tgl1);
                                                $formattedDate1 = $date1->locale('id')->translatedFormat('l, j F Y');
                                            @endphp
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $formattedDate1 }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    Rp {{ number_format($item->total) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($item->payment_status === 'Success')
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        {{ $item->payment_status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">
                                                        {{ $item->payment_status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('transactionAdmin.show', $item->kode_transaksi) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit Product">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">
                                                <b><i>Empty Transaction!</i></b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
