@extends ('layouts.admin')
@section ('title', 'Manajamen Stock')

@section ('content')
<div id="admin-stock-index" class="py-3">
    <h5>Manajemen Stock</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stocks_add_get') }}">Tambah Jenis Stock</a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stock_units_get') }}">Tambah Satuan Unit</a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin_stocks_histories_get') }}">Riwayat Isi Ulang</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
                <th scope="col">Status</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col" colspan="3">#</th>
            </thead>

            @if ($stocks->isNotEmpty())
                @foreach ($stocks as $s)
                <tr>
                    <td>{{ $s->stock_name }}</td>
                    <td>{{ number_format( $s->stock_quantity, 0, '', '.' ) }}</td>
                    <td>{{ $s->unit_name }}</td>
                    <td>
                        <span
                            class="stock-status fw-bold"
                            data-stock-status="{{ $s->stock_status }}"
                        >
                            {{ $s->stock_status }}
                        </span>
                    </td>
                    <td>{{ date('d M Y H:i:s', strtotime( $s->stock_created_at )) }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('admin_stocks_edit_add_quantity_get', ['id' => $s->stock_id]) }}">
                            <i class="fas fa-plus-circle"></i> Tambah
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('admin_stocks_edit_get', ['id' => $s->stock_id]) }}">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                    </td>
                    <td>
                        <button
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#remove-stock-modal"
                            data-stock-name="{{ $s->stock_name }}"
                            data-stock-unit="{{ $s->unit_name }}"
                            data-remove-stock-link="{{ route('admin_stocks_delete_get', ['id' => $s->stock_id]) }}"
                            onclick="getStocks(this)"
                        >
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="fw-light text-center" colspan="6">Data stocks kosong</td>
                </tr>
            @endif
        </table>
    </div>

    {{-- Modal --}}
    <div id="remove-stock-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-stock-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-stock-modal-label" class="modal-title">Hapus Stock</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus
                    <span id="stock-name" class="fw-bold"></span>
                    (<span id="stock-unit" class="fw-bold"></span>)?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <a id="remove-stock-button" class="btn btn-danger btn-sm" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}

    {{-- Modal Script --}}
    <script>
        function getStocks(el) {
            let stockName = el.dataset.stockName,
                stockUnit = el.dataset.stockUnit,
                stockLink = el.dataset.removeStockLink;
                stockNameEl = document.querySelector('#stock-name'),
                stockUnitEl = document.querySelector('#stock-unit'),
                removeStockButton = document.querySelector('#remove-stock-button');

            stockNameEl.innerHTML = stockName;
            stockUnitEl.innerHTML = stockUnit;
            removeStockButton.setAttribute('href', stockLink);
        }
    </script>
    {{-- Modal Script --}}
</div>
@endsection
