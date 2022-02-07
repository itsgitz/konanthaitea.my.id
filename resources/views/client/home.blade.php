@extends ('layouts.client')
@section ('title', 'Order minuman favoritmu sekarang!')

@section ('content')

@include ('shared.message')

<div class="py-1">
    <div class="alert alert-primary fw-light" style="font-size: 1.2rem;">
        Promo gratis ongkir untuk wilayah Cimahi! <i class="far fa-money-bill-alt"></i>
    </div>

    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Lihat deskripsi proses pemesanan
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
                        Login atau registrasi terlebih dahulu sebelum melakukan pemesanan. Tambahkan minuman yang anda inginkan dengan menekan tombol "Tambah".
                        Setelah itu anda akan diarahkan ke halaman keranjang. Maka pilihlah methode pengiriman, yaitu Pickup atau Delivery, beserta metode pembayaranya, yaitu
                        Bank transfer atau e-money. Jika anda memilih Delivery, maka isilah alamat dan nomor telepon anda. Setelah proses pemesanan selesai, maka anda akan diberika
                        kontak kurir yang bisa dihubungi.
          </div>
        </div>
      </div>
    </div>

    <div class="py-2"></div>
    @if (!$menu->isEmpty())
    <div class="row gy-3">
        @foreach ($menu as $m)
        <div class="col-md-2">
            <div class="shadow @if ($m->status == 'Sold Out') sold-out @endif h-100">
                <div class="p-3 text-center">
                    <img class="card-img-top" src="{{ $m->image }}" alt="{{ $m->name }}" style="max-width: 150px; max-height: 200px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $m->name }}</h1>
                    @php
                        $discountPrice = (28 * $m->price) / 100;
                        $discountPrice = $m->price - $discountPrice;
                    @endphp
                    <p class="card-text text-success">
                        Diskon 28%
                    </p>
                    <p class="card-text">
                        <div class="text-decoration-line-through text-secondary"><i>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</i></div>
                        <div>Rp. {{ number_format( $discountPrice, 2, ',', '.' ) }}</div>
                    </p>
                    <p class="card-text">
                        <div>{{ $m->status }}</div>
                        <div>Tersedia {{ $m->quantity }} unit</div>
                    </p>
                    <p class="cart-text"></p>
                    <div id="menu-description-box">
                        <button
                            class="btn btn-outline-success rounded-pill px-4 fw-bold w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#description-modal"
                            data-menu-name="{{ $m->name }}"
                            data-menu-description="{{ $m->description }}"
                            onclick="showDescription(this)"
                        >
                            Lihat Deskripsi
                        </button>
                    </div>
                    <div class="py-1"></div>
                    <div class="order-link">
                        @if (Auth::check())
                        <form action="{{ route('client_cart_post') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $m->id }}">
                            <input type="hidden" name="menu_price" value="{{ $m->price }}">
                            <input
                                class="btn btn-outline-primary rounded-pill px-4 fw-bold w-100"
                                type="submit"
                                value="Tambah"
                                @if ($m->status == 'Sold Out')
                                disabled
                                @endif
                            >
                        </form>
                        @else
                        <button
                            class="btn btn-outline-primary rounded-pill px-4 fw-bold w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#redirect-modal"
                            data-menu-id="{{ $m->id }}"
                            data-menu-price="{{ $m->price }}"
                            onclick="redirectToAuth(this)"
                            @if ($m->status == 'Sold Out')
                            disabled
                            @endif
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
    <div class="menu-empty py-3 px-3 shadow">
        <div class="d-flex justify-content-center py-1">
            <h2 class="display-5">Belum ada menu yang tersedia</h2>
        </div>
        <div class="d-flex justify-content-center py-1">
            <p>Mohon untuk menunggu beberapa saat lagi ...</p>
        </div>
    </div>
    @endif

    {{-- Modal Redirect Login --}}
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
    {{-- Modal Redirect Login --}}

    {{-- Modal Description --}}
    <div id="description-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="redirect-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-client-modal-label" class="modal-title">Deskripsi <span id="menu-name"></span></h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="menu-description" class="fw-light"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Description --}}

    {{-- Modal Script --}}
    <script>
        function redirectToAuth(el) {
            let menuId = el.dataset.menuId,
                menuPrice = el.dataset.menuPrice;

            let redirectForm = document.getElementById('redirect-form');

            redirectForm.elements.namedItem('menu_id').value = menuId;
            redirectForm.elements.namedItem('menu_price').value = menuPrice;
        }

        function showDescription(el) {
            let menuNameEl = document.querySelector('#menu-name');
            let menuDescriptionEl = document.querySelector('#menu-description');
            let menuName = el.dataset.menuName;
            let menuDescription = el.dataset.menuDescription;

            menuNameEl.innerHTML = menuName;

            if (menuDescription) {
                menuDescriptionEl.innerHTML = menuDescription;

            } else {
                menuDescriptionEl.innerHTML = 'Belum ada deskripsi untuk menu ini';
            }
        }
    </script>
    {{-- Modal Script --}}
</div>

<div class="py-5"></div>
@endsection
