@inject ('cart', 'App\Http\Controllers\CartController')
@inject ('order', 'App\Http\Controllers\OrdersController')

<div class="app-client-navigation">
    <div class="py-1"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom">
      <div class="container">
        <a class="navbar-brand text-primary fs-2" href="/"><i class="fas fa-prescription-bottle"></i> Minuman Tile</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#app-nav-toggler"
            aria-controls="app-nav-toggler"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="app-nav-toggler">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            {{-- Cart --}}
            <li class="nav-item">
                <a class="nav-link fw-light text-secondary position-relative" href="{{ route('client_cart_get') }}">
                    <span class="pe-2"><i class="fas fa-shopping-cart"></i></span>
                    @if (Auth::check())
                        @if (!empty($cart->getOnCartCount()))
                            <span class="position-absolute top-1 start-70 translate-middle badge rounded-circle bg-danger">
                                {{ $cart->getOnCartCount() }}
                            </span>
                        @endif
                    @endif
                </a>
            </li>
            {{-- Cart --}}

            {{-- User --}}
            @if (Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDrodown">
                    <li>
                        <a class="dropdown-item" href="{{ route('client_orders_get') }}">
                            <span class="pe-3">Daftar Transaksi</span>
                            @if ($order->getOnProgressOrderCount())
                            <span class="badge rounded-pill bg-primary">{{ $order->getOnProgressOrderCount() }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="btn dropdown-item fw-light text-secondary" href="{{ route('client_logout_post') }}">
                            Keluar
                        </a>
                    </li>
                </ul>
            </li>
            @else

            <li class="nav-item">
                <a class="nav-link fw-light text-secondary" href="{{ route('client_register_get') }}">
                    Daftar
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-light text-secondary" href="{{ route('client_login_get') }}">
                    Masuk
                </a>
            </li>
            @endif
            {{-- User --}}

            {{-- About --}}
            <li class="nav-item">
                <a class="nav-link fw-light text-secondary" href="{{ route('client_about') }}">About</a>
            </li>
            {{-- About --}}
          </ul>
        </div>
      </div>
    </nav>
    <div class="py-3"></div>
</div>
