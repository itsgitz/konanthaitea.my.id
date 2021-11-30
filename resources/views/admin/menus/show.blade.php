@extends ('layouts.admin')
@section ('title', 'Resep untuk ' . $menu->name)

@section ('content')
<div id="admin-menu-show" class="py-3">
    <h5>Resep untuk {{ $menu->name }}</h5>

    @include ('shared.message')

    <div class="py-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Unit</th>
                    <th scope="col" colspan="2">#</th>
                </thead>

                @foreach ($menuStocks as $s)
                <tr>
                    <td>{{ $s->stock_name }}</td>
                    <td>{{ $s->recipe_quantity }}</td>
                    <td>{{ $s->unit }}</td>
                    <td>
                        <button
                            class="btn btn-warning btn-sm"
                            data-menu-id="{{ $menu->id }}"
                            data-menu-stock-id="{{ $s->menu_stock_id }}"
                            data-menu-stock-name="{{ $s->stock_name }}"
                            data-menu-stock-quantity="{{ $s->recipe_quantity }}"
                            data-menu-stock-unit="{{ $s->unit }}"
                            data-bs-toggle="modal"
                            data-bs-target="#edit-modal"
                            onclick="editQuantity(this)"
                        >
                            <i class="fas fa-pencil-alt"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button
                            class="btn btn-danger btn-sm"
                            data-menu-stock-id="{{ $s->menu_stock_id }}"
                            data-menu-stock-name="{{ $s->stock_name }}"
                            data-menu-stock-quantity="{{ $s->recipe_quantity }}"
                            data-menu-stock-unit="{{ $s->unit }}"
                            data-bs-toggle="modal"
                            data-bs-target="#remove-modal"
                        >
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @if ($stocks->isNotEmpty())
    <button id="add-menu-recipe-items-button" class="btn btn-primary btn-sm" type="button">Tambah Komposisi Resep</button>
    <div class="py-2"></div>
    <div id="add-menu-recipe-box" class="card d-none">
        <div class="card-body">
            <form id="edit-form" action="{{ route('admin_menu_stocks_add_post', ['id' => $menu->id]) }}" method="post">
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
                <input class="btn btn-secondary btn-sm" type="submit" value="Simpan">
                <button id="close-add-menu-box" class="btn btn-secondary btn-sm" type="button">Tutup</button>
            </form>
        </div>
    </div>
    @endif

    {{-- EDIT MODAL --}}
    <div id="edit-modal" class="modal fade" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
        <form id="edit-form" action="" method="post">
            @csrf
            @method('PUT')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="edit-modal-label" class="modal-title">
                            Edit <span id="menu-stock-name"></span>
                        </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col-md-8">
                            <input id="menu-id" type="hidden" name="menu_id">
                            <input id="menu-stock-id" type="hidden" name="menu_stock_id">
                            <input id="update-quantity" class="form-control" type="number" name="update_quantity" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Batal</button>
                        <input class="btn btn-danger" type="submit" value="Simpan">
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- EDIT MODAL --}}

    {{-- REMOVE MODAL --}}
    <div id="remove-modal" class="modal fade" tabindex="-1" aria-labelledby="remove-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-modal-label" class="modal-title">
                        Hapus <span id="menu-stock-name"></span>
                    </h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    {{-- REMOVE MODAL --}}

    <div class="py-3">
        <a class="btn btn-danger btn-sm" href="{{ route('admin_menu_get') }}">Back</a>
    </div>

    <script>
        function editQuantity(el) {
            let menuId = el.dataset.menuId;
            let menuStockId = el.dataset.menuStockId;
            let menuStockName = el.dataset.menuStockName;
            let menuStockQuantity = el.dataset.menuStockQuantity;
            let menuStockUnit = el.dataset.menuStockUnit;
            let stockNameEl = document.querySelector('#menu-stock-name');
            let menuIdInput = document.querySelector('#menu-id');
            let menuStockIdInput = document.querySelector('#menu-stock-id');
            let updateQuantityInput = document.querySelector('#update-quantity');

            menuIdInput.value = menuId;
            menuStockIdInput.value = menuStockId;
            updateQuantityInput.value = menuStockQuantity;
            updateQuantityInput.setAttribute('placeholder', 'Jumlah saat ini ' + menuStockQuantity + ' ' + menuStockUnit);
            stockNameEl.innerHTML = menuStockName + ' (' + menuStockUnit + ')' ;
        }
    </script>

</div>
@endsection
