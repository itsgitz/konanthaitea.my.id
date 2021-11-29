@extends ('layouts.admin')
@section ('title', 'Manajemen Menu')

@section ('content')
<div id="admin-menu-main" class="py-3">
    <h5>Manajemen Menu</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_menu_add_get') }}">Tambah Menu</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col" colspan="3">#</th>
            </thead>

            @if ($menus->isNotEmpty())
                @foreach ($menus as $m)
                <tr>
                    <td>{{ $m->name }}</td>
                    <td>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</td>
                    <td>
                        <span class="menu-status fw-bold" data-menu-status="{{ $m->status }}">
                            {{ $m->status }}
                        </span>
                    </td>
                    <td>{{ $m->quantity }}</td>
                    <td>{{ date('j M Y H:i:s', strtotime( $m->created_at )) }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('admin_menu_show_get', [ 'id' => $m->id ]) }}">
                            <i class="fas fa-eye"></i> Lihat Resep
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('admin_menu_edit_get', ['id' => $m->id]) }}">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
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
</div>
@endsection
