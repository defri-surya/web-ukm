@extends('layouts.back-end.main')

@section('title', 'Edit Category')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/category">Category</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Category</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Edit Category</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <form role="form text-left" method="POST" action="{{ route('category.update', $data->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Tumbnail"
                                    aria-describedby="email-addon" name="tumb">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->tumb))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->tumb) }}" alt="">
                                @endif
                                @error('tumb')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama Category"
                                    aria-label="Nama Category" aria-describedby="email-addon" name="title"
                                    value="{{ old('title', $data->title) }}" required autofocus>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary my-4 mb-2">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
