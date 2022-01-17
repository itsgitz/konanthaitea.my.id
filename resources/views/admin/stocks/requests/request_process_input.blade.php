@extends ('layouts.admin')
@section ('title', 'Input Stock')

@section ('content')
<div id="admin-stock-request-input" class="py-3">
    <h5>Input Pengadaan Stock</h5>

    @include ('shared.message')

    <div class="fw-light">ID Permohonan: <strong>#{{ $id }}</strong></div>
    <div class="py-3"></div>
    <form action="{{ route('admin_stocks_request_process_input_post', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Permohonan</th>
                <th scope="col">Jumlah Diproses</th>
                <th scope="col">Unit</th>
                <th scope="col">Total Pembayaran (Rp.)</th>
                <th scope="col">Keterangan</th>
            </thead>
            @foreach ($requestStock as $rs)
                <tr class="fw-light">
                    <td>{{ $rs->stock_name }}</td>
                    <td>{{ $rs->request_quantity }}</td>
                    <td>
                        <div class="mb-3 col-md-6">
                            <input type="hidden" name="request_stock[{{ $loop->index }}][request_stock_id]" value="{{ $rs->request_stock_id }}">
                            <input type="hidden" name="request_stock[{{ $loop->index }}][stock_id]" value="{{ $rs->stock_id }}">
                            <input class="form-control" type="number" name="request_stock[{{ $loop->index }}][processed_quantity]" min="1" required>
                        </div>
                    </td>
                    <td>{{ $rs->unit_name }}</td>
                    <td>
                        <div class="mb-3 col-md-10">
                            <input class="form-control" type="number" name="request_stock[{{ $loop->index }}][price]" required>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <textarea class="form-control" name="request_stock[{{ $loop->index }}][description]"></textarea>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="py-3"></div>

        <div class="mb-3 col-md-4 fw-light">
            <label class="form-label" for="upload">Upload Bukti Pembelian</label>
            <input class="form-control form-control-sm" name="upload_invoice" type="file" required>
            @error ('upload_invoice')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>

        <div class="py-3"></div>

        <a class="btn btn-sm btn-danger" href="{{ route('admin_stocks_request_process_get') }}">Kembali</a>
        <input class="btn btn-sm btn-secondary" type="submit" value="Simpan">
    </form>
</div>
@endsection
