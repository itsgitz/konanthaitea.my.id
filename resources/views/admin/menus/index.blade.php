@extends ('layouts.admin')
@section ('title', 'Menu')

@section ('content')
<div class="py-3">
    <h4>Menu Management</h4>

    <a href="">Tambah Menu</a>
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
                <a class="btn btn-sm btn-primary" href="{{ route('admin_menu_show_get', [ 'id' => $m->id ]) }}">Lihat Resep</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
