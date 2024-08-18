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
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori_produk = $_POST['kategori_produk'];

    // Query untuk menambahkan produk
    $query_produk = "INSERT INTO Produk (Nama_Produk, Harga, Stok, ID_Kategori) VALUES ('$nama_produk', '$harga', '$stok', '$kategori_produk')";
    $result_produk = mysqli_query($conn, $query_produk);

    if ($result_produk) {
        // Berhasil menambah produk
        echo "success";
    } else {
        // Gagal menambah produk
        echo "error";
    }
}

// Menutup koneksi ke database
$conn->close();
?>
