<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah formulir sudah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_ktp = $_POST['nomor_ktp'];
    $gaji = $_POST['gaji'];

    // Masukkan data ke tabel Pegawai
    $insertPegawai = "INSERT INTO Pegawai (Username, Password, Nama, Alamat, Nomor_Telepon, Jenis_Kelamin) 
    VALUES ('', '', '$nama', '$alamat', '$nomor_telepon', '$jenis_kelamin')";
    $resultPegawai = $conn->query($insertPegawai);

    if ($resultPegawai) {
        // Jika penyisipan Pegawai berhasil, dapatkan ID_Pegawai
        $ID_Pegawai = $conn->insert_id;

        // Masukkan data ke tabel Informasi_Pegawai
        $insertInformasiPegawai = "INSERT INTO Informasi_Pegawai (ID_Pegawai, Nomor_KTP, Gaji) 
        VALUES ('$ID_Pegawai', '$nomor_ktp', '$gaji')";
        $resultInformasiPegawai = $conn->query($insertInformasiPegawai);

        if ($resultInformasiPegawai) {
            // Penyisipan Informasi_Pegawai berhasil
            echo "Pegawai berhasil ditambahkan";
        } else {
            // Penyisipan Informasi_Pegawai gagal
            echo "Error: " . $insertInformasiPegawai . "<br>" . $conn->error;
        }
    } else {
        // Penyisipan Pegawai gagal
        echo "Error: " . $insertPegawai . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
