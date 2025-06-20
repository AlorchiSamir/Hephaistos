<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alorchi Samir">
    <title>Laravel</title>
    @stack('libs')
    <link rel="stylesheet" href="https://unpkg.com/devextreme-quill@0.9.5/dist/dx-quill.core.css">

    <script src="https://cdn3.devexpress.com/jslib/21.2.6/js/dx-quill.min.js"></script>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.2.5/css/dx.light.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{!! asset('/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('/vendor/sb-admin-2.min.css') !!}" rel="stylesheet">


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.5/js/dx.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script type="text/javascript" src="{!! asset('/js/Utils.js') !!}"></script>
    @stack('headers')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    @include('components.leftmenu')
    <div id="content-wrapper" class="d-flex flex-column">
        @include('components.top')
        <div class="container-fluid">
            {{ $slot }}
            @yield('content')
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<script src="{!! asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
<script src="{!! asset('/vendor/sb-admin-2.min.js') !!}></script>

</body>

</html>
