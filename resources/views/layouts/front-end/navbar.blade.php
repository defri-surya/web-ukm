<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    @foreach ($cat as $item)
                        <form action="{{ route('filterProduk', $item->slug) }}" method="GET">
                            @csrf
                            <button type="submit" class="nav-item nav-link"
                                style="border: none; background:none">{{ $item->title }}</button>
                        </form>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="/" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/welcome"
                            class="nav-item nav-link @if (Request::segment(1) == 'welcome') active @endif">Home</a>
                        <a href="/our-product"
                            class="nav-item nav-link @if (Request::segment(1) == 'our-product') active @endif">Our Products</a>
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i
                                    class="fa fa-angle-down mt-1"></i></a>
                            <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                <a href="/cart" class="dropdown-item">Shopping Cart</a>
                                <a href="/order" class="dropdown-item">Checkout</a>
                            </div>
                        </div> --}}
                        <a href="/contact-us"
                            class="nav-item nav-link @if (Request::segment(1) == 'contact-us') active @endif">Contact Us</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        @if (auth()->user() != null)
                            @if (auth()->user()->role === 'customer')
                                <a href="/cart" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle"
                                        style="padding-bottom: 2px;">{{ $cartCount }}</span>
                                </a>
                            @else
                                <a href="/cart" class="btn px-0 ml-3" hidden>
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle"
                                        style="padding-bottom: 2px;">0</span>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
