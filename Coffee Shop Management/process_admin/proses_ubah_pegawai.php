<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pegawai_ubah = $_POST["id_pegawai_ubah"];
    $nama_ubah = $_POST["nama_ubah"];
    $alamat_ubah = $_POST["alamat_ubah"];
    $nomor_telepon_ubah = $_POST["nomor_telepon_ubah"];
    $jenis_kelamin_ubah = $_POST["jenis_kelamin_ubah"];

    // Update data pada tabel Pegawai
    $sqlPegawai = "UPDATE Pegawai SET Nama = '$nama_ubah', Alamat = '$alamat_ubah', Nomor_Telepon = '$nomor_telepon_ubah', Jenis_Kelamin = '$jenis_kelamin_ubah' WHERE ID_Pegawai = $id_pegawai_ubah";

    // Eksekusi query untuk tabel Pegawai
    if ($conn->query($sqlPegawai) !== TRUE) {
        echo "Error: " . $sqlPegawai . "<br>" . $conn->error;
    }

    // Update data pada tabel Informasi_Pegawai
    $nomor_ktp_ubah = $_POST["nomor_ktp_ubah"];
    $gaji_ubah = $_POST["gaji_ubah"];

    $sqlInformasiPegawai = "UPDATE Informasi_Pegawai SET Nomor_KTP = '$nomor_ktp_ubah', Gaji = '$gaji_ubah' WHERE ID_Pegawai = $id_pegawai_ubah";

    // Eksekusi query untuk tabel Informasi_Pegawai
    if ($conn->query($sqlInformasiPegawai) !== TRUE) {
        echo "Error: " . $sqlInformasiPegawai . "<br>" . $conn->error;
    }

    header("Location: ../dashboard_admin.php");
}

$conn->close();
?>
