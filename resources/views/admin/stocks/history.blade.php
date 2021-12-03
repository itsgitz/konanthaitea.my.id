@extends ('layouts.admin')
@section ('title', 'Riwayat Isi Ulang Stock (Restock)')

@section ('content')
<div class="py-3">
    <h5>Riwayat Isi Ulang Stock (Restock)</h5>

    @include ('shared.message')

    @include ('shared.message')
    <div class="py-2">
        <a
            class="btn btn-success btn-sm @if ($histories->isEmpty()) disabled @endif"
            href="{{ route('admin_export_excel_restock_histories_get') }}"
        >
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
                <th scope="col">Total Pembelian</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col">#</th>
            </thead>

            @if ($histories->isNotEmpty())
                @foreach ($histories as $h)
                <tr>
                    <td>{{ $h->stock_name }}</td>
                    <td>{{ number_format( $h->stock_quantity, 0, '', '.' ) }}</td>
                    <td>{{ $h->unit_name }}</td>
                    <td>Rp. {{ number_format( $h->stock_total_price, 2, ',', '.' ) }}</td>
                    <td>{{ date('d M Y H:i:s', strtotime( $h->stock_created_at )) }}</td>
                    <td>
                        <button
                            class="btn btn-secondary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#show-invoice"
                            data-history-stock-name="{{ $h->stock_name }}"
                            data-history-stock-date="{{ date('d M Y H:i:s', strtotime( $h->stock_created_at )) }}"
                            data-history-stock-invoice-image="{{ $h->invoice_image }}"
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
                        Nama: <span class="fw-bold" id="stock-name"></span>
                    </div>
                    <div class="py-2">
                        Dikirim tanggal: <span id="stock-date" class="fw-bold"></span>
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
