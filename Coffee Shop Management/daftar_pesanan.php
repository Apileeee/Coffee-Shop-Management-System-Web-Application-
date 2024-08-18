<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAU PESAN APA ? | ONE PIECE</title>
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
            <a class="logo" href="dashboard_pelanggan.php" style="color: orange";>One<span style="color: blue;"> Piece</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item active mx-2">
                    <a class="nav-link" aria-current="page" href="dashboard_pelanggan.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="dashboard_pelanggan.php">Menu</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="order.php">Order</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="daftar_pesanan.php">Daftar Pesanan</a>
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

<!-- Tampilkan Data Pesanan -->
<div class="container mt-3">
    <h3 class="display-6" style="color: orange;">Daftar <span style="color: blue;">Pesanan</span></h3>

    <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "coffee_shop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Periksa apakah pelanggan sudah login
    if (isset($_SESSION["ID_Pelanggan"])) {
        $idPelanggan = $_SESSION["ID_Pelanggan"];

    // Query untuk mengambil data pesanan dari tabel Pesanan dan tabel terkait
        $query = "SELECT p.ID_Pesanan, pl.Nama AS Nama_Pelanggan, pr.Nama_Produk, p.Jumlah, pr.Harga, p.Alamat_Pengiriman, p.Tanggal_Pesanan, p.Status_Pesanan, t.Total_Harga
        FROM Pesanan p
        JOIN Transaksi t ON p.ID_Pesanan = t.ID_Transaksi
        JOIN Pelanggan pl ON p.ID_Pelanggan = pl.ID_Pelanggan
        JOIN Produk pr ON p.ID_Produk = pr.ID_Produk
        WHERE p.ID_Pelanggan = $idPelanggan";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table'>
            <thead>
            <tr>
            <th>ID Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Alamat Pengiriman</th>
            <th>Tanggal Pesanan</th>
            <th>Status Pesanan</th>
            <th>Total Harga</th>
            </tr>
            </thead>
            <tbody>";

            while ($row = $result->fetch_assoc()) {
            // Hitung total harga (Jumlah * Harga) untuk setiap baris pesanan
                $totalHarga = $row["Total_Harga"];

                echo "<tr>
                <td>" . $row["ID_Pesanan"] . "</td>
                <td>" . $row["Nama_Pelanggan"] . "</td>
                <td>" . $row["Nama_Produk"] . "</td>
                <td>" . $row["Jumlah"] . "</td>
                <td>" . $row["Harga"] . "</td>
                <td>" . $row["Alamat_Pengiriman"] . "</td>
                <td>" . $row["Tanggal_Pesanan"] . "</td>
                <td>" . $row["Status_Pesanan"] . "</td>
            <td>" . $totalHarga . "</td>";

            echo "</tr>";
        }

        echo "</tbody>
        </table>";
    } else {
        echo "Belum ada pesanan.";
    }
} else {
    echo "Pelanggan belum login.";
}


$conn->close();
?>
</div>

<!-- Tombol di luar tabel untuk membayar dan membatalkan -->
<div class="container mt-3" style="padding: 20px">
    <button class="btn btn-success btn-bayar-terpilih" id="btnBayarPesanan">Bayar Pesanan</button>
    <button class="btn btn-danger btn-batalkan-terpilih" id="btnBatalkanPesanan">Batalkan Pesanan</button>
</div>

<!-- Modal Bayar Pesanan -->
<div class="modal fade" id="bayarPesananModal" tabindex="-1" aria-labelledby="bayarPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarPesananModalLabel">Bayar Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk pembayaran -->
                <form id="formBayarPesanan" method="post" action="./proses_pembelian.php">
                    <div class="mb-3">
                        <label for="id_pesanan_bayar" class="form-label">ID Pesanan:</label>
                        <input type="text" class="form-control" id="id_pesanan_bayar" name="id_pesanan_bayar" required>
                    </div>
                    <button type="submit" class="btn btn-success" id="btnKonfirmasiBayar">Konfirmasi Bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Batalkan Pesanan -->
<div class="modal fade" id="batalkanPesananModal" tabindex="-1" aria-labelledby="batalkanPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batalkanPesananModalLabel">Batalkan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk pembatalan pesanan -->
                <form id="formBatalkanPesanan" method="post" action="./proses_pembatalan.php">
                    <div class="mb-3">
                        <label for="id_pesanan_batalkan" class="form-label">ID Pesanan:</label>
                        <input type="text" class="form-control" id="id_pesanan_batalkan" name="id_pesanan_batalkan" required>
                    </div>
                    <button type="submit" class="btn btn-danger" id="btnKonfirmasiBatal">Konfirmasi Batalkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan skrip SweetAlert untuk Bayar Pesanan -->
<script>
    document.getElementById('btnBayarPesanan').addEventListener('click', function () {
        Swal.fire({
            title: 'Bayar Pesanan',
            text: 'Masukkan ID Pesanan:',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Bayar',
            cancelButtonText: 'Batal',
            preConfirm: (idPesanan) => {
                if (!idPesanan) {
                    Swal.showValidationMessage('ID Pesanan harus diisi');
                }
                return { idPesanan: idPesanan };
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('id_pesanan_bayar').value = result.value.idPesanan;
                $('#bayarPesananModal').modal('show');
            }
        });
    });
</script>

<!-- Tambahkan skrip SweetAlert untuk Batalkan Pesanan -->
<script>
    document.getElementById('btnBatalkanPesanan').addEventListener('click', function () {
        Swal.fire({
            title: 'Batalkan Pesanan',
            text: 'Masukkan ID Pesanan:',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Batalkan',
            cancelButtonText: 'Batal',
            preConfirm: (idPesanan) => {
                if (!idPesanan) {
                    Swal.showValidationMessage('ID Pesanan harus diisi');
                }
                return { idPesanan: idPesanan };
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('id_pesanan_batalkan').value = result.value.idPesanan;
                $('#batalkanPesananModal').modal('show');
            }
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
