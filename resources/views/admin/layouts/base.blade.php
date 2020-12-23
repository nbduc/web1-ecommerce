<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('images/favicon.png') }}">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>

<body class="c-app">
    @include('admin.includes.sidebar')

    <div class="c-wrapper">
        @include('admin.includes.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @include('admin.includes.alert')
                    @yield('content')
                </div>
            </main>
            @include('admin.includes.footer')
        </div>
    </div>

    @yield('js')
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then CoreUI JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
</body>

</html>
