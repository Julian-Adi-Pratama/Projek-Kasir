<?php
session_start();

// Ambil informasi pembayaran dari sesi
$jumlahUang = isset($_SESSION['jumlah_uang']) ? $_SESSION['jumlah_uang'] : 0;
$totalBayar = isset($_SESSION['total_bayar']) ? $_SESSION['total_bayar'] : 0;
$kembali = isset($_SESSION['kembali']) ? $_SESSION['kembali'] : 0;
$barang = isset($_SESSION['barang']) ? $_SESSION['barang'] : [];

// Hapus informasi pembayaran dari sesi setelah diambil
unset($_SESSION['jumlah_uang']);
unset($_SESSION['total_bayar']);
unset($_SESSION['kembali']);
unset($_SESSION['barang']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Bukti Pembayaran</h1>
        <p>No. Transaksi #<?php echo rand(1000000, 9999999); ?></p>
        <p>Bulan, tanggal #<?php echo date("F d, Y"); ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama_barang']); ?></td>
                        <td>Rp <?php echo number_format($item['harga'], 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($item['jumlah']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Uang Yang Dibayarkan: Rp <?php echo number_format($jumlahUang, 2, ',', '.'); ?></p>
        <p>Total: Rp <?php echo number_format($totalBayar, 2, ',', '.'); ?></p>
        <p>Kembalian: Rp <?php echo number_format($kembali, 2, ',', '.'); ?></p>
        <p>Terimakasih telah berbelanja di toko <strong>JULIAN SEHAT SELALU</strong></p>
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
        <button onclick="window.print()" class="btn btn-info">Cetak</button>
    </div>
</body>

</html>