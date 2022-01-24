@extends ('layouts.exports_pdf')
@section ('title', 'Riwayat Isi Ulang')

@section ('content')
<div id="admin-restock-histories-main">
    <table>
       <tr>
            <td>Tanggal Cetak:</td>
            <td>:</td>
            <td>{{ date('d-m-Y') }}</td>
       </tr>
        <tr>
            <td><strong>*Catatan, ID</strong></td>
            <td>:</td>
            <td>ID Permohonan</td>
        </tr>
    </table>
    <div class="break"></div>
    <div id="content">
        <table class="table table-hover">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total Harga (Rp.)</th>
                <th scope="col">Total Pembayaran (Rp.)</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">#</th>
            </tr>

            @if (isset($histories))
                @foreach ($histories as $h)
                <tr>
                    <td>{{ substr( $h['request_id'], 0, 13 ) }}</td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>- {{ $item->stock_name }}</div>
                        @endforeach
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>- {{ number_format( $item->stock_quantity, 0, '', '.' ) }} {{ $item->unit_name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($h['items'] as $item)
                        <div>- {{ number_format( $item->total_price, 2, ',', '.' ) }}</div>
                        @endforeach
                    </td>
                    <td>{{ number_format( $h['total_pay'], 2, ',', '.' ) }}</td>
                    <td>{{ date('d M Y H:i:s', strtotime( $h['created_at'] )) }}</td>
                    <td>
                        <img src="{{ public_path($h['invoice_image']) }}" alt="invoice" width="200">
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center fw-light">Data riwayat isi ulang stock kosong</td>
                </tr>
            @endif
        </table>

        <div class="break"></div>
        <div class="break"></div>
        <div class="break"></div>
        <div class="break"></div>

        <div id="signature" class="float-end">
            <div>Bandung, {{ date('d-m-Y') }}</div>
            <div class="break"></div>
            <div>Administrasi</div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="name-line"></div>
        </div>
    </div>
</div>
@endsection
