@extends ('layouts.client')
@section ('title', 'Daftar Transaksi')

@section ('content')
<div class="py-3">
    <table class="table">
        <th>Order ID</th>
        <th>Status Pembayaran</th>
        <th>Metode Pembayaran</th>
        <th>Status Pengiriman</th>
        <th>Metode Pengiriman</th>
        <th>Total Harga</th>
        
        @foreach ($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->payment_status }}</td>
            <td>{{ $o->payment_method }}</td>
            <td>{{ $o->delivery_status }}</td>
            <td>{{ $o->delivery_method }}</td>
            <td><span class="fw-bold">Rp. {{ number_format( $o->total_amount, 2, ',', '.' ) }}</span></td>
        </tr>
        @endforeach
    </table>

    <div class="py-3">
        <a class="btn btn-primary" href="{{ route('client_home') }}">Kembali</a>
    </div>
</div>
@endsection
