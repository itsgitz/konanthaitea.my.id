@extends ('layouts.client')
@section ('title', 'Keranjang')

@section ('content')
<div class="py-3"></div>
<div class="p-3">
    @if ( !$carts->isEmpty() )
    <div class="cart-list">
        <h3 class="fw-light">Keranjang</h3>

        @foreach ($carts as $c)
        <div class="py-3 border-top border-bottom">
            <div class="py-1">
                <span class="fs-5">{{ $c->menu_name }}</span>
            </div>
            <div class="py-1">
                <strong>Rp. {{ number_format( $c->menu_price, 2, ',', '.' ) }}</strong>
            </div>
            <div class="py-1">
                <form action="{{ route('client_order_post') }}" method="post">
                    @csrf
                    <input class="form-control w-25" type="number" name="quantity" value="{{ $c->cart_quantity }}">
                </form>
                <div class="py-3">
                    <a class="btn btn-primary" href="{{ route('client_home') }}">Lanjut Memesan</a>
                </div>
            </div>
        </div>
        @endforeach
    </div> 
    @else
    <div class="cart-empty py-5">
        <div class="d-flex justify-content-center py-1">
            <h2>Keranjang belanja anda kosong</h2>
        </div>
        <div class="d-flex justify-content-center py-1">
            <a class="btn btn-primary" href="{{ route('client_home') }}">Mulai Memesan</a>
        </div>
    </div>
    @endif

</div>
@endsection
