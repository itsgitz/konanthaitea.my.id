@inject ('cart', 'App\Http\Controllers\CartController')

<div class="py-1"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand text-primary fs-2" href="/"><i class="fas fa-prescription-bottle"></i> Minuman Tile</a>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex">
        <a class="nav-link fw-light text-secondary position-relative" href="{{ route('client_cart_get') }}">
            <i class="fas fa-shopping-cart"></i> &nbsp;
            @if (Auth::check())
                @if (!empty($cart->getOnCartCount()))
                    <span class="position-absolute top-1 start-70 translate-middle badge rounded-circle bg-danger">
                        {{ $cart->getOnCartCount() }}
                    </span>
                @endif
            @endif
        </a>

        @if (Auth::check())
        <a href="#" class="nav-link fw-light text-secondary">
            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
        </a>
        <form method="post" action="{{ route('client_logout_post') }}">
            @csrf
            <button class="btn nav-link fw-light text-secondary" type="submit">
                Keluar
            </button>
        </form>
        @else

        <a class="nav-link fw-light text-secondary" href="{{ route('client_register_get') }}">
            Daftar
        </a>
        <a class="nav-link fw-light text-secondary" href="{{ route('client_login_get') }}">
            Masuk
        </a>

        @endif

        <a class="nav-link fw-light text-secondary" href="{{ route('client_about') }}">Tentang</a>
      </div>
    </div>
  </div>
</nav>
<div class="py-3"></div>
