<?php
// Memanggil file koneksi database
require_once 'koneksi.php';

// 1. LOGIKA FILTER KATEGORI (Tugas Poin 3)
// Mengecek apakah ada parameter 'kategori' di URL (contoh: katalog.php?kategori=Elektronik)
if (isset($_GET['kategori']) && $_GET['kategori'] != '') {
    // mysqli_real_escape_string mengamankan input URL dari SQL Injection
    $kategori_terpilih = mysqli_real_escape_string($koneksi, $_GET['kategori']);
    
    // Query dengan klausa WHERE untuk menyaring kategori tertentu
    $query = "SELECT * FROM produk WHERE kategori = '$kategori_terpilih'";
} else {
    $kategori_terpilih = '';
    // Query default untuk menampilkan semua produk jika tidak ada filter
    $query = "SELECT * FROM produk";
}

// Mengeksekusi query ke database
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Katalog Produk E-Commerce</title>
    <style>
    body {
        font-family: sans-serif;
        margin: 20px;
    }

    .filter-box {
        margin-bottom: 20px;
        padding: 10px;
        background: #f4f4f4;
    }

    .produk-container {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .kartu-produk {
        border: 1px solid #ccc;
        padding: 15px;
        width: 220px;
        border-radius: 5px;
    }

    .badge {
        background: #007bff;
        color: white;
        padding: 3px 8px;
        font-size: 12px;
        border-radius: 3px;
    }
    </style>
</head>

<body>

    <h2>Katalog Produk</h2>

    <!-- FORM FILTER KATEGORI (Menggunakan method GET agar terlihat di URL) -->
    <div class="filter-box">
        <form action="katalog.php" method="GET">
            <label>Filter Kategori: </label>
            <select name="kategori">
                <option value="">-- Semua Kategori --</option>
                <option value="Elektronik" <?= ($kategori_terpilih == 'Elektronik') ? 'selected' : ''; ?>>Elektronik
                </option>
                <option value="Fashion" <?= ($kategori_terpilih == 'Fashion') ? 'selected' : ''; ?>>Fashion</option>
            </select>
            <button type="submit">Terapkan Filter</button>
        </form>
    </div>

    <!-- MENAMPILKAN DATA DENGAN LOOPING (Tugas Poin 2) -->
    <div class="produk-container">
        <?php
        // Mengecek apakah jumlah baris data lebih dari 0
        if (mysqli_num_rows($result) > 0) {
            
            // Looping while mengambil data baris demi baris sebagai array asosiatif
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="kartu-produk">
            <span class="badge"><?= htmlspecialchars($row['kategori']); ?></span>
            <h3><?= htmlspecialchars($row['nama']); ?></h3>
            <p><strong>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></strong></p>
            <p><?= htmlspecialchars($row['deskripsi']); ?></p>
        </div>
        <?php
            } // Akhir dari perulangan while
        } else {
            echo "<p>Tidak ada produk yang ditemukan untuk kategori ini.</p>";
        }
        ?>
    </div>

</body>

</html>