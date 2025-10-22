<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WILO SALE')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Contentido dimanico --}}
    <main class="container-fluid mt-04">
        @yield('content')
    </main>

    {{-- -footer- --}}
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
