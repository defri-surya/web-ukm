@extends('layouts.back-end.main')

@section('title', 'Edit Product')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/product">Product</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Product</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Edit Product</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <form role="form text-left" method="POST"
                            action="{{ route('product.update', $data->kode_produk) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Foto" aria-describedby="email-addon"
                                    name="foto_1">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->foto_1))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->foto_1) }}" alt="">
                                @endif
                                @error('foto_1')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Foto" aria-describedby="email-addon"
                                    name="foto_2">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->foto_2))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->foto_2) }}" alt="">
                                @endif
                                @error('foto_2')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Foto" aria-describedby="email-addon"
                                    name="foto_3">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->foto_3))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->foto_3) }}" alt="">
                                @endif
                                @error('foto_3')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Foto" aria-describedby="email-addon"
                                    name="foto_4">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->foto_4))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->foto_4) }}" alt="">
                                @endif
                                @error('foto_4')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama Product"
                                    aria-label="Nama Product" aria-describedby="email-addon" name="title"
                                    value="{{ old('title', $data->title) }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="kategori_id" required autofocus>
                                    <option value="">-- Kategori --</option>
                                    @foreach ($kat as $item)
                                        <option {{ $data->kategori_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Price" aria-label="Price"
                                    aria-describedby="password-addon" name="harga"
                                    value="{{ old('harga', $data->harga) }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" aria-label="Deskripsi"
                                    aria-describedby="email-addon" required autofocus cols="30" rows="5">{{ $data->deskripsi }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary my-4 mb-2">
                                    Update & Publish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
