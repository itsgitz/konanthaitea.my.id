@extends ('layouts.client')
@section ('title', 'Order minuman favoritmu sekarang!')

@section ('content')

@include ('shared.message')

<div class="py-3">
    @if (!$menu->isEmpty())
    <div class="row">
        @foreach ($menu as $m) 
        <div class="col-md-3">
            <div class="card shadow mb-5 bg-body">
                <div class="card-body">
                    <h1 class="card-title">{{ $m->name }}</h1>
                    <p class="card-text">Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</p>
                    <p class="card-text">{{ $m->status }}</p>
                    <div class="order-link">
                        <form action="{{ route('client_cart_post') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $m->id }}">
                            <input type="hidden" name="menu_price" value="{{ $m->price }}">
                            <input class="btn btn-outline-primary rounded-pill" type="submit" value="Tambah">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="menu-empty py-3">
        <div class="d-flex justify-content-center py-1">
            <h2 class="display-5">Tidak ada menu yang tersedia</h2>
        </div>
        <div class="d-flex justify-content-center py-1">
            <p>Mohon untuk menunggu beberapa saat</p>
        </div>
    </div>
    @endif
</div>
@endsection
