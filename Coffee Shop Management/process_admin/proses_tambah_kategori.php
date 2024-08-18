<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    // Query untuk menambahkan kategori produk
    $query_kategori = "INSERT INTO Kategori_Produk (Nama_Kategori) VALUES ('$nama_kategori')";
    $result_kategori = mysqli_query($conn, $query_kategori);

    if ($result_kategori) {
        // Berhasil menambahkan kategori produk
        echo "success";
    } else {
        // Gagal menambahkan kategori produk
        echo "error";
    }
}

// Menutup koneksi ke database
$conn->close();
?>
