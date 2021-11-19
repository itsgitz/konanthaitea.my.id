@extends ('layouts.client')
@section ('title', 'Ubah item di keranjang')

@section ('content')
<div class="py-3">
    <div class="cart-edit">
       <h3 class="fw-light">Ubah Item</h3> 
        
        <form action="{{ route('client_cart_update', [ 'cartId' => $cart->id ]) }}" method="post"> 
            @csrf
            @method ('PUT')
            <div class="mb-3">
                <input class="form-control w-25" type="text" aria-label="readonly" name="menu_name" value="{{ $cart->menu_name }}" readonly>
            </div>
            <div class="mb-3">
                <input class="form-control w-25" type="text" aria-label="readonly" name="menu_price" value="{{ $cart->menu_price }}" readonly> 
            </div>
            <div class="mb-3">
                <input class="form-control w-25" type="number" name="cart_quantity" value="{{ $cart->cart_quantity }}">
            </div>
            <a class="btn btn-danger" href="{{ route('client_cart_get') }}">Batal</a>
            <input class="btn btn-success" type="submit" value="Simpan">
        </form>
    </div>
</div>
@endsection
