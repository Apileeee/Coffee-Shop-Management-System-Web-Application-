<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME BACK ADMIN ONE PIECE</title>
    <link rel="icon" type="image/png" href="./img/logo.png">
    <link rel="stylesheet" type="text/css" href="./home/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark sticky-top">
        <div class="container">
            <a class="logo" href="dashboard_admin.php" style="color: orange";>One<span style="color: blue;"> Piece</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="daftar_orderan.php">Daftar Orderan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="javascript:void(0);" onclick="confirmLogout()">Log Out</a>
                    </li>
                    <script>
                        function confirmLogout() {
                            Swal.fire({
                                title: 'Logout',
                                text: 'Apakah Anda yakin ingin logout?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Tidak'
                            }).then((result) => {
                                if (result.isConfirmed) {
                            // Jika 'Ya' dipilih, arahkan ke index.html atau sesuai dengan kebutuhan Anda
                                    window.location.replace('./home/index.html')
                                    history.replaceState(null, null, './home/index.html');;
                                }
                            });
                        }
                    </script>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Tambahkan Tombol untuk Menambah Data Pegawai -->
    <div class="container mt-5">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPegawaiModal">Tambah Pegawai</button>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data Pegawai -->
                    <form id="formTambahPegawai" method="post" action="./process_admin/proses_tambah_pegawai.php">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!-- Kolom-kolom dari tabel Informasi_Pegawai -->
                        <div class="mb-3">
                            <label for="nomor_ktp" class="form-label">Nomor KTP:</label>
                            <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp">
                        </div>
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji:</label>
                            <input type="text" class="form-control" id="gaji" name="gaji">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('form#formTambahPegawai').submit(function (e) {
            e.preventDefault(); // Menghentikan pengiriman formulir biasa

            // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Menampilkan SweetAlert ketika respons berhasil diterima
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data Pegawai berhasil ditambahkan',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = 'dashboard_admin.php';
                        }
                    });
                },
                error: function (error) {
                    // Menampilkan pesan error jika terjadi kesalahan
                    console.log('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi!',
                    });
                }
            });
        });
        });
    </script>


    <!-- Tampilkan Data Pegawai -->
    <div class="container mt-3">
        <h3 class="display-6" style="color: orange;">Pega<span style="color: blue;">wai</span></h3>
        <!-- Tampilkan tabel data Pegawai -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffee_shop";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "SELECT Pegawai.*, Informasi_Pegawai.Nomor_KTP, Informasi_Pegawai.Gaji
        FROM Pegawai
        LEFT JOIN Informasi_Pegawai ON Pegawai.ID_Pegawai = Informasi_Pegawai.ID_Pegawai";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table'>
            <thead>
            <tr>
            <th>ID Pegawai</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Jenis Kelamin</th>
            <th>Nomor KTP</th>
            <th>Gaji</th>
            </tr>
            </thead>
            <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["ID_Pegawai"] . "</td>
                <td>" . $row["Username"] . "</td>
                <td>" . $row["Nama"] . "</td>
                <td>" . $row["Alamat"] . "</td>
                <td>" . $row["Nomor_Telepon"] . "</td>
                <td>" . $row["Jenis_Kelamin"] . "</td>
                <td>" . $row["Nomor_KTP"] . "</td>
                <td>" . $row["Gaji"] . "</td>
                </tr>";
            }

            echo "</tbody>
            </table>";
        } else {
            echo "Tabel belum terisi.";
        }

        $conn->close();
        ?>
    </div>


    <!-- Tombol Hapus dan Ubah -->
    <div class="container mt-3">
        <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#hapusPegawaiModal">Hapus Pegawai</button>
        <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#ubahPegawaiModal">Ubah Pegawai</button>
    </div>

    <!-- Modal Hapus Pegawai -->
    <div class="modal fade" id="hapusPegawaiModal" tabindex="-1" aria-labelledby="hapusPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusPegawaiModalLabel">Hapus Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menghapus data Pegawai -->
                    <form id="formHapusPegawai" method="post" action="./process_admin/proses_hapus_pegawai.php">
                        <div class="mb-3">
                            <label for="id_pegawai_hapus" class="form-label">ID Pegawai:</label>
                            <input type="text" class="form-control" id="id_pegawai_hapus" name="id_pegawai_hapus" required>
                        </div>
                    </form>
                    <!-- Tombol untuk mengonfirmasi penghapusan -->
                    <button id="btnHapusPegawai" class="btn btn-danger">Konfirmasi Hapus Pegawai</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip SweetAlert -->
    <script>
        document.getElementById('btnHapusPegawai').addEventListener('click', function () {
            Swal.fire({
                title: 'Hapus Pegawai',
                text: 'Apakah Anda yakin ingin menghapus data Pegawai?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formHapusPegawai').submit();
                }
            });
        });
    </script>


    <!-- Modal Ubah Pegawai -->
    <div class="modal fade" id="ubahPegawaiModal" tabindex="-1" aria-labelledby="ubahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPegawaiModalLabel">Ubah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk mengubah data Pegawai -->
                    <form id="formUbahPegawai" method="post" action="./process_admin/proses_ubah_pegawai.php">
                        <div class="mb-3">
                            <label for="id_pegawai_ubah" class="form-label">Pilih ID Pegawai:</label>
                            <select class="form-select" id="id_pegawai_ubah" name="id_pegawai_ubah" required>
                                <!-- Ambil ID Pegawai dari database dan tampilkan sebagai pilihan -->
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "coffee_shop";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Koneksi gagal: " . $conn->connect_error);
                                }

                                $sql = "SELECT ID_Pegawai, Nama FROM Pegawai";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["ID_Pegawai"] . "'>" . $row["ID_Pegawai"] . " - " . $row["Nama"] . "</option>";
                                }

                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <!-- Tambahkan kolom untuk merubah nama -->
                        <div class="mb-3">
                            <label for="nama_ubah" class="form-label">Nama Baru:</label>
                            <input type="text" class="form-control" id="nama_ubah" name="nama_ubah" required>
                        </div>
                        <!-- Tambahkan kolom untuk merubah alamat -->
                        <div class="mb-3">
                            <label for="alamat_ubah" class="form-label">Alamat Baru:</label>
                            <textarea class="form-control" id="alamat_ubah" name="alamat_ubah"></textarea>
                        </div>
                        <!-- Tambahkan kolom untuk merubah nomor telepon -->
                        <div class="mb-3">
                            <label for="nomor_telepon_ubah" class="form-label">Nomor Telepon Baru:</label>
                            <input type="text" class="form-control" id="nomor_telepon_ubah" name="nomor_telepon_ubah">
                        </div>
                        <!-- Tambahkan kolom untuk merubah jenis kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin_ubah" class="form-label">Jenis Kelamin Baru:</label>
                            <select class="form-select" id="jenis_kelamin_ubah" name="jenis_kelamin_ubah">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!-- Tambahkan kolom untuk merubah nomor KTP -->
                        <div class="mb-3">
                            <label for="nomor_ktp_ubah" class="form-label">Nomor KTP Baru:</label>
                            <input type="text" class="form-control" id="nomor_ktp_ubah" name="nomor_ktp_ubah">
                        </div>
                        <!-- Tambahkan kolom untuk merubah gaji -->
                        <div class="mb-3">
                            <label for="gaji_ubah" class="form-label">Gaji Baru:</label>
                            <input type="text" class="form-control" id="gaji_ubah" name="gaji_ubah">
                        </div>
                        <button type="submit" class="btn btn-warning" id="btnUbahPegawai">Ubah Pegawai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
       $(document).ready(function () {
           $('form#formUbahPegawai').submit(function (e) {
           e.preventDefault(); // Menghentikan pengiriman formulir biasa

           // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
           $.ajax({
               type: $(this).attr('method'),
               url: $(this).attr('action'),
               data: $(this).serialize(),
               success: function (response) {
                   // Menampilkan SweetAlert ketika respons berhasil diterima
                   Swal.fire({
                       icon: 'success',
                       title: 'Sukses!',
                       text: 'Data Pegawai berhasil diubah',
                   }).then((result) => {
                       if (result.isConfirmed || result.isDismissed) {
                           window.location.href = 'dashboard_admin.php';
                       }
                   });
               },
               error: function (error) {
                   // Menampilkan pesan error jika terjadi kesalahan
                   console.log('Error:', error);
                   Swal.fire({
                       icon: 'error',
                       title: 'Oops...',
                       text: 'Terjadi kesalahan. Silakan coba lagi!',
                   });
               }
           });
       });
       });
   </script>

   <!-- Tampilkan Data Pelanggan -->
   <div class="container mt-3">
    <h3 class="display-6" style="color: orange;">Pela<span style="color: blue;">nggan</span></h3>
    <!-- Tampilkan tabel data Pelanggan -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "coffee_shop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query SQL untuk menampilkan data Pelanggan
    $sql = "SELECT * FROM Pelanggan";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>
        <thead>
        <tr>
        <th>ID Pelanggan</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Nomor Telepon</th>
        <th>Email</th>
        </tr>
        </thead>
        <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["ID_Pelanggan"] . "</td>
            <td>" . $row["Username"] . "</td>
            <td>" . $row["Password"] . "</td>
            <td>" . $row["Nama"] . "</td>
            <td>" . $row["Alamat"] . "</td>
            <td>" . $row["Nomor_Telepon"] . "</td>
            <td>" . $row["Email"] . "</td>
            </tr>";
        }

        echo "</tbody>
        </table>";
    } else {
        echo "Tabel belum terisi.";
    }

    $conn->close();
    ?>
