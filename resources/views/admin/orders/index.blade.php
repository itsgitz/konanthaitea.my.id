<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders Management</title>
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
            <h4>Orders Management</h4>
            <table class="table">
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Customer</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Created At</th>
                <th>Action</th>
                
                @foreach ($orders as $o)
                <tr>
                    <td># {{ $o->id }}</td>
                    <td>{{ $o->menu_name }}</td>
                    <td>{{ $o->quantity }}</td>
                    <td>{{ $o->client_name }}</td>
                    <td>{{ $o->payment_status }}</td>
                    <td>{{ $o->order_status }}</td>
                    <td>{{ $o->created_at }}</td>
                    <td>
                        <a href="{{ route('admin_orders_show', [ 'id' => $o->id ]) }}">Process</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
