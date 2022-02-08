@inject ('cart', 'App\Http\Controllers\CartController')

@extends ('layouts.client')
@section ('title', 'Keranjang')

@section ('content')
<div class="p-3">
    @if ( !$carts->isEmpty() )

    <div class="cart-box">
        <h3 class="fw-light">Keranjang</h3>

        @include ('shared.message')

        <form action="{{ route('client_orders_post') }}" method="post">
            @csrf

            <div class="row gy-3">
                {{-- Cart List --}}
                <div class="cart-list col-md-6">
                    @foreach ($carts as $c)
                    <div class="cart-item">
                        <div class="py-1"></div>
                        <div class="py-3 border-top border-bottom">
                            <div class="py-1">
                                <h5>{{ $c->menu_name }}</h5>
                            </div>
                            <div class="py-1 fw-light">
                                <input type="hidden" name="carts[{{ $loop->index }}][cart_id]" value="{{ $c->cart_id }}">
                                <input type="hidden" name="carts[{{ $loop->index }}][cart_quantity]" value="{{ $c->cart_quantity }}">
                                <input type="hidden" name="carts[{{ $loop->index }}][menu_id]" value="{{ $c->menu_id }}">
                                <input type="hidden" name="carts[{{ $loop->index }}][menu_price]" value="{{ $c->menu_price }}">
                                Rp. {{ number_format( $c->menu_price, 2, ',', '.' ) }} x {{ $c->cart_quantity }}
                            </div>

                            {{-- Sub Total --}}
                            <span class="fw-light">
                                <input type="hidden" name="carts[{{ $loop->index }}][cart_subtotal_amount]" value="{{ $c->cart_subtotal_amount }}">
                                <span class="fw-bold">Subtotal Rp. <span id="cart-subtotal">{{ number_format( $c->cart_subtotal_amount, 2, ',', '.' ) }}</span></span>
                            </span>
                            {{-- Sub Total --}}

                            <div class="py-2"></div>
                            <div class="py-1">
                                {{-- Delete function --}}
                                <a class="d-inline btn btn-success btn-sm" href="{{ route('client_cart_edit', [ 'cartId' => $c->cart_id ]) }}">
                                    <i class="fas fa-pencil-alt"></i> Ubah
                                </a>
                                <span class="px-1"></span>
                                <a class="d-inline btn btn-danger btn-sm" href="{{ route('client_cart_delete', [ 'cartId' => $c->cart_id ]) }}">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                                {{-- Delete function --}}
                            </div>
                        </div>
                        <div class="py-1"></div>
                    </div>
                    @endforeach
                </div>
                {{-- Cart List --}}

                {{-- Total Price/Amount --}}
                <div class="cart-price-box col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Belanja</h5>
                            <div class="py-1"></div>
                            <div class="card-text fw-light border-bottom py-3">
                                Total Belanja ({{ $cart->getOnCartCount() }} jenis minuman)
                            </div>
                            <div class="py-1"></div>
                            <div class="card-text">
                                <div class="mb-3">
                                    <select id="cart-delivery" class="form-select fw-light" name="cart_delivery_method">
                                        <option value="" selected>Pilih Metode Pengiriman</option>
                                        <option value="Pickup">Pickup</option>
                                        <option value="Delivery">Delivery</option>
                                    </select>
                                    @error ('cart_delivery_method')
                                    <div>
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="py-1"></div>
                            <div class="card-text">
                                <div class="mb-3">
                                    <select id="cart-payment-method" class="form-select fw-light" name="cart_payment_method">
                                        <option value="" selected>Pilih Metode Pembayaran</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="E-money">E-money</option>
                                    </select>
                                    @error ('cart_payment_method')
                                    <div>
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="py-2"></div>
                            <div id="cart-address-box" class="card-text d-none">
                                <div class="mb-3">
                                    <select id="kecamatanKelurahan" class="form-select fw-light" name="region_value" required>
                                        <option value="" selected>Pilih Kecamatan / Kelurahan</option>
                                        @foreach ($fees as $k => $fee)
                                            @foreach ($fee['kelurahan'] as $f)
                                                @php $regionName = $fee['kecamatan'] . ' / ' . $f['name']; @endphp
                                                <option value="{{ $f['fee'] }}|{{ $regionName }}|{{ $fee['estimasi'] }}">{{ $regionName }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error ('region')
                                    <div id="address-alert">
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-light" for="address">Alamat Lengkap</label>
                                    <div class="py-1"></div>
                                    <input id="default-address" class="form-check-input" name="default-address" type="checkbox" value="{{ $client->address }}|{{ $client->phone_number }}">
                                    <label class="form-check-label fw-light" for="default-address">Gunakan alamat default</label>
                                    <div class="py-1"></div>
                                    <textarea id="cart-address" class="form-control fw-light" name="address" cols="30" rows="5"></textarea>
                                    @error ('address')
                                    <div id="address-alert">
                                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                   <label class="form-label fw-light" for="phone">Nomor HP/Telepon</label>
                                   <input id="cart-phone" class="form-control fw-light" name="phone" type="text">
                                </div>
                                @error ('phone')
                                <div id="phone-alert">
                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                </div>
                                @enderror
                            </div>
                            <div class="py-2"></div>

                            <div id="norek" class="card-text">
                                <div id="norek-bank" class="d-none">
                                    <h5 class="card-title">Nomor Rekening</h5>
                                    <span class="fw-light">BCA a.n Konan Thai Tea 604 2600600</span>
                                </div>
                                <div id="norek-va" class="d-none">
                                    <h5 class="card-title">Nomor Virtual Account</h5>
                                    <span class="fw-light">E-money 20090 081312312455</span>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div id="total-order-box" class="card-text">
                                @php
                                    $discountPrice = ( 28 * $totalAmount ) / 100;
                                    $discountPrice = $totalAmount - $discountPrice;
                                @endphp
                                <h5 class="card-title">Total Harga</h5>
                                <span id="total-order" class="card-text fw-light"></span>
                                <input id="hidden-total-order" type="hidden" value="{{ $totalAmount }}" disabled>
                            </div>
                            <div class="py-2"></div>
                            <div id="delivery-fee-box" class="card-text d-none">
                                <h5 class="card-title">Ongkos Kirim</h5>
                                <span id="delivery-fee" class="card-text fw-light"></span>
                            </div>
                            <div class="py-2"></div>
                            <div class="card-text">
                                <h5 class="card-title">Total Bayar</h5>
                                <input id="hidden-total-price" type="hidden" name="cart_total_amount" value="{{ $totalAmount }}">
                                <span id="total-price" class="card-text fw-bold"></span>
                            </div>
                            <div class="py-3"></div>
                            <div class="card-text">
                                <input id="hidden-estimasi" type="hidden" name="hidden_estimasi">
                                <input class="btn btn-success w-25" type="submit" value="Beli ({{ $cart->getOnCartCount() }})">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Total Price/Amount --}}
            </div>
        </form>

        {{-- Back Button --}}
        <div class="py-2"></div>
        <div class="card">
            <div class="card-body"><a class="btn btn-primary" href="{{ route('client_home') }}">Lanjut Belanja</a></div>
        </div>
        {{-- Back Button --}}
    </div>

    @else

    <div class="cart-empty py-5">
        <div class="d-flex justify-content-center py-1">
            <h2 class="display-5">Keranjang belanja anda kosong</h2>
        </div>
        <div class="d-flex justify-content-center py-1">
            <a class="btn btn-primary" href="{{ route('client_home') }}">Mulai Memesan</a>
        </div>
    </div>

    @endif

</div>
@endsection
