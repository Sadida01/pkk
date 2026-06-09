<?php
include "koneksi.php";
if(isset($_POST['simpan'])){
    $nama   = $_POST['nama'];
    $produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];

    $q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$produk'");
    $p = mysqli_fetch_array($q);
    $total = $p['harga'] * $jumlah;

    mysqli_query($conn, "INSERT INTO pelanggan (nama) VALUES ('$nama')");
    $id_pelanggan = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO transaksi (id_pelanggan, total) VALUES ('$id_pelanggan','$total')");
    $id_transaksi = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO transaksi_detail (id_transaksi, id_produk, jumlah, harga)
                         VALUES ('$id_transaksi','$produk','$jumlah','".$p['harga']."')");
    echo "<script>alert('Transaksi berhasil disimpan');</script>";
}
?>

<!DOCTYPE html>
<html>
<head><title>Transaksi Dare Coffee</title></head>
<body>
<h2>Tambah Transaksi</h2>
<form method="post">
    Nama Pelanggan : <input type="text" name="nama" required><br><br>
    Produk :
    <select name="produk">
        <?php
        $data = mysqli_query($conn, "SELECT * FROM produk");
        while($d = mysqli_fetch_array($data)){
            echo "<option value='$d[id_produk]'>$d[nama_produk] - Rp ".number_format($d['harga'])."</option>";
        }
        ?>
    </select><br><br>
    Jumlah : <input type="number" name="jumlah" required><br><br>
    <input type="submit" name="simpan" value="Simpan Transaksi">
</form>
</body>
</html>
