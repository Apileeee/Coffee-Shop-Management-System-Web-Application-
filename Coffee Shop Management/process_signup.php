<?php

// Ambil nilai-nilai dari formulir signup
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$address = $_POST['address'];
$email = $_POST['email'];
$cellphone = $_POST['cellphone'];

// Lakukan koneksi ke database (sesuaikan dengan informasi database Anda)
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "coffee_shop";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menyimpan data ke dalam tabel Pelanggan
$sql = "INSERT INTO Pelanggan (Username, Password, Nama, Alamat, Nomor_Telepon, Email) 
VALUES ('$username', '$password', '$name', '$address', '$cellphone', '$email')";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    // Kirim respon JSON yang menandakan pendaftaran berhasil
    echo json_encode(['success' => true]);
} else {
    // Kirim respon JSON yang menandakan pendaftaran gagal
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Tutup koneksi
$conn->close();

?>
