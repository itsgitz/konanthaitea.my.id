@extends ('layouts.admin')
@section ('title', 'Dashboard')

@section ('content')
<div class="py-3">
    <h5>Dashboard</h5>

    <div class="py-2"></div>
    <div class="row gy-3">
        <div class="col-md">
            <a href="{{ route('client_home') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            Client Area
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="{{ route('admin_orders_get') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            Orders
                        </div>
                    </div>
                </div>
            </a>
        </div>
       <div class="col-md">
            <a href="{{ route('admin_stocks_get') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            Stocks
                        </div>
                    </div>
                </div>
            </a>
        </div> 
        <div class="col-md">
            <a href="{{ route('admin_menus_get') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            Menu
                        </div>
                    </div>
                </div>
            </a>
        </div> 
    </div>
</div>
@endsection
