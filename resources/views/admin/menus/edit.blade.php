@extends ('layouts.admin')
@section ('title', 'Edit Menu ' . $menu->name)

@section ('content')
<div id="edit-menu" class="py-3">
    <h5>Edit Menu {{ $menu->name }}</h5>

    @include ('shared.message')

    <form action="{{ route('admin_menu_edit_put', ['id' => $menu->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row gy-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title py-1 border-bottom">Rincian Menu</h6>
                        <div class="py-1"></div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="name">Nama</label>
                            <input
                                id="name"
                                class="form-control"
                                type="text"
                                name="name"
                                value="{{ $menu->name }}"
                                placeholder="Nama saat ini {{ $menu->name }}"
                                required
                            >
                            @error ('name')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="price">Harga (Rp.)</label>
                            <input
                                id="price"
                                class="form-control"
                                type="number"
                                name="price"
                                value="{{ $menu->price }}"
                                placeholder="Harga saat ini Rp. {{ number_format( $menu->price, 2, ',', '.' ) }}"
                                min="1"
                                required
                            >
                            @error ('price')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="quantity">Jumlah</label>
                            <input
                                class="form-control"
                                id="quantity"
                                type="number"
                                value="{{ $menu->quantity }}"
                                disabled
                            >
                            <div class="py-2">
                                <button id="add-menu-quantity-button" class="btn btn-sm btn-success" type="button">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </button>
                                <button id="reduce-menu-quantity-button" class="btn btn-sm btn-warning" type="button">
                                    <i class="fas fa-minus-circle"></i> Kurangi
                                </button>
                                <div class="py-2"></div>
                                <input id="edit-add" class="form-control d-none" type="number" name="edit_add" min="1" placeholder="Tambah Jumlah">
                                <input id="edit-reduce" class="form-control d-none" type="number" name="edit_reduce" min="1" placeholder="Kurangi Jumlah">
                            </div>
                            @error ('edit_add')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                            @error ('edit_reduce')
                            <div>
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="label" for="status">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="Available">Available</option>
                                <option value="Sold Out">Sold Out</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="py-2"></div>
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Kembali</a>
                        <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title py-1 border-bottom">Rincian Resep</h6>
                        <div class="py-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
