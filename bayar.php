<?php
session_start();

// Hitung total yang harus dibayarkan
$totalBayar = 0;
foreach ($_SESSION['barang'] as $barang) {
    $totalBayar += $barang['total'];
}

// Tangani aksi tombol bayar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    $jumlahUang = $_POST['jumlah_uang'];
    if ($jumlahUang >= $totalBayar) {
        // Simpan informasi pembayaran ke sesi
        $_SESSION['jumlah_uang'] = $jumlahUang;
        $_SESSION['total_bayar'] = $totalBayar;
        $kembali = $jumlahUang - $totalBayar;
        $_SESSION['kembali'] = $kembali;

        // Redirect ke halaman cetak
        header("Location: cetak.php");
        exit;
    } else {
        $message = "Uang tidak cukup untuk membayar!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Sekarang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bayar Sekarang</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <input type="number" name="jumlah_uang" class="form-control" placeholder="Jumlah Uang" required>
            </div>
            <p>Total yang harus dibayarkan: Rp. <?php echo number_format($totalBayar, 2, ',', '.'); ?></p>
            <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
            <a href="index.php" class="btn btn-secondary">← Kembali</a>
        </form>
    </div>
</body>
</html>