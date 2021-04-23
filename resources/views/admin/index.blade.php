<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titlePage }}</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--  Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="{{ $class ?? '' }}">
    <div id="app">
        @auth()
            <div class="container-fluid">
                <div class="row">
                    @include('admin.navs.sidebar')

                    <div class="col-md-10 col-lg-10 col-sm-12 col-12 p-0" id="main__area">

                        @include('admin.navs.navbar')

                        @yield('content')
                    </div>
                </div>
            </div>
        @endauth



    </div>

    <script script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Sidebar toggler
            $('.sidebar-toggler').click(function() {
                $('.sidebar').toggleClass('shown-sm', 'hidden-sm');
                const icon = $('.sidebar-toggler .material-icons');

                icon.text(icon.text() === 'close' ? 'menu' : 'close');
                icon.toggleClass('text-white', 'text-dark');
            })
        })

    </script>
</body>

</html>