</div>

<!-- Tombol Hapus Pelanggan -->
<div class="container mt-3">
    <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#hapusPelangganModal">Hapus Pelanggan</button>
</div>

<!-- Modal Hapus Pelanggan -->
<div class="modal fade" id="hapusPelangganModal" tabindex="-1" aria-labelledby="hapusPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusPelangganModalLabel">Hapus Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menghapus data Pelanggan -->
                <form id="formHapusPelanggan" method="post" action="./process_admin/proses_hapus_pelanggan.php">
                    <div class="mb-3">
                        <label for="id_pelanggan_hapus" class="form-label">ID Pelanggan:</label>
                        <input type="text" class="form-control" id="id_pelanggan_hapus" name="id_pelanggan_hapus" required>
                    </div>
                </form>
                <!-- Tombol untuk mengonfirmasi penghapusan -->
                <button id="btnHapusPelanggan" class="btn btn-danger">Konfirmasi Hapus Pelanggan</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan skrip SweetAlert -->
<script>
    document.getElementById('btnHapusPelanggan').addEventListener('click', function () {
        Swal.fire({
            title: 'Hapus Pelanggan',
            text: 'Apakah Anda yakin ingin menghapus data Pelanggan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formHapusPelanggan').submit();
            }
        });
    });
</script>

