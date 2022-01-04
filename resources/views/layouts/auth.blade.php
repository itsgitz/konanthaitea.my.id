<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konan Thai Tea - @yield ('title')</title>
    <link href="{{ mix ('css/app.css') }}" rel="stylesheet">
    <script defer src="{{ mix ('js/app.js') }}"></script>
</head>
<body>
    <div class="container">
        @yield ('content')
    </div>
</body>
</html>
