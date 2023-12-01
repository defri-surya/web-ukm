<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                @if (auth()->user() === null)
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                            Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/login" class="dropdown-item">Sign in</a>
                            <a href="{{ route('register') }}" class="dropdown-item">Sign up</a>
                        </div>
                    </div>
                @else
                    <div class="d-inline-flex align-items-center h-100">
                        <a class="text-body" href="{{ route('dashboard') }}" style="text-decoration: none">
                            <img src="{{ asset('asset') }}/icons8-user-64.png" alt="profile_image" class="shadow-sm"
                                style="width: 35px; border-radius:50%">
                            <span class="text-body mr-2">{{ auth()->user()->name }}</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                @if (auth()->user() != null)
                    <a href="/cart" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="/" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
        </div>
        <div class="col-lg-4 col-6 text-right">
        </div>
    </div>
</div>
<!-- Topbar End -->
