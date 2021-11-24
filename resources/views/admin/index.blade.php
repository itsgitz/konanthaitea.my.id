@extends ('layouts.admin')
@section ('title', 'Dashboard')

@section ('content')
<div class="py-3">
    <h5>Dashboard</h5>

    <div class="py-2"></div>
    <div class="row gy-3">
        <div class="col-md">
            <a class="text-decoration-none" href="{{ route('client_home') }}">
                <div class="card btn btn-outline-success">
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-center">
                            <i class="fas fa-shopping-cart display-3"></i>
                        </div>
                        <div class="card-text d-flex justify-content-center py-3">
                            Client Area
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md">
            <a class="text-decoration-none" href="{{ route('admin_orders_get') }}">
                <div class="card btn btn-outline-primary">
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-center">
                            <i class="fas fa-clipboard-list display-3"></i>
                        </div>
                        <div class="card-text d-flex justify-content-center py-3">
                            Orders
                        </div>
                    </div>
                </div>
            </a>
        </div>
       <div class="col-md">
            <a class="text-decoration-none" href="{{ route('admin_stocks_get') }}">
                <div class="card btn btn-outline-warning">
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-center">
                            <i class="fas fa-tags display-3"></i>
                        </div>
                        <div class="card-text d-flex justify-content-center py-3">
                            Stocks
                        </div>
                    </div>
                </div>
            </a>
        </div> 
        <div class="col-md">
            <a class="text-decoration-none" href="{{ route('admin_menus_get') }}">
                <div class="card btn btn-outline-danger">
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-center">
                            <i class="fas fa-wine-bottle display-3"></i>
                        </div>
                        <div class="card-text d-flex justify-content-center py-3">
                            Menu
                        </div>
                    </div>
                </div>
            </a>
        </div> 
    </div>
</div>
@endsection
