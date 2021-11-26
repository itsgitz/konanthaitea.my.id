@extends ('layouts.admin')
@section ('title', 'Resep untuk ' . $menu->name)

@section ('content')
<div class="py-3">
    <h5>Resep untuk {{ $menu->name }}</h5>

    <div class="py-3">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
            </thead>

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
        <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Back</a>
    </div>

</div>
@endsection
