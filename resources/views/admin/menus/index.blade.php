@extends ('layouts.admin')
@section ('title', 'Menu')

@section ('content')
<div class="py-3">
    <h5>Menu Management</h5>

    <div class="py-2">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_menu_add_get') }}">Tambah Menu</a>
    </div>

    <table class="table">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Quantity</th>
        <th>Added At</th>
        <th>Action</th>
        
        @foreach ($menus as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->name }}</td>
            <td>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</td>
            <td>{{ $m->status }}</td>
            <td>{{ $m->quantity }}</td>
            <td>{{ $m->created_at }}</td>
            <td>
                <a class="btn btn-sm btn-success" href="{{ route('admin_menu_show_get', [ 'id' => $m->id ]) }}">Lihat Resep</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
