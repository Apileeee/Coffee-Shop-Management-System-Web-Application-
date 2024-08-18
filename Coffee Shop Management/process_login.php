<?php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "coffee_shop";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM Pegawai WHERE Username=? AND Password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $resultPegawai = $stmt->get_result();

    $stmt = $conn->prepare("SELECT * FROM Pelanggan WHERE Username=? AND Password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $resultPelanggan = $stmt->get_result();

    if ($resultPegawai->num_rows > 0) {
        $response = array('success' => true, 'role' => 'admin');
        echo json_encode($response);
        exit();
    } elseif ($resultPelanggan->num_rows > 0) {
        // Pelanggan login
        $rowPelanggan = $resultPelanggan->fetch_assoc();
        session_start();
        $_SESSION['ID_Pelanggan'] = $rowPelanggan['ID_Pelanggan'];
        $_SESSION['username'] = $rowPelanggan['Username'];

        $response = array('success' => true, 'role' => 'pelanggan');
        echo json_encode($response);
        exit();
    } else {
        $response = array('success' => false);
        echo json_encode($response);
    }
}

$conn->close();

?>
