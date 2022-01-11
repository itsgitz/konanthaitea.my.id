<table>
    <thead>
        <tr>
            <th scope="col"><b>Nama</b></th>
            <th scope="col"><b>Jumlah</b></th>
            <th scope="col"><b>Unit</b></th>
            <th scope="col"><b>Total Pembelian</b></th>
            <th scope="col"><b>Ditambahkan Tangal</b></th>
            <th scope="col"><b>Bukti Pembelian</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($histories as $h)
        <tr>
            <td>{{ $h->stock_name }}</td>
            <td>{{ $h->stock_quantity }}</td>
            <td>{{ $h->unit_name }}</td>
            <td>Rp. {{ number_format( $h->stock_total_price, 0, '', '.' ) }}</td>
            <td>{{ date('d M Y H:i:s', strtotime( $h->stock_created_at )) }}</td>
            <td>
                <img
                    src="{{ str_replace('/framework/views', '', __DIR__) . '/app/public' . str_replace('/storage', '', $h->invoice_image) }}"
                    alt="bukti-pembelian"
                    width="200px"
                >
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
