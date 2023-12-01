@extends('layouts.front-end.main')

@section('title', 'Your Cart')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <a class="breadcrumb-item text-dark" href="/our-product">Product</a>
                    <span class="breadcrumb-item active">Your Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $item)
                            @php
                                $product = App\Models\Produk::where('id', $item->produk_id)->first();
                                $pengelola = App\Models\Pengelola::where('id', $item->pengalola_id)->first();
                            @endphp
                            <tr>
                                <td class="text-left">
                                    <img src="{{ asset($product->foto_1) }}" alt="" style="width: 50px;">
                                    &nbsp;
                                    {{ $product->title }}
                                </td>
                                <td>Rp {{ number_format($product->harga) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp {{ number_format($item->total) }}</td>
                                <td>
                                    <form action="{{ route('cart.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus Produk, Anda Yakin ?')"
                                        style="display: inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="align-middle text-center" colspan="6">
                                    <strong>Your Cart is Empty!</strong>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>Rp {{ number_format($subTotal) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax (12%)</h6>
                            <h6 class="font-weight-medium">Rp {{ number_format($tax) }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>Rp {{ number_format($totalfix) }}</h5>
                        </div>
                        {{-- <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout</button> --}}
                        <a href="/order" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