<!-- Tambahkan Tombol untuk Menambah Kategori Produk -->
<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">Tambah Kategori Produk</button>
</div>

<!-- Modal Tambah Kategori Produk -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data Kategori Produk -->
                <form id="formTambahKategori" method="post" action="./process_admin/proses_tambah_kategori.php">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Kategori Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('form#formTambahKategori').submit(function (e) {
            e.preventDefault(); // Menghentikan pengiriman formulir biasa

            // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Menampilkan SweetAlert ketika respons berhasil diterima
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data Kategori Produk berhasil ditambahkan',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = 'dashboard_admin.php';
                        }
                    });
                },
                error: function (error) {
                    // Menampilkan pesan error jika terjadi kesalahan
                    console.log('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi!',
                    });
                }
            });
        });
    });
</script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk menampilkan data Kategori_Produk
$sql = "SELECT * FROM Kategori_Produk";

$result = $conn->query($sql);

echo "<div class='container mt-3'>";
echo "<h3 class='display-6' style='color: orange;'>Kategori <span style='color: blue;'>Produk</span></h3>";

// Tampilkan tabel data Kategori_Produk
if ($result->num_rows > 0) {
    echo "<table class='table'>
    <thead>
    <tr>
    <th>ID Kategori</th>
    <th>Nama Kategori</th>
    </tr>
    </thead>
    <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["ID_Kategori"] . "</td>
        <td>" . $row["Nama_Kategori"] . "</td>
        </tr>";
    }

    echo "</tbody>
    </table>";
} else {
    echo "Tabel belum terisi.";
}

