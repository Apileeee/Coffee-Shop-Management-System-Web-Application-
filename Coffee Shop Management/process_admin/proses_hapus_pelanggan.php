<?php
// Proses penghapusan data Pelanggan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan bahwa ID Pelanggan dikirimkan melalui POST
    if (isset($_POST['id_pelanggan_hapus'])) {
        $id_pelanggan_hapus = $_POST['id_pelanggan_hapus'];

        // Lakukan koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffee_shop";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk menghapus data Pelanggan berdasarkan ID Pelanggan
        $sql = "DELETE FROM Pelanggan WHERE ID_Pelanggan = $id_pelanggan_hapus";

        if ($conn->query($sql) === TRUE) {
            // Jika penghapusan berhasil, redirect atau tampilkan pesan sukses
            header("Location: ../dashboard_admin.php");
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // Jika ID Pelanggan tidak dikirimkan, tampilkan pesan error
        echo "ID Pelanggan tidak ditemukan.";
    }
} else {
    // Jika metode request bukan POST, tampilkan pesan error
    echo "Metode request tidak valid.";
}
?>
