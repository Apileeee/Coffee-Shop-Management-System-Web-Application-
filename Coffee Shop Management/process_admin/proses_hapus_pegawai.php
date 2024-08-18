<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID Pegawai yang akan dihapus
$id_pegawai = $_POST['id_pegawai_hapus'];

// Query hapus Pegawai
$sql = "DELETE FROM Pegawai WHERE ID_Pegawai = '$id_pegawai'";

if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke dashboard_admin.php setelah penghapusan berhasil
    header("Location: ../dashboard_admin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
