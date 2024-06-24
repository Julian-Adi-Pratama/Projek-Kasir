<?php
session_start();

// Inisialisasi array barang jika belum ada
if (!isset($_SESSION['barang'])) {
  $_SESSION['barang'] = [];
}

// Tambah barang ke sesi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
  $namaBarang = $_POST['nama_barang'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];

  // Validasi input
  if ($namaBarang != "" && $harga != "" && $jumlah != "") {
    $total = $harga * $jumlah;
    $item = [
      'nama_barang' => $namaBarang,
      'harga' => $harga,
      'jumlah' => $jumlah,
      'total' => $total,
    ];

    $_SESSION['barang'][] = $item;
  }
}

// Hapus barang dari sesi
if (isset($_GET['hapus'])) {
  $index = $_GET['hapus'];
  unset($_SESSION['barang'][$index]);
  // Reset array keys
  $_SESSION['barang'] = array_values($_SESSION['barang']);

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOKO JULIAN SEHAT SELALU </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    @media only screen and (max-width: 320px) {
      .table-responsive {
        overflow-x: auto;
      }

      .container {
        max-width: 100%;
        padding: 15px;
      }

      .form-group {
        margin-bottom: 10px;
      }

      .table {
        font-size: 14px;
      }

      .table th,
      .table td {
        padding: 8px;
      }
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center">Masukan Data Barang</h1>
    <form method="POST" action="">
      <div class="form-group">
        <input type="text" name="nama_barang" class="form-control" placeholder="Nama barang" required>
      </div>
      <div class="form-group">
        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
      </div>
      <div class="form-group">
        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
      </div>
      <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      <a href="bayar.php" class="btn btn-success">Bayar</a>
    </form>
    <h2 class="mt-4">List Barang</h2>
    <div class="bungkus">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($_SESSION['barang'])): ?>
              <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
              </tr>
            <?php else: ?>
              <?php foreach ($_SESSION['barang'] as $index => $barang): ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                  <td><?php echo htmlspecialchars($barang['harga']); ?></td>
                  <td><?php echo htmlspecialchars($barang['jumlah']); ?></td>
                  <td><?php echo htmlspecialchars($barang['total']); ?></td>
                  <td>
                    <a href="?hapus=<?php echo $index; ?>" class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>