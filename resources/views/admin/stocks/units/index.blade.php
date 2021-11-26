@extends ('layouts.admin')
@section ('title', 'Tambah Unit Stock')

@section ('content')
<div class="py-3">
    <h5>Unit yang tersedia</h5>

    @include ('shared.message')
    <table class="table table-hover">
        <thead>
            <th scope="col">Nama</th>
            <th scope="col">Ditambahkan Tanggal</th>
        </thead>

        @if ($stockUnits->isNotEmpty())
            @foreach ($stockUnits as $su)
            <tr>
                <td>{{ $su->name }}</td>
                <td>{{ $su->created_at }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="fw-light text-center" colspan="3">Data stock units kosong</td>
            </tr>
        @endif
    </table>

    <div class="py-3"></div>
    <h5>Tambah Unit</h5>
    <form action="{{ route('admin_stock_units_post') }}" method="post">
        @csrf
        <div class="mb-3">
            <input class="form-control w-25" type="text" name="name" placeholder="Nama Unit" required>
        </div>
        <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
        <input class="btn btn-success btn-sm" type="submit" value="Simpan">
    </form>
</div>
@endsection
