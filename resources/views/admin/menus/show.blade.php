@extends ('layouts.admin')
@section ('title', 'Resep untuk ' . $menu->name)

@section ('content')
<div id="admin-menu-show" class="py-3">
    <h5>Resep untuk {{ $menu->name }}</h5>

    @include ('shared.message')

    <div class="py-3">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
            </thead>

            @foreach ($menuStocks as $s)
            <tr>
                <td>{{ $s->stock_name }}</td>
                <td>{{ $s->recipe_quantity }}</td>
                <td>{{ $s->unit }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <button id="add-menu-recipe-items-button" class="btn btn-secondary btn-sm" type="button">Tambah Komposisi Resep</button>
    <div class="py-2"></div>

    <div id="add-menu-recipe-box" class="card d-none">
        <div class="card-body">
            <form action="{{ route('admin_menu_stocks_add_post', ['id' => $menu->id]) }}" method="post">
                @csrf
                <div class="mb-2 col-md-4">
                    <select id="" class="form-select form-select-sm w-50" name="name" required>
                        <option value="">Pilih Komposisi</option>
                        @foreach ($stocks as $s)
                        <option value="{{ $s->stock_id }}">
                            {{ $s->stock_name }} ({{ $s->unit_name }})
                        </option>
                        @endforeach
                    </select>
                    @error ('name')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="mb-2 col-md-4">
                    <input class="form-control form-control-sm w-50" type="number" name="quantity" placeholder="Jumlah" min="1" required>
                    @error ('quantity')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
                <button id="close-add-menu-box" class="btn btn-warning btn-sm" type="button">Tutup</button>
            </form>
        </div>
    </div>

    <div class="py-3">
        <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Back</a>
    </div>

</div>
@endsection
