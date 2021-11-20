@extends ('layouts.admin')
@section ('title', 'Manajamen Stock')

@section ('content')
<div class="py-3">
    <h4>Manajemen Stock</h4>

    <a href="{{ route('admin_stock_units_get') }}">Tambah Satuan Unit</a>
    <table class="table">
        <th>ID</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Unit</th>
        <th>Status</th>
        <th>Ditambahkan Tanggal</th>

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
    </table>
</div>
@endsection
