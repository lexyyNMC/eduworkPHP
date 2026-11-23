<?php
// Mengecek apakah halaman diakses lewat pengiriman form (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. DEKLARASI VARIABEL
    // Menangkap data dari form menggunakan superglobal $_POST
    // Fungsi trim() menghapus spasi berlebih di awal/akhir teks
    $nama      = trim($_POST['nama_produk']);
    $harga     = trim($_POST['harga_produk']);
    $deskripsi = trim($_POST['deskripsi_produk']);

    // 2. VALIDASI & PENGGUNAAN IF-ELSE + OPERATOR
    // Operator '||' artinya ATAU. Jika salah satu saja kosong, validasi gagal.
    if (empty($nama) || empty($harga) || empty($deskripsi)) {
        
        echo "<h3 style='color: red;'>Gagal Menyimpan!</h3>";
        echo "<p>Semua kolom (Nama, Harga, dan Deskripsi) wajib diisi dan tidak boleh kosong.</p>";
        echo "<a href='form_produk.php'>&larr; Kembali ke Form</a>";

    } elseif ($harga <= 0) {
        
        // Validasi tambahan menggunakan operator perbandingan '<=' (kurang dari atau sama dengan)
        echo "<h3 style='color: red;'>Harga Tidak Valid!</h3>";
        echo "<p>Harga produk harus lebih besar dari 0.</p>";
        echo "<a href='form_produk.php'>&larr; Kembali ke Form</a>";

    } else {

        // 3. PROSES JIKA VALIDASI LOLOS (SIAP DISIMPAN KE DATABASE)
        // Contoh penggunaan operator aritmatika (misal menghitung PPN 11%)
        $pajak = $harga * 0.11;
        $total_harga = $harga + $pajak;

        echo "<h3 style='color: green;'>Validasi Berhasil! Data Siap Disimpan ke Database.</h3>";
        echo "<ul>";
        echo "<li><strong>Nama Produk:</strong> " . htmlspecialchars($nama) . "</li>";
        echo "<li><strong>Harga Dasar:</strong> Rp " . number_format($harga, 0, ',', '.') . "</li>";
        echo "<li><strong>Harga + PPN (11%):</strong> Rp " . number_format($total_harga, 0, ',', '.') . "</li>";
        echo "<li><strong>Deskripsi:</strong> " . htmlspecialchars($deskripsi) . "</li>";
        echo "</ul>";

        /* --- CATATAN KONEKSI DATABASE (OPSIONAL JIKA SUDAH ADA TABEL) ---
        $koneksi = mysqli_connect("localhost", "root", "", "nama_database");
        $query = "INSERT INTO produk (nama, harga, deskripsi) VALUES ('$nama', '$harga', '$deskripsi')";
        mysqli_query($koneksi, $query);
        */

        echo "<a href='form_produk.php'>+ Input Produk Lain</a>";
    }

} else {
    // Jika seseorang membuka file proses_produk.php langsung tanpa mengisi form
    echo "Akses ditolak. Silakan isi form terlebih dahulu.";
}
?>