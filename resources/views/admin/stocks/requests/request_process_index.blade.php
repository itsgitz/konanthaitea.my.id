@extends ('layouts.admin')
@section ('title', 'Proses Pengadaan Stock')

@section ('content')
<div id="admin-stock-request-process" class="py-3">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">ID Permohonan</th>
                <th scope="col">Dibuat Tanggal</th>
                <th scope="col" colspan="2">#</th>
            </thead>
            @if ($requestStocks->isEmpty())
                <tr>
                    <td class="fw-light text-center" colspan="3">Belum ada request pengadaan stock</td>
                </tr>
            @else
                @foreach ($requestStocks as $rs)
                <tr class="fw-light">
                    <td>{{ $rs->request_id }}</td>
                    <td>{{ $rs->created_at }}</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin_export_pdf_request_stock_get', ['id' => $rs->request_id]) }}">
                            <i class="fas fa-file-pdf"></i> Download Surat Pengajuan
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="">
                            Proses
                        </a>
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>

    <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_request_get') }}">Kembali</a>
</div>
@endsection
