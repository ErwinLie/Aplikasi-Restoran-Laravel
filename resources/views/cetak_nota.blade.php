<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .nota-container { width: 80mm; margin: auto; padding: 10px; border: 1px solid #000; }
        .nota-container h3 { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        table td { padding: 5px; }
        .total { font-weight: bold; }
    </style>
</head>
<body onload="window.print();">

    <div class="nota-container">
        <h3>Restoran GACORRR</h3>
        <p>Jl. Nagoya Kacau. B23, Indonesia</p>
        <hr>

        <p><strong>Kode Transaksi:</strong> {{ $transaksi[0]->kode_transaksi }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi[0]->tanggal }}</p>
        
        <hr>

        <table>
            <tr>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item->nama_menu }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <hr>

        <p><strong>Diskon:</strong> Rp {{ number_format($transaksi[0]->diskon, 0, ',', '.') }}</p>
        <p class="total"><strong>Total Akhir:</strong> Rp {{ number_format($transaksi[0]->total_akhir, 0, ',', '.') }}</p>
        <p><strong>Bayar:</strong> Rp {{ number_format($transaksi[0]->bayar, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp {{ number_format($transaksi[0]->kembalian, 0, ',', '.') }}</p>

        <hr>
        <p>Terima Kasih!</p>
    </div>

</body>
</html>
