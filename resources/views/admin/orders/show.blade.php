@extends ('layouts.admin')
@section ('title', 'Proses Order #' . $order->id)

@section ('content')
<div id="admin-show-order" class="py-3">
    <h5>Proses Transaksi &middot; Order #{{ $order->id }}</h5>

    @include ('shared.message')

    <div id="process-order">
        <div id="carts-list">
            @foreach ($cartOrders as $cart)
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="py-2">
                        <h5 class="card-title">{{ $cart->menu_name }}</h5>
                        <div class="card-text">
                            <div class="fw-light">
                                {{ $cart->cart_quantity }} minuman x Rp. {{ number_format( $cart->menu_price, 2, ',', '.' ) }}
                            </div>
                        </div>
                        <div class="card-text">
                            <div class="fw-light">
                                Subtotal Harga <strong>Rp. {{ number_format( $cart->cart_subtotal_amount, 2, ',', '.' ) }}</strong>
                            </div>
                        </div>
                    </div>
                </li>
                <div class="py-1"></div>
            </ul>
            @endforeach
        </div>

        <div class="row gy-3">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text py-2">
                            <h5 class="card-title">Metode Pengiriman</h5>
                            <div class="fw-light">{{ $order->delivery_method }}</div>
                        </div>
                        <div class="card-text py-2">
                            <h5 class="card-title">Status Pengiriman</h5>
                            <div id="order-delivery-status" class="badge" data-order-delivery-status="{{ $order->delivery_status }}">
                                {{ $order->delivery_status }}
                            </div>
                        </div>
                        <div class="card-text py-2">
                            <h5 class="card-title">Metode Pembayaran</h5>
                            <div class="fw-light">{{ $order->payment_method }}</div>
                        </div>
                        <div class="card-text py-2">
                            <h5 class="card-title">Status Pembayaran</h5>
                            <div id="order-payment-status" class="badge" data-order-payment-status="{{ $order->payment_status }}">
                                {{ $order->payment_status }}
                            </div>
                        </div>
                        <div class="card-text py-2">
                            <h5 class="card-title">Total Bayar</h5>
                            <div class="fw-bold">Rp. {{ number_format( $order->total_amount, 2, ',', '.' ) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Perbaharui / Proses Data</h5>
                        <div class="card-text">
                            <form action="{{ route('admin_orders_process', ['id' => $order->id]) }}" method="post" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <select class="form-select fw-light" name="order_payment_status">
                                        <option value="">Status Pembayaran</option>
                                        @foreach ($paymentStatus as $status)
                                        <option
                                            value="{{ $status['value'] }}"
                                            @if ($status['selected'])
                                            selected
                                            @endif
                                        >{{ $status['value'] }}</option>
                                        @endforeach
                                    </select>
                                    @error ('order_payment_status')
                                    <div>
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <h5 class="card-title">{{ $order->delivery_method }}</h5>
                                    <div class="py-1"></div>
                                    <select class="form-select fw-light" name="order_delivery_status">
                                        <option value="">Status Pengiriman</option>
                                        @foreach ($deliveryStatus as $status)
                                        <option
                                            value="{{ $status['value'] }}"
                                            @if ($status['selected'])
                                            selected
                                            @endif
                                        >{{ $status['value'] }}</option>
                                        @endforeach
                                    </select>
                                    @error ('order_delivery_status')
                                    <div>
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>
                                <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-text">
            <a class="btn btn-danger btn-sm" href="{{ route('admin_orders_get') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
