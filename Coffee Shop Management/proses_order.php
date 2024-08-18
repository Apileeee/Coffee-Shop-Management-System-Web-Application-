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
$idPelanggan = $_POST['id_pelanggan'];
$idProduk = $_POST['product'];
$jumlah = $_POST['jumlah'];
$alamatPengiriman = $_POST['alamat_pengiriman'];
$metodePembayaran = $_POST['metode_pembayaran'];

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

// Ambil harga dan stok produk
$sqlProduk = "SELECT Harga, Stok FROM Produk WHERE ID_Produk = $idProduk";
$resultProduk = $conn->query($sqlProduk);

if ($resultProduk->num_rows > 0) {
    $rowProduk = $resultProduk->fetch_assoc();
    $hargaProduk = $rowProduk['Harga'];
    $stokProduk = $rowProduk['Stok'];

    // Hitung total harga
    $totalHarga = $jumlah * $hargaProduk;

    // Periksa apakah jumlah lebih dari 3 untuk memberikan diskon 10%
    if ($jumlah > 3) {
    $diskon = 0.1; // 10% diskon
    $totalHarga -= $totalHarga * $diskon;
}

    // Periksa apakah stok cukup
if ($stokProduk >= $jumlah) {
    // Kurangi stok produk
    $newStok = $stokProduk - $jumlah;
    $sqlUpdateStok = "UPDATE Produk SET Stok = $newStok WHERE ID_Produk = $idProduk";
    $conn->query($sqlUpdateStok);

        // Simpan pesanan
    $statusPesanan = "Belum Dikirim";
    $statusPembayaran = "Pending";
    $sqlInsertPesanan = "INSERT INTO Pesanan (ID_Pelanggan, ID_Produk, Jumlah, Alamat_Pengiriman, Tanggal_Pesanan, Status_Pesanan) 
    VALUES ($idPelanggan, $idProduk, $jumlah, '$alamatPengiriman', CURDATE(), '$statusPesanan')";
    $conn->query($sqlInsertPesanan);

        // Simpan transaksi
        $idPegawai = 1; // ID_Pegawai yang melakukan pesanan (contoh: ID_Pegawai = 1)
        $sqlInsertTransaksi = "INSERT INTO Transaksi (Tanggal, Total_Harga, Metode_Pembayaran, Status_Pembayaran, ID_Pegawai, ID_Pelanggan) 
        VALUES (CURDATE(), $totalHarga, '$metodePembayaran', '$statusPembayaran', $idPegawai, $idPelanggan)";
        $conn->query($sqlInsertTransaksi);

        echo json_encode(['success' => true, 'message' => 'Pesanan berhasil disimpan.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Stok produk tidak mencukupi.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan.']);
}

// Tutup koneksi
$conn->close();
?>
