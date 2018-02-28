<!DOCTYPE html>
<html class="{{ $body }}" lang="nl">
<head>
    <title>{{ $meta_title }}</title>
    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
</head>
<body class="{{ $body }}">

    <main id="main">

        @yield('content')

    </main>

    @yield('scripts')

</body>
</html>