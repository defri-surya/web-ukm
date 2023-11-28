@extends('layouts.back-end.main')

@section('title', 'Detail Withdraw')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Withdraw</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Detail Withdraw</h6>
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
                                        $tgl1 = $data->tgl_wd;
                                        $date1 = Carbon\Carbon::parse($tgl1);
                                        $formattedDate1 = $date1->locale('id')->translatedFormat('l, j F Y');
                                    @endphp
                                    <span class="mb-2 text-xs">Withdraw Date: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $formattedDate1 }}</span></span>
                                    <span class="mb-2 text-xs">Withdraw Code: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $data->kode_wd }}</span></span>
                                    <span class="mb-2 text-xs">Nominal: <span class="text-dark ms-sm-2 font-weight-bold">Rp
                                            {{ number_format($data->nominal) }}</span></span>
                                    @if ($data->status === 'Success')
                                        <span class="mb-2 text-xs">Payment Status: <span
                                                class="badge badge-sm bg-gradient-success">
                                                {{ $data->status }}</span></span>
                                    @else
                                        <span class="mb-2 text-xs">Payment Status: <span
                                                class="badge badge-sm bg-gradient-secondary">
                                                {{ $data->status }}</span></span>
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
