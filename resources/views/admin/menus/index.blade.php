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
            <h4>Menu Management</h4>
            <table class="table">
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Added At</th>
                <th>Action</th>
                
                @foreach ($menus as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</td>
                    <td>{{ $m->status }}</td>
                    <td>{{ $m->quantity }}</td>
                    <td>{{ $m->created_at }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin_menu_show', [ 'id' => $m->id ]) }}">View</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
