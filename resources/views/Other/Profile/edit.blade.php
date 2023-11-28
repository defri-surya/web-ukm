@extends('layouts.back-end.main')

@section('title', 'Edit Profile')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/profile">Profile</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Profile</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Edit Profile</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <form role="form text-left" method="POST" action="{{ route('update-profile', $data->kode_regis) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="Foto" aria-describedby="email-addon"
                                    name="foto">
                                <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                @if (empty($data->foto))
                                    <img width="150" src="{{ asset('asset') }}/noimage.png" alt="">
                                @else
                                    <img width="150" src="{{ asset($data->foto) }}" alt="">
                                @endif
                                @error('foto')
                                    <div class="alert alert-danger">
                                        Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama Lengkap"
                                    aria-label="Nama Lengkap" aria-describedby="email-addon" name="nama"
                                    value="{{ old('name', $data->nama) }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="gender" required autofocus>
                                    <option value="">Gender</option>
                                    <option {{ $data->gender == 'Laki-Laki' ? 'selected' : '' }} value="Laki-Laki">
                                        Laki-Laki
                                    </option>
                                    <option {{ $data->gender == 'Perempuan' ? 'selected' : '' }} value="Perempuan">
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea name="alamat" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="email-addon"
                                    required autofocus cols="30" rows="2">{{ $data->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Mobile" aria-label="Mobile"
                                    aria-describedby="password-addon" name="no_hp"
                                    value="{{ old('no_hp', $data->no_hp) }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <textarea name="about" class="form-control" placeholder="About" aria-label="About" aria-describedby="email-addon"
                                    required autofocus cols="30" rows="5">{{ $data->about }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary my-4 mb-2">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
