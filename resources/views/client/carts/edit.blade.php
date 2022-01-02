@extends ('layouts.client')
@section ('title', 'Ubah item di keranjang')

@section ('content')
<div class="py-3">
    <div class="cart-edit">
       <h3 class="fw-light">Ubah Item</h3>
        <div class="py-1"></div>

        <div class="py-3 border-top border-bottom">
            <form action="{{ route('client_cart_update', [ 'cartId' => $cart->id ]) }}" method="post">
                @csrf
                @method ('PUT')
                <div class="mb-3">
                    <input type="hidden" name="menu_name" value="{{ $cart->menu_name }}">
                    <h3 class="fw-light">{{ $cart->menu_name }}</h3>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="menu_price" value="{{ $cart->menu_price }}">
                    Rp. {{ number_format( $cart->menu_price, 2, ',', '.' ) }}
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="quantity">Jumlah</label>
                    <input id="quantity" class="form-control w-50" type="number" min="1" name="cart_quantity" value="{{ $cart->cart_quantity }}" required>
                    @error ('cart_quantity')
                        <div>
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <div class="alert alert-success fw-light">
                        <input type="hidden" name="menu_quantity" value="{{ $cart->menu_quantity }}">
                        Saat ini tersedia {{ $cart->menu_quantity }} unit
                    </div>
                </div>
                <a class="btn btn-sm btn-danger" href="{{ route('client_cart_get') }}">Batal</a>
                <input class="btn btn-sm btn-success" type="submit" value="Simpan">
            </form>
        </div>
    </div>
</div>
@endsection
