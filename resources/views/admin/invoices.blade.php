<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Invoices Management</title>
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
            <a href="{{ route('admin_invoices') }}">Invoices</a> |
            <a href="{{ route('admin_stocks') }}">Stocks</a> |
            <a href="{{ route('admin_menus') }}">Menu</a> |
            <a href="{{ route('client_home') }}">Client Area</a> |
        </nav>

        <div class="py-3">
            <h4>Invoices Management</h4>
            <table class="table">
                <th>ID</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Created At</th>
                
                @foreach ($invoices as $i)
                <tr>

                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
