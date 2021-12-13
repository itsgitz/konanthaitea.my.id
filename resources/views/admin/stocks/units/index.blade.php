@extends ('layouts.admin')
@section ('title', 'Tambah Unit Stock')

@section ('content')
<div class="py-3">
    <h5>Tambah satuan unit</h5>
    <form action="{{ route('admin_stock_units_post') }}" method="post">
        @csrf
        <div class="mb-3 col-md-4">
            <input class="d-inline form-control form-control-sm w-50" type="text" name="name" placeholder="Nama Unit" required>
            <input class="d-inline btn btn-primary btn-sm" type="submit" value="Simpan">
        </div>
    </form>

    <div class="py-2"></div>

    <h5>Satuan unit yang tersedia</h5>

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
                    <td>{{ date('d M Y H:i:s', strtotime( $su->created_at )) }}</td>
                    <td>
                        <button
                            class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#edit-unit-modal"
                        >
                            <i class="fas fa-pencil-alt"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#remove-unit-modal"
                        >
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="fw-light text-center" colspan="3">Data satuan unit kosong</td>
                </tr>
            @endif
        </table>
    </div>

    {{-- Edit Unit Modal --}}
    <div id="edit-unit-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="edit-unit-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="edit-unit-modal-label" class="modal-title">Edit Unit</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="stock-name" class="fw-bold"></span>
                    (<span id="stock-unit" class="fw-bold"></span>)?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                    <a id="edit-stock-button" class="btn btn-primary btn-sm" href="">Simpan</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Unit Modal --}}

    {{-- Delete Unit Modal --}}
    <div id="remove-unit-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-unit-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-unit-modal-label" class="modal-title">Hapus Unit</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="stock-name" class="fw-bold"></span>
                    (<span id="stock-unit" class="fw-bold"></span>)?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <a id="edit-stock-button" class="btn btn-danger btn-sm" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Unit Modal --}}

    {{-- Edit Stock Script --}}
    <script>
        /* function getStocks(el) { */
        /*     let stockName = el.dataset.stockName, */
        /*         stockUnit = el.dataset.stockUnit, */
        /*         stockLink = el.dataset.removeStockLink; */
        /*         stockNameEl = document.querySelector('#stock-name'), */
        /*         stockUnitEl = document.querySelector('#stock-unit'), */
        /*         removeStockButton = document.querySelector('#remove-stock-button'); */

        /*     stockNameEl.innerHTML = stockName; */
        /*     stockUnitEl.innerHTML = stockUnit; */
        /*     removeStockButton.setAttribute('href', stockLink); */
        /* } */
        function editStockUnit(el) {

        }

        function removeStockUnit(el) {

        }
    </script>
    {{-- Edit Stock Script --}}

    <div class="py-3"></div>
    <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
</div>
@endsection