echo "</div>";

$conn->close();
?>

<!-- Tombol Hapus dan Ubah Kategori Produk -->
<div class="container mt-3">
    <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#hapusKategoriModal">Hapus Kategori Produk</button>
    <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#ubahKategoriModal">Ubah Kategori Produk</button>
</div>

<!-- Modal Hapus Kategori Produk -->
<div class="modal fade" id="hapusKategoriModal" tabindex="-1" aria-labelledby="hapusKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusKategoriModalLabel">Hapus Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menghapus data Kategori Produk -->
                <form id="formHapusKategori" method="post" action="./process_admin/proses_hapus_kategori.php">
                    <div class="mb-3">
                        <label for="id_kategori_hapus" class="form-label">ID Kategori:</label>
                        <input type="text" class="form-control" id="id_kategori_hapus" name="id_kategori_hapus" required>
                    </div>
                </form>
                <!-- Tombol untuk mengonfirmasi penghapusan -->
                <button id="btnHapusKategori" class="btn btn-danger">Konfirmasi Hapus Kategori</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan skrip SweetAlert -->
<script>
    document.getElementById('btnHapusKategori').addEventListener('click', function () {
        Swal.fire({
            title: 'Hapus Kategori Produk',
            text: 'Apakah Anda yakin ingin menghapus kategori produk?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formHapusKategori').submit();
            }
        });
    });
</script>

<!-- Modal Ubah Kategori Produk -->
<div class="modal fade" id="ubahKategoriModal" tabindex="-1" aria-labelledby="ubahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahKategoriModalLabel">Ubah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk mengubah data Kategori Produk -->
                <form id="formUbahKategori" method="post" action="./process_admin/proses_ubah_kategori.php">
                    <div class="mb-3">
                        <label for="id_kategori_ubah" class="form-label">Pilih ID Kategori:</label>
                        <select class="form-select" id="id_kategori_ubah" name="id_kategori_ubah" required>
                            <!-- Ambil ID Kategori dari database dan tampilkan sebagai pilihan -->
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "coffee_shop";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi gagal: " . $conn->connect_error);
                            }

                            $sql = "SELECT ID_Kategori, Nama_Kategori FROM Kategori_Produk";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ID_Kategori"] . "'>" . $row["ID_Kategori"] . " - " . $row["Nama_Kategori"] . "</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <!-- Tambahkan kolom untuk merubah nama kategori -->
                    <div class="mb-3">
                        <label for="nama_kategori_ubah" class="form-label">Nama Kategori Baru:</label>
                        <input type="text" class="form-control" id="nama_kategori_ubah" name="nama_kategori_ubah" required>
                    </div>
                    <button type="submit" class="btn btn-warning" id="btnUbahKategori">Ubah Kategori Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan skrip SweetAlert -->
<script>
    $(document).ready(function () {
        $('form#formUbahKategori').submit(function (e) {
            e.preventDefault(); // Menghentikan pengiriman formulir biasa

            // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Menampilkan SweetAlert ketika respons berhasil diterima
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data Kategori Produk berhasil diubah',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = 'dashboard_admin.php';
                        }
                    });
                },
                error: function (error) {
                    // Menampilkan pesan error jika terjadi kesalahan
                    console.log('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi!',
                    });
                }
            });
        });
    });
</script>


