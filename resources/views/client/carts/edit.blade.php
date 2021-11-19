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
                <div class="mb-3">
                    <label class="label" for="quantity">Jumlah</label>
                    <input id="quantity" class="form-control w-25" type="number" name="cart_quantity" value="{{ $cart->cart_quantity }}">
                </div>
                <a class="btn btn-danger" href="{{ route('client_cart_get') }}">Batal</a>
                <input class="btn btn-success" type="submit" value="Simpan">
            </form>
        </div>
    </div>
</div>
@endsection
