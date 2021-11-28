@extends ('layouts.admin')
@section ('title', 'Tambah Unit Stock')

@section ('content')
<div class="py-3">
    <h5>Tambah Unit</h5>
    <form action="{{ route('admin_stock_units_post') }}" method="post">
        @csrf
        <div class="mb-3 col-md-4">
            <input class="d-inline form-control form-control-sm w-50" type="text" name="name" placeholder="Nama Unit" required>
            <input class="d-inline btn btn-primary btn-sm" type="submit" value="Simpan">
        </div>
    </form>

    <div class="py-2"></div>

    <h5>Unit yang tersedia</h5>

    @include ('shared.message')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col">#</th>
            </thead>

            @if ($stockUnits->isNotEmpty())
                @foreach ($stockUnits as $su)
                <tr>
                    <td>{{ $su->name }}</td>
                    <td>{{ date('j M Y H:i:s', strtotime( $su->created_at )) }}</td>
                    <td>
                        <button></button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="fw-light text-center" colspan="3">Data stock units kosong</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="py-3"></div>
    <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
</div>
@endsection
