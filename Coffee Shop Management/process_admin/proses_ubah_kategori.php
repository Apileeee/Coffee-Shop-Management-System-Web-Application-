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
    $id_kategori_ubah = $_POST['id_kategori_ubah'];
    $nama_kategori_ubah = $_POST['nama_kategori_ubah'];

    // Query untuk mengubah nama kategori
    $query_ubah_kategori = "UPDATE Kategori_Produk SET Nama_Kategori = '$nama_kategori_ubah' WHERE ID_Kategori = '$id_kategori_ubah'";
    $result_ubah_kategori = mysqli_query($conn, $query_ubah_kategori);

    if ($result_ubah_kategori) {
        // Berhasil mengubah kategori produk
        echo "success";
    } else {
        // Gagal mengubah kategori produk
        echo "error";
    }
}

// Menutup koneksi ke database
$conn->close();
?>
