@extends ('layouts.admin')
@section ('title', 'Tambah Jenis Stock')

@section ('content')
<div class="py-3">
    <h5>Tambah Jenis Stock</h5>

    @include ('shared.message')

    @if ($units->isEmpty())
    <div class="alert alert-danger">
        Saat ini anda tidak bisa menambahkan stock karena satuan unit (Mililiter, Gram, Buah, dll) tidak tersedia.
        Mohon untuk menambahkan <a href="{{ route('admin_stock_units_get') }}">satuan unit</a> terlebih dahulu.
    </div>
    @endif

    <form action="{{ route('admin_stocks_add_get') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">Nama</label>
            <input id="name" class="form-control" type="text" name="name" required>
            @error ('name')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="quantity">Jumlah</label>
            <input id="quantity" class="form-control" type="number" name="quantity" min="1" required>
            @error ('quantity')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <select class="form-select" name="unit" required>
                <option value="">Pilih Satuan Unit</option>
                @foreach ($units as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error ('unit')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="total-price">Total Belanja (Rp.)</label>
            <input id="total-price" class="form-control" type="number" name="total_price" min="1" required>
            @error ('total_price')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="upload-invoice">Upload Bukti Pembelian</label>
            <input id="upload-invoice" class="form-control" name="upload_invoice" type="file" required>
            @error ('upload_invoice')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
        <input
            class="btn btn-primary btn-sm"
            type="submit"
            value="Simpan"
            @if ($units->isEmpty())
            disabled
            @endif
        >
    </form>
</div>
@endsection
