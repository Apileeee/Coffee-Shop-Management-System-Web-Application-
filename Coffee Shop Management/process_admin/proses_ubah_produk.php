<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk_ubah = $_POST['id_produk_ubah'];
    $nama_produk_ubah = $_POST['nama_produk_ubah'];
    $harga_produk_ubah = $_POST['harga_produk_ubah'];
    $stok_produk_ubah = $_POST['stok_produk_ubah'];
    $kategori_produk_ubah = $_POST['kategori_produk_ubah'];

    // Query untuk mengubah data produk
    $query_produk = "UPDATE Produk SET Nama_Produk = '$nama_produk_ubah', Harga = '$harga_produk_ubah', Stok = '$stok_produk_ubah', ID_Kategori = '$kategori_produk_ubah' WHERE ID_Produk = '$id_produk_ubah'";
    $result_produk = mysqli_query($conn, $query_produk);

    if ($result_produk) {
        // Berhasil mengubah data produk
        echo "success";
    } else {
        // Gagal mengubah data produk
        echo "error";
    }
}

$conn->close();
?>
