@extends('layouts.back-end.main')

@section('title', 'Withdraw Now')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/withdraw">Withdraw</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Withdraw Now</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Withdraw Now</h6>
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
                                <input type="number" class="form-control" placeholder="Nominal" aria-label="Nominal"
                                    aria-describedby="password-addon" name="no"minal value="{{ old('no') }}"
                                    required autofocus>
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
