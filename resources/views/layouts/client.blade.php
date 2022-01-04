<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konan Thai Tea - @yield ('title')</title>
    <link href="{{ mix ('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ mix ('img/logo_2x2.png') }}" type="image/x-icon">
    <script defer src="{{ mix ('js/app.js') }}"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    @include ('shared.client_navigation')
    <div class="container">
        @yield ('content')
    </div>
    @include ('shared.footer')
</body>
</html>
