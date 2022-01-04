@extends ('layouts.admin')
@section ('title', 'Edit ' . $stock->stock_name)

@section ('content')
<div class="py-3">
    <h5>Edit {{ $stock->stock_name }}</h5>

    @include ('shared.message')
    <form action="{{ route('admin_stocks_edit_put', ['id' => $stock->stock_id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">Nama</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ $stock->stock_name }}">
            @error ('name')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="unit">Ubah Satuan Unit</label>
            <select id="unit" class="form-select" name="unit" required>
                @foreach ($units as $u)
                <option
                    value="{{ $u->id }}"
                    @if ($u->name == $stock->unit_name)
                    selected
                    @endif
                >
                    {{ $u->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="status">Ubah Status</label>
            <select
                id="status"
                class="form-select"
                name="status"
                required
                @if ($stock->stock_status == 'Not Available' && $stock->stock_quantity <= 0) disabled @endif
            >
            @foreach ($availableStatus as $as)
                <option
                    value="{{ $as }}"
                    @if ($as == $stock->stock_status)
                    selected
                    @endif
                >
                    {{ $as }}
                </option>
            @endforeach
            </select>
        </div>

        <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
        <input class="btn btn-primary btn-sm" type="Submit" value="Simpan">
    </form>
</div>
@endsection
