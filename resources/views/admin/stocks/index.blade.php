@extends ('layouts.admin')
@section ('title', 'Manajamen Stock')

@section ('content')
<div class="py-3">
    <h5>Manajemen Stock</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stocks_add_get') }}">Tambah Stock</a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stock_units_get') }}">Tambah Satuan Unit</a>
    </div>

    <table class="table table-hover">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Unit</th>
            <th scope="col">Status</th>
            <th scope="col">Ditambahkan Tanggal</th>
        </thead>

        @if ($stocks->isNotEmpty())
            @foreach ($stocks as $s)
            <tr>
                <td>{{ $s->stock_id }}</td>
                <td>{{ $s->stock_name }}</td>
                <td>{{ $s->stock_quantity }}</td>
                <td>{{ $s->unit_name }}</td>
                <td>{{ $s->stock_status }}</td>
                <td>{{ $s->stock_created_at }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="fw-light text-center" colspan="6">Data stocks kosong</td>
            </tr>
        @endif
    </table>
</div>
@endsection
