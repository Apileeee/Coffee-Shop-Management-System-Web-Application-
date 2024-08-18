<?php

$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "coffee_shop"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk membuat tabel Pegawai
$sqlPegawai = "CREATE TABLE Pegawai (
    ID_Pegawai INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Nama VARCHAR(100) NOT NULL,
    Alamat VARCHAR(255),
    Nomor_Telepon VARCHAR(15),
    Jenis_Kelamin VARCHAR(10)
)";

// Eksekusi query
if ($conn->query($sqlPegawai) === TRUE) {
    echo "Tabel Pegawai berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlPegawai . "<br>" . $conn->error;
}

// Query untuk membuat tabel Informasi Pegawai
$sqlInformasiPegawai = "CREATE TABLE Informasi_Pegawai (
    ID_Informasi_Pegawai INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pegawai INT,
    Nomor_KTP VARCHAR(16),
    Gaji DECIMAL(12,2),
    FOREIGN KEY (ID_Pegawai) REFERENCES Pegawai(ID_Pegawai) ON UPDATE CASCADE ON DELETE CASCADE
)";

// Eksekusi query
if ($conn->query($sqlInformasiPegawai) === TRUE) {
    echo "Tabel Informasi Pegawai berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlInformasiPegawai . "<br>" . $conn->error;
}

// Query untuk membuat tabel Pelanggan
$sqlPelanggan = "CREATE TABLE Pelanggan (
    ID_Pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Nama VARCHAR(100) NOT NULL,
    Alamat VARCHAR(255),
    Nomor_Telepon VARCHAR(15),
    Email VARCHAR(100)
)";

// Eksekusi query
if ($conn->query($sqlPelanggan) === TRUE) {
    echo "Tabel Pelanggan berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlPelanggan . "<br>" . $conn->error;
}

// Query untuk membuat tabel Kategori Produk
$sqlKategoriProduk = "CREATE TABLE Kategori_Produk (
    ID_Kategori INT AUTO_INCREMENT PRIMARY KEY,
    Nama_Kategori VARCHAR(50) NOT NULL
)";

// Eksekusi query
if ($conn->query($sqlKategoriProduk) === TRUE) {
    echo "Tabel Kategori Produk berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlKategoriProduk . "<br>" . $conn->error;
}

// Query untuk membuat tabel Produk
$sqlProduk = "CREATE TABLE Produk (
    ID_Produk INT AUTO_INCREMENT PRIMARY KEY,
    Nama_Produk VARCHAR(100) NOT NULL,
    Harga DECIMAL(12,2) NOT NULL,
    Stok INT NOT NULL,
    ID_Kategori INT,
    FOREIGN KEY (ID_Kategori) REFERENCES Kategori_Produk(ID_Kategori) ON UPDATE CASCADE ON DELETE CASCADE
)";

// Eksekusi query
if ($conn->query($sqlProduk) === TRUE) {
    echo "Tabel Produk berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlProduk . "<br>" . $conn->error;
}

// Query untuk membuat tabel Pesanan
$sqlPesanan = "CREATE TABLE Pesanan (
    ID_Pesanan INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pelanggan INT,
    ID_Produk INT,
    Jumlah INT NOT NULL,
    Alamat_Pengiriman VARCHAR(255),
    Tanggal_Pesanan DATE NOT NULL,
    Status_Pesanan VARCHAR(20),
    FOREIGN KEY (ID_Pelanggan) REFERENCES Pelanggan(ID_Pelanggan) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_Produk) REFERENCES Produk(ID_Produk) ON UPDATE CASCADE ON DELETE CASCADE
)";

// Eksekusi query
if ($conn->query($sqlPesanan) === TRUE) {
    echo "Tabel Pesanan berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlPesanan . "<br>" . $conn->error;
}

// Query untuk membuat tabel Transaksi
$sqlTransaksi = "CREATE TABLE Transaksi (
    ID_Transaksi INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pesanan INT,
    Tanggal DATE NOT NULL,
    Total_Harga DECIMAL(12,2) NOT NULL,
    Metode_Pembayaran VARCHAR(20),
    Status_Pembayaran VARCHAR(20),
    ID_Pegawai INT,
    ID_Pelanggan INT,
    FOREIGN KEY (ID_Pesanan) REFERENCES Pesanan(ID_Pesanan) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_Pegawai) REFERENCES Pegawai(ID_Pegawai) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_Pelanggan) REFERENCES Pelanggan(ID_Pelanggan) ON UPDATE CASCADE ON DELETE CASCADE
)";


// Eksekusi query
if ($conn->query($sqlTransaksi) === TRUE) {
    echo "Tabel Transaksi berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlTransaksi . "<br>" . $conn->error;
}


// Tutup koneksi
$conn->close();

?>
