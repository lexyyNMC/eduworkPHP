<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru</title>
</head>

<body>
    <h2>Form Tambah Produk</h2>

    <!-- action: tujuan file pemroses data -->
    <!-- method="POST": cara pengiriman data secara tertutup (tidak muncul di URL) -->
    <form action="proses_produk.php" method="POST">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk"><br><br>

        <label>Harga Produk (Rp):</label><br>
        <input type="number" name="harga_produk"><br><br>

        <label>Deskripsi Produk:</label><br>
        <textarea name="deskripsi_produk" rows="4" cols="30"></textarea><br><br>

        <button type="submit" name="simpan">Simpan Produk</button>
    </form>
</body>

</html>