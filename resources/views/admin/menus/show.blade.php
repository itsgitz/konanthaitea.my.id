<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Menu Management</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="py-3">
            <h1 class="text-secondary">Admin Area</h1>
        </div>
        <nav>
            <a href="{{ route('admin_home') }}">Dashboard</a> |
            <a href="{{ route('admin_orders') }}">Orders</a> |
            <!-- <a href="{{ route('admin_invoices') }}">Invoices</a> | -->
            <a href="{{ route('admin_stocks') }}">Stocks</a> |
            <a href="{{ route('admin_menus') }}">Menu</a> |
            <a href="{{ route('client_home') }}">Client Area</a> |
        </nav>

        <div class="py-3">
            <h4>{{ $menu->name }} Ingredients Details</h4>
            
            <div class="py-3">
                <table class="table">
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>

                    @foreach ($menuStocks as $s)    
                    <tr>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->quantity }}</td>
                        <td>{{ $s->unit }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="py-3">
            <a href="{{ route('admin_menus') }}">Back</a>
        </div>
    </div>
</body>
