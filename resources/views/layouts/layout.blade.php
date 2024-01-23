<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unpkg.com_trix@2.0.0_dist_trix.css') }}">

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
</head>

<body>
    @include('layouts.parts.navbar')

    <main class="container">
        @include('layouts.parts.messages.index')

        @yield('content')
    </main>

    @include('layouts.parts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
