@extends('layouts.back-end.main')

@section('title', 'Category Product')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Category</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Category Product</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Foto
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($item->tumb === null)
                                                        <img src="{{ asset('asset') }}/noimage.png"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    @else
                                                        <img src="{{ asset($item->tumb) }}" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->title }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('category.edit', $item->id) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit Product">
                                                    Edit
                                                </a>
                                                &nbsp; |
                                                <form action="{{ route('category.delete', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus Data, Anda Yakin ?')"
                                                    style="display: inline-block">
                                                    {!! method_field('delete') . csrf_field() !!}
                                                    <button class="text-secondary font-weight-bold text-xs" type="submit"
                                                        data-toggle="tooltip" data-original-title="Delete Product"
                                                        style="background: none;
                                                        border: none;">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">
                                                <b><i>Empty Category!</i></b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-4">
                            <form role="form text-left" method="POST" action="{{ route('category.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <input type="file" class="form-control" aria-label="Tumbnail"
                                        aria-describedby="email-addon" name="tumb">
                                    <p class="text-sm">File type : png, jpg, jpeg | Max Size : 500kb</p>
                                    @error('tumb')
                                        <div class="alert alert-danger">
                                            Maaf, Ukuran gambar tidak boleh lebih dari 500kb!
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Nama Category"
                                        aria-label="Nama Category" aria-describedby="email-addon" name="title"
                                        value="{{ old('title') }}" required autofocus>
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
    </div>
@endsection
