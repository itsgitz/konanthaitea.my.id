@extends ('layouts.admin')
@section ('title', 'Edit Menu ' . $menu->name)

@section ('content')
<div id="admin-menu-edit" class="py-3">
    <h5>Edit Menu {{ $menu->name }}</h5>

    @include ('shared.message')

    <form action="{{ route('admin_menu_edit_put', ['id' => $menu->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">Nama</label>
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
        <div class="mb-3 col-md-4">
            <label class="form-label" for="price">Harga (Rp.)</label>
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
        <div class="mb-3 col-md-4">
            <label class="form-label" for="quantity">Jumlah</label>
            <input type="hidden" name="quantity" value="{{ $menu->quantity }}">
            <input
                class="form-control"
                id="quantity"
                type="number"
                value="{{ $menu->quantity }}"
                disabled
            >
            <div class="py-2">
                <button id="add-menu-quantity-button" class="btn btn-sm btn-secondary" type="button">
                    <i class="fas fa-plus-circle"></i> Tambah
                </button>
                <button id="reduce-menu-quantity-button" class="btn btn-sm btn-secondary" type="button">
                    <i class="fas fa-minus-circle"></i> Kurangi
                </button>
                <div class="py-2"></div>
                <div id="add-box" class="d-none">
                    <label class="form-label" for="edit-add">
                        Masukan jumlah yang akan ditambah dengan <strong>{{ $menu->quantity }}</strong>
                    </label>
                    <input
                        id="edit-add"
                        class="form-control"
                        type="number"
                        name="edit_add"
                        min="1"
                        placeholder="Tambah Jumlah"
                    >
                </div>
                <div id="reduce-box" class="d-none">
                    <label class="form-label" for="edit-reduce">
                        Masukan jumlah yang akan dikurangi dengan <strong>{{ $menu->quantity }}</strong>
                    </label>
                    <input
                        id="edit-reduce"
                        class="form-control"
                        type="number"
                        name="edit_reduce"
                        min="1"
                        placeholder="Kurangi Jumlah"
                    >
                </div>
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
        <div class="mb-3 col-md-4">
            <label class="form-label" for="status">Status</label>
            <select class="form-select" name="status" id="status" required>
                @foreach ($status as $s)
                <option
                    value="{{ $s['value'] }}"
                    @if ($s['selected']) selected @endif
                >
                    {{ $s['value'] }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Kembali</a>
            <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
        </div>
    </form>
</div>
@endsection
