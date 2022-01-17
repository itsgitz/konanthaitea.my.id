@extends ('layouts.exports_pdf')
@section ('title', 'Pengadaan Stock/Bahan Baku')

@section ('content')
<div id="admin-request-stocks-main" class="body-request-stock">
    <table>
        <tr>
            <td>ID Permohonan</td>
            <td>:</td>
            <td><strong>{{ $id }}</strong></td>
        </tr>
        <tr>
            <td>Dicetak Tanggal</td>
            <td>:</td>
            <td>{{ date('d-m-Y') }}</td>
        </tr>
    </table>
    <div>
        <p>
            Sehubungan dengan adanya keterbatasan <i>stock</i> atau bahan baku yang dibutuhkan untuk produksi minuman <strong>Konan Thai Tea</strong>,
            dengan surat ini bermaksud untuk mengajukan pengadaan atau isi ulang (<i>restock</i>) bahan baku berupa:
        </p>
    </div>
    <div class="break"></div>
    <div id="content">
        <table class="table">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Unit</th>
            </tr>

            @foreach ($requestStocks as $s)
            <tr>
                <td>{{ $s->stock_name }}</td>
                <td>{{ $s->request_quantity }}</td>
                <td>{{ $s->unit_name }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="break"></div>
    <div>
        <p>
            Dan berikut adalah data stock atau bahan baku yang ada saat ini:
        </p>
    </div>
    <div class="break"></div>
    <div id="content">
        <table class="table">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Saat Ini</th>
                <th scope="col">Unit</th>
                <th scope="col">Status Saat Ini</th>
            </tr>

            @foreach ($currentStocks as $s)
            <tr>
                <td>{{ $s->stock_name }}</td>
                <td>{{ $s->stock_quantity }}</td>
                <td>{{ $s->unit_name }}</td>
                <td>{{ $s->stock_status }}</td>
            </tr>
            @endforeach
        </table>
        <div class="break"></div>
        <div>
            <p>
                Demikian surat permohonan ini dibuat dengan sebenarnya. Atas perhatiannya kami ucapkan terima kasih.
            </p>
        </div>
        <div class="break"></div>
        <div class="break"></div>
        <div class="break"></div>
        <div class="break"></div>

        <div id="signature" class="float-start">
            <div class="break"></div>
            <div class="break"></div>
            <div>Pimpinan</div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="break"></div>
            <div class="name-line"></div>
        </div>

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
