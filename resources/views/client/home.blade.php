@extends ('layouts.client')
@section ('title', 'Order minuman favoritmu sekarang!')

@section ('content')

@include ('shared.message')

<div class="py-3">
    @if (!$menu->isEmpty())
    <div class="row">
        @foreach ($menu as $m)
        <div class="col-md-4">
            <div class="card shadow mb-5 bg-body">
                <div class="card-body">
                    <h1 class="card-title">{{ $m->name }}</h1>
                    <p class="card-text">Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</p>
                    <p class="card-text">{{ $m->status }}</p>
                    <div class="order-link">
                        {{--
                        <form action="{{ route('client_cart_post') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $m->id }}">
                            <input type="hidden" name="menu_price" value="{{ $m->price }}">
                            <input class="btn btn-outline-primary rounded-pill" type="submit" value="Tambah">
                        </form>
                        --}}
                        @if (Auth::check())
                        <form action="{{ route('client_cart_post') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $m->id }}">
                            <input type="hidden" name="menu_price" value="{{ $m->price }}">
                            <input class="btn btn-outline-primary rounded-pill" type="submit" value="Tambah">
                        </form>
                        @else
                        <button
                            class="btn btn-outline-primary rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#redirect-modal"
                            data-menu-id="{{ $m->id }}"
                            data-menu-price="{{ $m->price }}"
                            onclick="redirectToAuth(this)"
                        >
                            Tambah
                        </button>
                        @endif
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
            <p>Mohon untuk menunggu beberapa saat lagi ...</p>
        </div>
    </div>
    @endif

    {{-- Modal --}}
    <div id="redirect-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="redirect-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-client-modal-label" class="modal-title">Anda Belum Login</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sebelum melakukan pemesanan, anda harus login terlebih dahulu
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                    <form id="redirect-form" action="{{ route('client_cart_post') }}" method="post">
                        @csrf
                        <input type="hidden" name="menu_id">
                        <input type="hidden" name="menu_price">
                        <input class="btn btn-primary btn-sm" type="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}

    {{-- Modal Script --}}
    <script>
        function redirectToAuth(el) {
            let menuId = el.dataset.menuId,
                menuPrice = el.dataset.menuPrice;

            let redirectForm = document.getElementById('redirect-form');

            redirectForm.elements.namedItem('menu_id').value = menuId;
            redirectForm.elements.namedItem('menu_price').value = menuPrice;
        }
    </script>
    {{-- Modal Script --}}
</div>
@endsection
