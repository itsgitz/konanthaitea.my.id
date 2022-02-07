@extends ('layouts.admin')
@section ('title', 'Riwayat Isi Ulang Stock (Restock)')

@section ('content')
<div id="admin-restock-main" class="py-3">
    <h5>Riwayat Isi Ulang Stock (Restock)</h5>

    @include ('shared.message')
    <div class="py-2">
        {{--
        <a
            class="btn btn-primary btn-sm @if (!isset($histories)) disabled @endif"
            href="{{ route('admin_export_pdf_restock_histories_get') }}"
        >
            <i class="fas fa-file-pdf"></i> Export ke PDF
        </a>
        --}}

        <button id="export-pdf-button" type="button" class="btn btn-primary btn-sm @if (!isset($histories)) disabled @endif">
            <i class="fas fas fa-file-pdf"></i> Export ke PDF
        </button>

        {{-- Datepicker --}}
        <form action="{{ route('admin_export_pdf_restock_histories_post') }}" method="post">
            @csrf
            <div class="py-2"></div>
            <div id="datepicker-box" class="p-3 bg-light shadow rounded fw-light d-none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <label class="col-form-label input-group-text fw-light" for="date-from">Dari Tanggal</label>
                            <input id="date-from" name="from" class="form-control form-control-sm" type="text" required>
                            <span class="input-group-text"><i class="far fa-calendar-alt d-inline"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label class="col-form-label input-group-text fw-light" for="date-from">Sampai Tanggal</label>
                            <input id="date-to" name="to" class="form-control form-control-sm" type="text" required>
                            <span class="input-group-text"><i class="far fa-calendar-alt d-inline"></i></span>
                        </div>
                    </div>
                </div>
                <div class="py-2"></div>
                <input class="btn btn-sm btn-secondary shadow" type="submit" value="Export">
            </div>
            <div class="py-2"></div>
        </form>
        {{-- Datepicker --}}
    </div>
    <div class="table-responsive">
        <table class="table table-hover fw-light">
            <thead>
                <th scope="col">ID Permohonan</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Total Pembayaran</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Bukti Pembayaran</th>
            </thead>

            @if (isset($histories))
                @foreach ($histories as $h)
                <tr>
                    <td>{{ $h['request_id'] }}</td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>{{ $item->stock_name }}</div>
                        @endforeach
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>{{ number_format( $item->stock_quantity, 0, '', '.' ) }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>{{ $item->unit_name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>Rp. {{ number_format( $item->total_price, 2, ',', '.' ) }}</div>
                        @endforeach
                    </td>
                    <td>Rp. {{ number_format( $h['total_pay'], 2, ',', '.' ) }}</td>
                    <td>{{ date('d M Y H:i:s', strtotime( $h['created_at'] )) }}</td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>{{ $item->description }}</div>
                        @endforeach
                    </td>
                    <td>
                        <button
                            class="btn btn-secondary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#show-invoice"
                            data-history-stock-name="{{ $h['request_id'] }}"
                            data-history-stock-date="{{ date('d M Y H:i:s', strtotime( $h['created_at'] )) }}"
                            data-history-stock-invoice-image="{{ $h['invoice_image'] }}"
                            onclick="showInvoice(this)"
                        >
                            <i class="fas fa-file-image"></i> Bukti Pembelian
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center fw-light">Data riwayat isi ulang stock kosong</td>
                </tr>
            @endif
        </table>
    </div>

    <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>

    {{-- SHOW INVOICE --}}
    <div id="show-invoice" class="modal fade" tabindex="-1" aria-labelledby="show-invoice-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Pembayaran</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="py-2">
                        ID Permohonan: <span class="fw-bold" id="stock-name"></span>
                    </div>
                    <div class="py-2">
                        Dibuat Tanggal: <span id="stock-date" class="fw-bold"></span>
                    </div>
                    <div class="py-2 border-top">
                        <img id="invoice-image" class="img-fluid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SHOW INVOICE --}}


    <script>
        function showInvoice(el) {
            let stockNameEl = document.querySelector('#stock-name');
            let stockDateEl = document.querySelector('#stock-date');
            let invoiceImage = document.querySelector('#invoice-image');

            let historyStockName = el.dataset.historyStockName;
            let historyStockDate = el.dataset.historyStockDate;
            let historyStockInvoiceImage = el.dataset.historyStockInvoiceImage;

            stockNameEl.innerHTML = historyStockName;
            stockDateEl.innerHTML = historyStockDate;
            invoiceImage.src = historyStockInvoiceImage;
        }
    </script>
</div>
@endsection
