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
    $id_kategori_hapus = $_POST['id_kategori_hapus'];

    // Query untuk menghapus kategori produk
    $query_hapus_kategori = "DELETE FROM Kategori_Produk WHERE ID_Kategori = '$id_kategori_hapus'";
    $result_hapus_kategori = mysqli_query($conn, $query_hapus_kategori);

    if ($result_hapus_kategori) {
        // Berhasil menghapus kategori produk
        header("Location: ../dashboard_admin.php");
    } else {
        // Gagal menghapus kategori produk
        echo "error";
    }
}

// Menutup koneksi ke database
$conn->close();
?>
