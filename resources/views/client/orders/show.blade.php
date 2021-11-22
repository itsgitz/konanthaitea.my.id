@extends ('layouts.client')
@section ('title', 'Detail Transaksi untuk #' . $order->id)

@section ('content')
<div class="py-3">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title display-6">
                <i class="fa fa-shopping-bag text-success"></i>
                &middot;
                Order ID
                <a class="text-success" href="{{ route('client_order_show', ['id' => $order->id]) }}">#{{ $order->id }}</a>
                &middot;
            </h6>
            <div class="py-1"></div>
            @foreach ($carts as $c)
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="card-text py-2">
                        <h5 class="card-title">{{ $c->menu_name }}</h5>
                        <div class="card-text">
                            <span class="fw-light">{{ $c->cart_quantity }} minuman x Rp. {{ number_format( $c->menu_price, 2, ',', '.' ) }}</span>
                        </div>
                        <div class="card-text">
                            <span class="fw-light">Subtotal Harga</span> <strong>Rp. {{ number_format( $c->cart_subtotal_amount, 2, ',', '.' ) }}</strong>
                        </div>
                    </div>
                </li>
                <div class="py-1"></div>
            </ul>
            @endforeach
            <div class="card-text py-2">
                <h5 class="card-title">Metode Pengiriman</h5>
                <span class="fw-light">{{ $order->delivery_method }}</span>
            </div>
            <div class="card-text py-2">
                <h5 class="card-title">Status Pengiriman</h5>
                <span class="fw-light">{{ $order->delivery_status }}</span>
            </div>
            <div class="card-text py-2">
                <h5 class="card-title">Metode Pembayaran</h5>
                <span class="fw-light">{{ $order->payment_method }}</span>
            </div>
            <div class="card-text py-2">
                <h5 class="card-title">Status Pembayaran</h5>
                <span class="fw-light">{{ $order->payment_status }}</span>
            </div>
            <div class="card-text py-2">
                <h5 class="card-title">Total Bayar</h5>
                <strong>Rp. {{ number_format( $order->total_amount, 2, ',', '.' ) }}</strong>
            </div>
        </div>
    </div>

    <div class="py-3">
        <a class="btn btn-primary" href="{{ route('client_orders_get') }}">Kembali</a>
    </div>
</div>
@endsection
