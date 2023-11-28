<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('asset') }}/back-end/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('asset') }}/back-end/img/favicon.png">
    <title>
        Your Profile
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('asset') }}/back-end/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('asset') }}/back-end/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('asset') }}/back-end/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('asset') }}/back-end/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layouts.back-end.sidebar')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav
            class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
            <div class="container-fluid py-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="text-white opacity-5"
                                href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
                    </ol>
                    <h6 class="text-white font-weight-bolder ms-2">Profile</h6>
                </nav>
                <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <i class="fa fa-user me-sm-1 text-white"></i>
                            <span class="d-sm-inline d-none nav-link text-white font-weight-bold px-0">
                                {{ auth()->user()->name }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('asset') }}/back-end/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            @if (empty($data->foto))
                                <img src="{{ asset('asset') }}/noimage.png" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @else
                                <img src="{{ asset($data->foto) }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $data->nama }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                Kode Register : {{ $data->kode_regis }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    @if (\Illuminate\Support\Facades\Gate::any(['isPengelola', 'isCustomer']))
                                        <a href="{{ route('edit', $data->kode_regis) }}">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Profile"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @if (empty($data->about))
                                <p class="text-sm">
                                    Not Available
                                </p>
                            @else
                                <p class="text-sm">
                                    {{ strip_tags($data->about) }}
                                </p>
                            @endif
                            <hr class="horizontal gray-light my-4">
                            <ul class="list-group">
                                @if (\Illuminate\Support\Facades\Gate::any(['isPengelola', 'isCustomer']))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Full Name:
                                        </strong> &nbsp; {{ $data->nama }}
                                    </li>
                                @endif
                                @can('isSuperadmin')
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Full Name:
                                        </strong> &nbsp; {{ $data->name }}
                                    </li>
                                @endcan
                                @if (\Illuminate\Support\Facades\Gate::any(['isPengelola', 'isCustomer']))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Username:
                                        </strong> &nbsp; {{ $user->username }}
                                    </li>
                                @endif
                                @can('isSuperadmin')
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Username:
                                        </strong> &nbsp; {{ $data->username }}
                                    </li>
                                @endcan
                                @if (empty($data->no_hp))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Mobile:
                                        </strong> &nbsp; Not Available
                                    </li>
                                @else
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Mobile:
                                        </strong> &nbsp; {{ $data->no_hp }}
                                    </li>
                                @endif
                                @if (\Illuminate\Support\Facades\Gate::any(['isPengelola', 'isCustomer']))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Email:
                                        </strong> &nbsp; {{ $user->email }}
                                    </li>
                                @endif
                                @can('isSuperadmin')
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Email:
                                        </strong> &nbsp; {{ $data->email }}
                                    </li>
                                @endcan
                                @if (empty($data->gender))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Gender:
                                        </strong> &nbsp; Not Available
                                    </li>
                                @else
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Gender:
                                        </strong> &nbsp; {{ $data->gender }}
                                    </li>
                                @endif
                                @if (empty($data->alamat))
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Address:
                                        </strong> &nbsp; Not Available
                                    </li>
                                @else
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">
                                            Address:
                                        </strong> &nbsp; {{ $data->alamat }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.back-end.footer')
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('asset') }}/back-end/js/core/popper.min.js"></script>
    <script src="{{ asset('asset') }}/back-end/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('asset') }}/back-end/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('asset') }}/back-end/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('asset') }}/back-end/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
