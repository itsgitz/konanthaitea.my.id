<div class="py-1"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand text-primary fs-2" href="/">Minuman Tile</a>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex">
        <a class="nav-link fw-light text-secondary" href="{{ route('client_cart_get') }}">
            <i class="fas fa-shopping-cart"></i>
        </a>

        @if (Auth::check())
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
      </div>
    </div>
  </div>
</nav>
