@extends('layouts.back-end.main')

@section('title', 'Withdrawl Now')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/withdraw">Withdrawl</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Withdrawl Now</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Withdrawl Now</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <form role="form text-left" method="POST" action="{{ route('withdraw.store') }}">
                            @csrf

                            <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Minimal penarikan Rp 100.000"
                                    aria-label="Nominal" aria-describedby="password-addon" name="nominal"
                                    value="{{ old('nominal') }}" required autofocus>
                                @error('nominal')
                                    <div class="alert alert-danger text-white">
                                        Minimal penarikan Rp 100.000
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary my-4 mb-2">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
