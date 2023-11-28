@extends('layouts.back-end.main')

@section('title', 'Your Product')

@section('breadcum')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Product</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Your Product</h6>
    </nav>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="/add-product" class="btn btn-outline-primary">
                            Add Product
                        </a>
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Product Code
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <img src="{{ asset($item->foto_1) }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                    <img src="{{ asset($item->foto_2) }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                    <img src="{{ asset($item->foto_3) }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                    <img src="{{ asset($item->foto_4) }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->title }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->kode_produk }}</p>
                                            </td>
                                            @php
                                                $kategori = App\Models\Kategori::where('id', $item->kategori_id)->first();
                                            @endphp
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $kategori->title }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Rp
                                                    {{ number_format($item->harga) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('product.edit', $item->kode_produk) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit Product">
                                                    Edit
                                                </a>
                                                &nbsp; |
                                                <form action="{{ route('product.delete', $item->kode_produk) }}"
                                                    method="POST" onsubmit="return confirm('Hapus Data, Anda Yakin ?')"
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
                                                <b><i>Empty Product!</i></b>
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
