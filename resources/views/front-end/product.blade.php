@extends('layouts.front-end.main')

@section('title', 'Our Product')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <span class="breadcrumb-item active">Product List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 col-md-12">
                <!-- Shop Product Start -->
                <div class="col-lg-12 col-md-12">
                    <div class="row pb-3">
                        @forelse ($prod as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset($item->foto_1) }}" alt=""
                                            style="height: 200px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('productdetail', $item->kode_produk) }}"><i
                                                    class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="{{ route('productdetail', $item->kode_produk) }}">
                                            {{ $item->title }}
                                        </a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${{ number_format($item->harga) }}</h5>
                                            {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-12 col-md-12 col-sm-12 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>Product Not Available!</h5>
                                    </div>
                                </div>
                            </div>
                        @endforelse

                        <div class="pagination justify-content-center col-12">
                            {{ $prod->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
    </div>
    <!-- Shop End -->
@endsection
