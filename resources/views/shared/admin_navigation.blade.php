<div class="app-admin-navigation py-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom">
      <div class="container">
        <a class="navbar-brand" href="{{ route('admin_home') }}">Admin Area</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin_home') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin_orders_get') }}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_stocks_get') }}">Stocks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_menus_get') }}">Menu</a>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Accounts
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDrodown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin_clients_get') }}">
                            Clients 
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin_accounts_get') }}">
                            Admins
                        </a>
                    </li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</div>
