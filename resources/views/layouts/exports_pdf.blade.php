<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export - @yield ('title')</title>
    <style>
        body {
            font-family: system-ui,-apple-system, 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.8rem;
        }
        .content {
            padding-left: 0;
            padding-right: 0;
        }
        .float-start {
            float: left;
        }
        .float-none {
            float: none;
        }
        .cop-img {
            padding-right: 10px;
        }
        .text-center {
            text-align: center;
        }
        .break {
            padding: 10px;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table tr:nth-child(even){background-color: #f2f2f2;}

        .table tr:hover {background-color: #ddd;}

        .table th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #636e72;
          color: white;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="break"></div>
        <div id="cop">
            <div class="float-start cop-img">
                <img class="img-fluid" src="{{ public_path('img/logo_2x2.png') }}" alt="Konan Thai Tea - Logo" width="100">
            </div>
            <div class="text-center float-none;">
                <h2>Konan Thai Tea</h2>
                <div>
                Bandung : Jl. Budi No.5, Sukaraja, Kec. Cicendo, Kota Bandung, Jawa Barat 40175
                </div>
                <div>
                Email : konanbdg.id@gmail.com, Telepon : 085659122848, Instagram : @konan_id
                </div>
            </div>
        </div>
        <div class="break"></div>
        @yield ('content')
    </div>
</body>