<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">Tambah Produk</button>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data Produk -->
                <form id="formTambahProduk" method="post" action="./process_admin/proses_tambah_produk.php">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk:</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok:</label>
                        <input type="text" class="form-control" id="stok" name="stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_produk" class="form-label">Kategori Produk:</label>
                        <select class="form-select" id="kategori_produk" name="kategori_produk" required>
                            <!-- Ambil data kategori produk dari database -->
                            <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi gagal: " . $conn->connect_error);
                            }

                            $sql = "SELECT ID_Kategori, Nama_Kategori FROM Kategori_Produk";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ID_Kategori"] . "'>" . $row["Nama_Kategori"] . "</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Menggunakan "click" event pada tombol Tambah Produk
        $('#formTambahProduk').submit(function (e) {
            e.preventDefault(); // Menghentikan pengiriman formulir biasa

            // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Menampilkan SweetAlert ketika respons berhasil diterima
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data Produk berhasil ditambahkan',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            // Menutup modal setelah menambah produk
                            $('#tambahProdukModal').modal('hide');
                            // Mengarahkan ke halaman dashboard_admin.php
                            window.location.href = 'dashboard_admin.php';
                        }
                    });
                },
                error: function (error) {
                    // Menampilkan pesan error jika terjadi kesalahan
                    console.log('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi!',
                    });
                }
            });
        });
    });
</script>


<!-- Tampilkan Data Produk -->
<div class="container mt-3">
    <h3 class="display-6" style="color: orange;">Data <span style="color: blue;">Produk</span></h3>
    <!-- Tampilkan tabel data Produk -->
    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query SQL untuk menampilkan data Produk dengan Nama Kategori
    $sql_produk = "SELECT Produk.ID_Produk, Produk.Nama_Produk, Produk.Harga, Produk.Stok, Kategori_Produk.Nama_Kategori
    FROM Produk
    JOIN Kategori_Produk ON Produk.ID_Kategori = Kategori_Produk.ID_Kategori";

    $result_produk = $conn->query($sql_produk);

    if ($result_produk->num_rows > 0) {
        echo "<table class='table'>
        <thead>
        <tr>
        <th>ID Produk</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Nama Kategori</th>
        </tr>
        </thead>
        <tbody>";

        while ($row_produk = $result_produk->fetch_assoc()) {
            echo "<tr>
            <td>" . $row_produk["ID_Produk"] . "</td>
            <td>" . $row_produk["Nama_Produk"] . "</td>
            <td>" . $row_produk["Harga"] . "</td>
            <td>" . $row_produk["Stok"] . "</td>
            <td>" . $row_produk["Nama_Kategori"] . "</td>
            </tr>";
        }

        echo "</tbody>
        </table>";
    } else {
        echo "Tabel Produk belum terisi.";
    }

    $conn->close();
    ?>
</div>

<!-- Tombol Hapus dan Ubah Produk -->
<div class="container mt-3">
    <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#hapusProdukModal">Hapus Produk</button>
    <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#ubahProdukModal">Ubah Produk</button>
</div>

<!-- Modal Hapus Produk -->
<div class="modal fade" id="hapusProdukModal" tabindex="-1" aria-labelledby="hapusProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusProdukModalLabel">Hapus Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menghapus data Produk -->
                <form id="formHapusProduk" method="post" action="./process_admin/proses_hapus_produk.php">
                    <div class="mb-3">
                        <label for="id_produk_hapus" class="form-label">ID Produk:</label>
                        <input type="text" class="form-control" id="id_produk_hapus" name="id_produk_hapus" required>
                    </div>
                </form>
                <!-- Tombol untuk mengonfirmasi penghapusan -->
                <button id="btnHapusProduk" class="btn btn-danger">Konfirmasi Hapus Produk</button>
            </div>
        </div>
    </div>
</div>


<!-- SweetAlert Script for Hapus Produk -->
<script>
    document.getElementById('btnHapusProduk').addEventListener('click', function () {
        Swal.fire({
            title: 'Hapus Produk',
            text: 'Apakah Anda yakin ingin menghapus produk?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formHapusProduk').submit();
            }
        });
    });
</script>

