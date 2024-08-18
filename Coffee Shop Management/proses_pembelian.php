<?php
// Mulai sesi jika belum dimulai
session_start();

// Periksa apakah ID_Pelanggan sudah diset
$idPelanggan = isset($_SESSION['ID_Pelanggan']) ? $_SESSION['ID_Pelanggan'] : '';

// Jika belum login, arahkan ke halaman login
if (empty($idPelanggan)) {
    header('Location: login.php');
    exit;
}

// Ambil data dari formulir
$idPesanan = $_POST['id_pesanan_bayar'];
$metodePembayaran = "Lunas"; 

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Function untuk update status dan proses pembayaran
function prosesPembayaran($conn, $idPesanan) {
    // Update Pesanan table
    $updatePesananQuery = "UPDATE Pesanan SET Status_Pesanan = 'Dikirim' WHERE ID_Pesanan = $idPesanan";
    $conn->query($updatePesananQuery);

    // Get data from Pesanan table
    $getPesananQuery = "SELECT * FROM Pesanan WHERE ID_Pesanan = $idPesanan";
    $result = $conn->query($getPesananQuery);
    $pesananData = $result->fetch_assoc();

    // Update Transaksi table
    $tanggal = date("Y-m-d");
    $updateTransaksiQuery = "UPDATE Transaksi SET Status_Pembayaran = 'Lunas' WHERE ID_Transaksi = $idPesanan";
    $conn->query($updateTransaksiQuery);
}

// Main process
if (!empty($idPelanggan) && !empty($idPesanan)) {
    prosesPembayaran($conn, $idPesanan);

    // Redirect ke halaman Daftar Pesanan
    header("Location: daftar_pesanan.php");
    exit();
} else {
    echo "Permintaan tidak valid";
}

// Tutup koneksi
$conn->close();
?>
