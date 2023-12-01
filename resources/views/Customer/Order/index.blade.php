@extends('layouts.front-end.Order.mainOrder')

@section('title', 'Order')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <a class="breadcrumb-item text-dark" href="/cart">Your Cart</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" placeholder="John" value="{{ $custom->nama }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com"
                                value="{{ $user->email }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input class="form-control" type="number" placeholder="+123 456 789"
                                value="{{ $custom->no_hp }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" placeholder="123 Street"
                                value="{{ $custom->alamat }}">
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                    data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping
                            Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone</label>
                                <input class="form-control" type="number" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @foreach ($cart as $item)
                            @php
                                $product = App\Models\Produk::where('id', $item->produk_id)->first();
                            @endphp
                            <div class="d-flex justify-content-between">
                                <p>{{ $product->title }} ({{ $item->qty }})</p>
                                <p>Rp {{ number_format($item->total) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-bottom pt-3 pb-2">
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
                    </div>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        @foreach ($cart as $carts)
                            <input type="hidden" name="pengelola_id" value="{{ $carts->pengelola_id }}">
                            <input type="hidden" name="produk_id" value="{{ $carts->produk_id }}">
                            <input type="hidden" name="qty" value="{{ $carts->qty }}">
                            <input type="hidden" name="subtotal" value="{{ $carts->total }}">
                        @endforeach
                        <input type="hidden" name="customer_id" value="{{ $custom->id }}">
                        <input type="hidden" name="total" value="{{ $totalfix }}">
                        <div class="bg-light p-30">
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">
                                Checkout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
@endsection