<!-- Modal Ubah Produk -->
<div class="modal fade" id="ubahProdukModal" tabindex="-1" aria-labelledby="ubahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahProdukModalLabel">Ubah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk mengubah data Produk -->
                <form id="formUbahProduk" method="post" action="./process_admin/proses_ubah_produk.php">
                    <div class="mb-3">
                        <label for="id_produk_ubah" class="form-label">Pilih ID Produk:</label>
                        <select class="form-select" id="id_produk_ubah" name="id_produk_ubah" required>
                            <!-- Ambil ID Produk dari database dan tampilkan sebagai pilihan -->
                            <?php
                            // Sambungkan ke database
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "coffee_shop";
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi gagal: " . $conn->connect_error);
                            }

                            $sql = "SELECT ID_Produk, Nama_Produk FROM Produk";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ID_Produk"] . "'>" . $row["ID_Produk"] . " - " . $row["Nama_Produk"] . "</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <!-- Tambahkan kolom untuk merubah nama produk -->
                    <div class="mb-3">
                        <label for="nama_produk_ubah" class="form-label">Nama Produk Baru:</label>
                        <input type="text" class="form-control" id="nama_produk_ubah" name="nama_produk_ubah" required>
                    </div>
                    <!-- Tambahkan kolom untuk merubah harga -->
                    <div class="mb-3">
                        <label for="harga_produk_ubah" class="form-label">Harga Baru:</label>
                        <input type="text" class="form-control" id="harga_produk_ubah" name="harga_produk_ubah" required>
                    </div>
                    <!-- Tambahkan kolom untuk merubah stok -->
                    <div class="mb-3">
                        <label for="stok_produk_ubah" class="form-label">Stok Baru:</label>
                        <input type="text" class="form-control" id="stok_produk_ubah" name="stok_produk_ubah" required>
                    </div>
                    <!-- Tambahkan kolom untuk memilih kategori baru -->
                    <div class="mb-3">
                        <label for="kategori_produk_ubah" class="form-label">Kategori Baru:</label>
                        <select class="form-select" id="kategori_produk_ubah" name="kategori_produk_ubah">
                            <!-- Ambil Nama Kategori dari database dan tampilkan sebagai pilihan -->
                            <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi gagal: " . $conn->connect_error);
                            }

                            $sql_kategori = "SELECT ID_Kategori, Nama_Kategori FROM Kategori_Produk";
                            $result_kategori = $conn->query($sql_kategori);

                            while ($row_kategori = $result_kategori->fetch_assoc()) {
                                echo "<option value='" . $row_kategori["ID_Kategori"] . "'>" . $row_kategori["Nama_Kategori"] . "</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning" id="btnUbahProduk">Ubah Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Script for Ubah Produk -->
<script>
    $(document).ready(function () {
        $('form#formUbahProduk').submit(function (e) {
            e.preventDefault(); // Menghentikan pengiriman formulir biasa

            // Menggunakan AJAX untuk mengirim formulir tanpa memuat ulang halaman
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Menampilkan SweetAlert ketika respons berhasil diterima
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data Produk berhasil diubah',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = 'dashboard_admin.php';
                        }
                    });
                },
                error: function (error) {
                    // Menampilkan pesan error jika terjadi kesalahan
                    console.log('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi!',
                    });
                }
            });
        });
    });
</script>





<!-- Copyrights -->
<footer class="bg-dark">
  <div class="bg-dark py-4">
    <div class="container text-center">
      <p class="text-muted mb-0 py-2">© 2023 One Piece - Arafil Azmi.</p>
      <!-- Instagram Icon -->
      <i class="fa-brands fa-instagram"></i>
      <!-- Facebook Icon -->
      <i class="fa-brands fa-facebook"></i>
      <!-- Email Icon -->
      <i class="fa-solid fa-envelope"></i>
      <!-- TikTok Icon -->
      <i class="fa-brands fa-tiktok"></i>
  </div>
</div>
</div>
</footer>
<!-- End -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://kit.fontawesome.com/c4e23af47a.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  AOS.init();
</script>
</body>
</html>
