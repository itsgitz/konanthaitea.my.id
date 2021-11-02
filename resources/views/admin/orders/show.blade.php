<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders Details</title>
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
            <h4>Orders Details</h4>


            @if (session('process_message'))
            <div class="py-3">
                <h4 class="text-success">{{ session('process_message') }}</h4>
            </div>
            @endif

            <table class="table">
                <tr>
                    <td>Order ID</td>
                    <td># {{ $order->id }}</td>
                </tr>
                <tr>
                    <td>Item Name</td>
                    <td>{{ $order->menu_name }}</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td>{{ $order->client_name }}</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>Rp. {{ number_format( $order->total_amount, 2, ',', '.' ) }}</td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td>{{ $order->payment_status }}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{ $order->order_status }}</td>
                </tr>
            </table>
        </div>

        <div class="py-3">
            <form action="{{ route('admin_orders_post', [ 'id' => $order->id ]) }}" method="post">
                @csrf
                <input class="btn btn-primary" name="process" type="submit" value="Mark as Paid">
                <input class="btn btn-success" name="process" type="submit" value="Mark as Finish">
            </form>
        </div>

        <div class="py-3">
            <a href="{{ route('admin_orders') }}">Back</a>
        </div>
    </div>
</body>
