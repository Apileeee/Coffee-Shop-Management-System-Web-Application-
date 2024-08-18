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
    $id_produk_hapus = $_POST['id_produk_hapus'];

    // Query untuk menghapus produk
    $query_hapus_produk = "DELETE FROM Produk WHERE ID_Produk = $id_produk_hapus";
    $result_hapus_produk = mysqli_query($conn, $query_hapus_produk);

    if ($result_hapus_produk) {
        // Berhasil menghapus produk
        header("Location: ../dashboard_admin.php");
    } else {
        // Gagal menghapus produk
        echo "error";
    }
}

$conn->close();
?>
