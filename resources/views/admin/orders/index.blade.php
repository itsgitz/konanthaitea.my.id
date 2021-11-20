@extends ('layouts.admin')
@section ('title', 'Orders')

@section ('content')
<div class="py-3">
    <h4>Orders Management</h4>
    <table class="table">
        <th>Order ID</th>
        <th>Customer</th>
        <th>Status Pembayaran</th>
        <th>Status Pengiriman</th>
        <th>Metode Pengiriman</th>
        <th>Total Harga</th>
        <th>Dibuat Tanggal</th>
        <th>Aksi</th>
        
        @foreach ($orders as $o)
        <tr>
            <td># {{ $o->order_id }}</td>
            <td>{{ $o->client_name }}</td>
            <td>{{ $o->order_payment_status }}</td>
            <td>{{ $o->order_delivery_status }}</td>
            <td>{{ $o->order_delivery_method }}</td>
            <td>Rp. {{ number_format( $o->order_total_amount, 2, ',', '.' ) }}</td>
            <td>{{ $o->order_created_at }}</td>
            <td>
                <a href="{{ route('admin_orders_show_get', [ 'id' => $o->order_id ]) }}">Process</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
