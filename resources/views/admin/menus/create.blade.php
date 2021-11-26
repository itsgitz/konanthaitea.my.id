@extends ('layouts.admin')
@section ('title', 'Tambah Menu')

@section ('content')
<div class="py-3">
    <h5>Tambah Menu</h5>

    @include ('shared.message')

    <form action="{{ route('admin_menu_add_post') }}" method="post">
        @csrf

        <div class="row gy-3">
            {{-- Menu --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title py-1 border-bottom">Rincian Menu</h6>
                        <div class="py-1"></div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="name">Nama</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                            @error ('name')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="price">Harga (Rp.)</label>
                            <input id="price" class="form-control" type="number" name="price" value="{{ old('price') }}" required>
                            @error ('price')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="quantity">Jumlah (kuantitas)</label>
                            <input id="quantity" class="form-control" type="number" name="quantity" value="{{ old('quantity') }}" min="1" required>
                            @error ('quantity')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="status">Status</label>
                            <select id="status" class="form-control" name="status" required>
                                <option value="Available">Available</option>
                                <option value="Sold Out">Sold Out</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Menu --}}

            {{-- Stocks --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title py-1 border-bottom">Rincian Resep</h6>
                        <div class="py-1"></div>
                        @if ($stocks->isNotEmpty())
                            @foreach ($stocks as $s)
                            <div class="form-check">
                                <input
                                    id="check-{{ $s->stock_id }}"
                                    class="form-check-input"
                                    type="checkbox"
                                    name="recipes[{{ $loop->index }}][id]"
                                    value="{{ $s->stock_id }}"
                                >
                                <label class="form-check-label" for="check-{{ $s->stock_id }}">{{ $s->stock_name }} ({{ $s->unit_name }})</label>
                                <div class="mb-3 col-md-4">
                                    <label class="label" for="stock-name">
                                        <span class="small">Tersedia: {{ $s->stock_quantity }} {{ $s->unit_name }}</span>
                                    </label>
                                    <input type="hidden" name="stocks[{{ $loop->index }}][current_quantity]" value="{{ $s->stock_quantity }}">
                                    <input id="stock-name" class="form-control" type="number" name="recipes[{{ $loop->index }}][quantity]" placeholder="Jumlah {{ $s->stock_name }}">

                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="mb-3 alert alert-danger" role="alert">
                                Anda tidak dapat menambah menu karena data stock kosong.
                                Mohon untuk <a href="{{ route('admin_stocks_add_get') }}">menambahkan stock</a> terlebih dahulu.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Stocks --}}
        </div>

        <div class="py-2"></div>
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Kembali</a>
                <input
                    class="btn btn-primary btn-sm"
                    type="submit"
                    value="Simpan"
                    @if ($stocks->isEmpty())
                    disabled
                    @endif
                >
            </div>
        </div>
    </form>
</div>
@endsection

