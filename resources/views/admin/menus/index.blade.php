@extends ('layouts.admin')
@section ('title', 'Menu')

@section ('content')
<div class="py-3">
    <h5>Menu Management</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_menu_add_get') }}">Tambah Menu</a>
    </div>

    <table class="table table-hover">
        <thead>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Status</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Ditambahkan Tanggal</th>
            <th scope="col">#</th>
        </thead>

        @if ($menus->isNotEmpty())
            @foreach ($menus as $m)
            <tr>
                <td>{{ $m->name }}</td>
                <td>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</td>
                <td>{{ $m->status }}</td>
                <td>{{ $m->quantity }}</td>
                <td>{{ $m->created_at }}</td>
                <td>
                    <a class="btn btn-success btn-sm" href="{{ route('admin_menu_show_get', [ 'id' => $m->id ]) }}">Lihat Resep</a>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="fw-light text-center" colspan="6">Data menu kosong</td>
            </tr>
        @endif
    </table>
</div>
@endsection
