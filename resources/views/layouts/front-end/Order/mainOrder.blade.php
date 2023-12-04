<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('asset') }}/front-end/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset') }}/front-end/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('asset') }}/front-end/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset') }}/front-end/css/style.css" rel="stylesheet">

    <!-- MIDTRANS CLIENT KEY -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-ZIuQ4BWKiqlM1TO0"></script>

    @yield('css')
</head>

<body>
    @include('layouts.front-end.top-bar')

    @include('layouts.front-end.Order.navbarOrder')

    @yield('content')

    @include('layouts.front-end.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset') }}/front-end/lib/easing/easing.min.js"></script>
    <script src="{{ asset('asset') }}/front-end/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('asset') }}/front-end/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{ asset('asset') }}/front-end/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('asset') }}/front-end/js/main.js"></script>
    @stack('javascript')
</body>

</html>
