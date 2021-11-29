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
                            <input id="price" class="form-control" type="number" name="price" value="{{ old('price') }}" min="1" required>
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
                            <select id="status" class="form-select" name="status" required>
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
                        @foreach ($stocks as $s)
                        <div id="accordionFlush" class="accordion accordion-flush border-bottom">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading-{{ $s->stock_id }}">
                                    <button
                                        class="accordion-button collapsed"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#flush-{{ $s->stock_id }}"
                                        aria-expanded="false"
                                        aria-controls="flush-{{ $s->stock_id }}"
                                        type="button"
                                    >
                                        {{ $s->stock_name }}
                                    </button>
                                </h2>

                                <div
                                    id="flush-{{ $s->stock_id }}"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="flush-heading-{{ $s->stock_id }}"
                                >
                                    <div class="form-check">
                                        <div class="py-2"></div>
                                        <input
                                            id="check-{{ $s->stock_id }}"
                                            class="form-check-input"
                                            type="checkbox"
                                            name="recipes[{{ $loop->index }}][id]"
                                            value="{{ $s->stock_id }}"
                                        >
                                        <label class="form-check-label" for="check-{{ $s->stock_id }}">
                                            {{ $s->stock_name }} ({{ $s->unit_name }}) &rarr; Tersedia: {{ $s->stock_quantity }} {{ $s->unit_name }}
                                        </label>
                                        <div class="mb-3 col-md-4">
                                            <input type="hidden" name="stocks[{{ $loop->index }}][current_quantity]" value="{{ $s->stock_quantity }}">
                                            <input
                                                id="stock-name"
                                                class="form-control"
                                                type="number"
                                                name="recipes[{{ $loop->index }}][quantity]"
                                                placeholder="Jumlah {{ $s->stock_name }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                >
            </div>
        </div>
    </form>
</div>
@endsection

