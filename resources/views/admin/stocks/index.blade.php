@extends ('layouts.admin')
@section ('title', 'Manajamen Stock')

@section ('content')
<div id="admin-stock-index" class="py-3">
    <h5>Manajemen Stock</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stocks_add_get') }}">Tambah Jenis Stock</a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stock_units_get') }}">Tambah Satuan Unit</a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stocks_histories_get') }}">Riwayat Isi Ulang</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
                <th scope="col">Status</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col" colspan="3">#</th>
            </thead>

            @if ($stocks->isNotEmpty())
                @foreach ($stocks as $s)
                <tr>
                    <td>{{ $s->stock_name }}</td>
                    <td>{{ number_format( $s->stock_quantity, 0, '', '.' ) }}</td>
                    <td>{{ $s->unit_name }}</td>
                    <td>
                        <span
                            class="stock-status fw-bold"
                            data-stock-status="{{ $s->stock_status }}"
                        >
                            {{ $s->stock_status }}
                        </span>
                    </td>
                    <td>{{ date('d M Y H:i:s', strtotime( $s->stock_created_at )) }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('admin_stocks_edit_add_quantity_get', ['id' => $s->stock_id]) }}">
                            <i class="fas fa-plus-circle"></i> Tambah
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('admin_stocks_edit_get', ['id' => $s->stock_id]) }}">
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
                    <td class="fw-light text-center" colspan="6">Data stocks kosong</td>
                </tr>
            @endif
        </table>
    </div>
</div>
@endsection
