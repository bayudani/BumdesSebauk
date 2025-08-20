<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        /* CSS untuk PDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .kop-surat {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat td {
            vertical-align: middle;
        }

        .logo {
            width: 80px;
        }

        .company-details {
            text-align: center;
        }

        .company-details h1 {
            margin: 0;
            font-size: 24px;
        }

        .company-details p {
            margin: 0;
            font-size: 12px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.data th,
        table.data td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table.data th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }

        /* [BARU] Style untuk blok tanda tangan */
        .signature-block {
            width: 30%;
            text-align: center;
            margin-left: 70%;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <table class="kop-surat">
        <tr>
            <td style="width: 15%;">
                <img src="{{ public_path('assets/images/logobks.png') }}" alt="Logo" class="logo">
            </td>
            <td class="company-details">
                <h1>BUMDES Sebauk Gemilang</h1>
                <p>Jln. Utama Desa Sebauk, Kecamatan Bengkalis, Kabupaten Bengkalis</p>
                <p>Email: bumdessebaukgmail.com | No HP: (62) 812 7695 012</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <h2 style="text-align: center;">Laporan Transaksi</h2>
    <p>Tanggal Cetak: {{ date('d F Y') }}</p>

    <table class="data">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Produk</th>
                <th>Pelanggan</th>
                <th>Total Bayar</th>
                <th>Status Pesanan</th>
                <th>Status Bayar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_code }}</td>
                    <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->customer_name }}</td>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($transaction->order_status) }}</td>
                    <td>{{ ucfirst($transaction->transaction_status) }}</td>
                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data yang cocok dengan filter.</td>
                </tr>
            @endforelse
        </tbody>
        {{-- [BARU] Tambahkan footer tabel untuk Grand Total --}}
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: left; font-weight: bold; border: 1px solid #ccc; padding: 8px;">
                    Grand Total</th>
                <th colspan="4" style="text-align: right; font-weight: bold; border: 1px solid #ccc; padding: 8px;">
                    Rp {{ number_format($totalAmount, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    {{-- [BARU] Tambahkan blok tanda tangan --}}
    <div class="signature-block">
        <p>Mengetahui,</p>
        <br>
        <br>
        <br>
        <p style="font-weight: bold; text-decoration: underline;">{{ $directorName }}</p>
        <p>Direktur BUMDES</p>
    </div>

    <div class="footer">
        Laporan ini dibuat secara otomatis oleh sistem.
    </div>

</body>

</html>
