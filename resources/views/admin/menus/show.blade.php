@extends ('layouts.admin')
@section ('title', 'Resep untuk ' . $menu->name)

@section ('content')
<div class="py-3">
    <h5>Resep untuk {{ $menu->name }}</h5>
    
    <div class="py-3">
        <table class="table">
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit</th>

            @foreach ($menuStocks as $s)    
            <tr>
                <td>{{ $s->stock_name }}</td>
                <td>{{ $s->recipe_quantity }}</td>
                <td>{{ $s->unit }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="py-3">
        <a href="{{ route('admin_menu_get') }}">Back</a>
    </div>

</div>
@endsection
