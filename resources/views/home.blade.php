@extends ('layouts.client')
@section ('title', 'Order minuman favoritmu sekarang!')

@section ('content')
    <div class="py-3">
            <h1 class="text-secondary">MinumanTile</h1>
        </div>
        <div class="py-3">
            <div class="bg-secondary rounded p-2">
                <p class="text-light">Hei <i>{{ $user->name }}</i>! Order your favorite drinks!</p>
            </div>
            <div class="py-2">
                <form method="post" action="{{ route('client_logout_post') }}">
                    @csrf
                    <a href="{{ route('client_logout_post') }}" onclick="event.preventDefault();this.closest('form').submit()">Logout</a>
                </form>
                <nav>
                    <a href="{{ route('client_orders') }}">My Order</a>
                </nav>
            </div>
        </div>

        @if (session('order_message'))
        <div class="py-3">
            <h4 class="text-success">{{ session('order_message') }}</h4>
        </div>
        @endif

        <div class="row">
            @foreach ($menu as $m) 
            <div class="col-3">
                <div class="card shadow mb-5 bg-body">
                    <div class="card-body">
                        <h1 class="card-title">{{ $m->name }}</h1>
                        <p class="card-text">Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</p>
                        <p class="card-text">Quantity: 1</p>
                        <p class="card-text">Type: Pickup Order</p>
                        <div class="order-link">
                            <form action="{{ route('client_orders_post', [ 'menuId' => $m->id ]) }}" method="post">
                                @csrf
                                <input type="hidden" name="menu_price" value="{{ $m->price }}">
                                <input type="hidden" name="order_quantity" value="1">
                                <input type="hidden" name="order_type" value="Pickup">
                                <input class="btn btn-success" type="submit" value="Order Now">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
@endsection
