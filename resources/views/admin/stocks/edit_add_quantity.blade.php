@extends ('layouts.admin')
@section ('title', 'Tambah Jumlah ' . $stock->stock_name)

@section ('content')
<div class="py-3">
    <h5>Tambah Jumlah (<i>Restock</i>) {{ $stock->stock_name }}</h5>

    @include ('shared.message')

    <form action="{{ route('admin_stocks_edit_add_quantity_put', ['id' => $stock->stock_id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3 col-md-4">
            <label class="form-label" for="current-quantity">Jumlah <strong>{{ $stock->stock_name }}</strong> saat ini ({{ $stock->unit_name }})</label>
            <input id="current-quantity" class="form-control" type="number" value="{{ $stock->stock_quantity }}" disabled>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="add-quantity">Tambah Jumlah</label>
            <input id="add-quantity" class="form-control" type="number" name="add_quantity" min="1" required>
            @error ('add_quantity')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>

        <div class="mb-3 col-md-4">
            <label class="form-label" for="total-price">Total Pembelian (Rp.)</label>
            <input id="total-price" class="form-control" name="total_price" type="number" min="1" required>
            @error ('total_price')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="upload">Upload Bukti Pembelian</label>
            <input class="form-control" name="upload_invoice" type="file" required>
            @error ('upload_invoice')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
        <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
    </form>
</div>
@endsection
