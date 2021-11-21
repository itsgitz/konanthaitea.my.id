@extends ('layouts.admin')
@section ('title', 'Proses Order')

@section ('content')
        <div class="py-3">
            <h4>Proses Order</h4>


            @if (session('process_message'))
            <div class="py-3">
                <h4 class="text-success">{{ session('process_message') }}</h4>
            </div>
            @endif

            <table class="table">
                @foreach ($cartOrders as $co)
                <tr>
                    <td><span class="fw-bold">Menu #{{ $loop->index + 1 }}</span></td>
                    <td><span class="fw-bold">{{ $co->menu_name }}</span></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{ $co->cart_quantity }}</td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td>{{ $co->client_name }}</td>
                </tr>
                <tr>
                    <td>Subtotal Harga</td>
                    <td>Rp. {{ number_format( $co->cart_subtotal_amount, 2, ',', '.' ) }}</td>
                </tr>
                @endforeach
            </table>
            
            <table class="table">
                <tr>
                    <td>Status Pembayaran</td>
                    <td>{{ $order->payment_status }}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>{{ $order->payment_method }}</td>
                </tr>
                <tr>
                    <td>Status Pengiriman</td>
                    <td>{{ $order->delivery_status }}</td>
                </tr>
                <tr>
                    <td>Metode Pengiriman</td>
                    <td>{{ $order->delivery_method }}</td>
                </tr>
                <tr>
                    <td><span class="fw-bold">Total Harga</span></td>
                    <td><span class="fw-bold">Rp. {{ number_format( $order->total_amount, 2, ',', '.' ) }}</span></td>
                </tr>
            </table>
        </div>

        <div class="py-3">
            <a class="btn btn-primary" href="{{ route('admin_orders_process', [ 'id' => $order->id, 'action' => 'mark_as_paid' ]) }}">Tandai Lunas</a>
        </div>

        <div class="py-3">
            <a href="{{ route('admin_orders_get') }}">Back</a>
        </div>

@endsection
