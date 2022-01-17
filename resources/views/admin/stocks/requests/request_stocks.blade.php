@extends ('layouts.admin')
@section ('title', 'Isi Ulang Stock')

@section ('content')
<div id="admin-stock-request" class="py-3">
    <h5>Isi Ulang Stock</h5>

    @include ('shared.message')

    <div class="pt-2 pb-3">
        <a class="btn btn-sm btn-primary" href="{{ route('admin_stocks_request_process_get') }}">
            <i class="fas fa-window-restore"></i> Proses Pengadaan
        </a>
    </div>

    <form action="{{ route('admin_stocks_request_post') }}" method="post">
        @csrf
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Saat Ini</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Status</th>
                    <th scope="col">Jumlah Pengajuan</th>
                </thead>
                @if ($stocks->isEmpty())
                    <tr>
                        <td class="fw-light text-center" colspan="6">Saat ini belum ada stock yang terbatas</td>
                    </tr>
                @else
                    @foreach ($stocks as $s)
                    <tr class="fw-light">
                        <td>{{ $s->stock_name }}</td>
                        <td>{{ $s->stock_quantity }}</td>
                        <td>{{ $s->unit_name }}</td>
                        <td>{{ $s->stock_status }}</td>
                        <td>
                            <div class="mb-3 col-md-4">
                                <input type="hidden" name="stocks[{{ $loop->index }}][stock_id]" value="{{ $s->stock_id }}">
                                <input class="form-control" name="stocks[{{ $loop->index }}][request_quantity]" type="number" min="1">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="pt-2 pb-3">
            <button type="submit" class="btn btn-secondary btn-sm">
                <i class="fab fa-opencart"></i> Request Pengadaan
            </button>
        </div>
    </form>

    <div class="py-3"></div>

    <a class="btn btn-danger btn-sm" href="{{ route('admin_stocks_get') }}">Kembali</a>
</div>
@endsection
