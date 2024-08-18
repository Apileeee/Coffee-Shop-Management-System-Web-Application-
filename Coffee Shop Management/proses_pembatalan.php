<?php
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

// Ambil data dari AJAX request
$idPesanan = $_POST['id_pesanan_batalkan'];

// Mulai transaksi untuk menjaga konsistensi data
$conn->begin_transaction();

try {
    // Ambil data produk yang dibatalkan dari tabel Pesanan
    $sqlGetProduk = "SELECT ID_Produk, Jumlah FROM Pesanan WHERE ID_Pesanan = $idPesanan";
    $resultProduk = $conn->query($sqlGetProduk);

    if ($resultProduk->num_rows > 0) {
        while ($rowProduk = $resultProduk->fetch_assoc()) {
            $idProduk = $rowProduk['ID_Produk'];
            $jumlahProduk = $rowProduk['Jumlah'];

            // Update stok produk dengan menambahkan jumlah yang dibatalkan
            $sqlUpdateStok = "UPDATE Produk SET Stok = Stok + $jumlahProduk WHERE ID_Produk = $idProduk";
            if (!$conn->query($sqlUpdateStok)) {
                throw new Exception("Error updating Product Stock: " . $conn->error);
            }
        }
    }


    // Update status pembayaran menjadi "Dibatalkan" pada tabel Transaksi
    $sqlUpdateStatus = "UPDATE Transaksi SET Status_Pembayaran = 'Dibatalkan' WHERE ID_Transaksi = $idPesanan";
    if (!$conn->query($sqlUpdateStatus)) {
        throw new Exception("Error updating Payment Status: " . $conn->error);
    }

    // Hapus data pesanan dari tabel Pesanan
    $sqlDeletePesanan = "DELETE FROM Pesanan WHERE ID_Pesanan = $idPesanan";
    if (!$conn->query($sqlDeletePesanan)) {
        throw new Exception("Error deleting from Pesanan: " . $conn->error);
    }

    // Commit transaksi jika semua query berhasil
    $conn->commit();

    // Kirim respons ke AJAX
    $response = ['status' => 'success', 'message' => 'Pesanan berhasil dibatalkan.'];
    echo json_encode($response);

    // Arahkan kembali ke daftar_pesanan.php
    header("Location: daftar_pesanan.php");
    exit(); // Penting untuk menghentikan eksekusi skrip setelah header()

} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $conn->rollback();

    // Kirim respons ke AJAX
    $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat membatalkan pesanan.'];
    echo json_encode($response);
} finally {
    // Tutup koneksi ke database
    $conn->close();
}
?>
