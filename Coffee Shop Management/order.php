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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER | ONE PIECE</title>
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

<div class="container mt-4" style="padding: 100px;">
    <h2 style="color: orange;">Formulir <span style="color:blue;"> Pemesanan</span></h2>
    <form id="orderForm" action="proses_order.php" method="post">
        <!-- Pilihan Produk -->
        <div class="mb-3">
            <label for="product">Produk:</label>
            <input type="hidden" name="id_pelanggan" value="<?php echo $idPelanggan; ?>">
            <select class="form-select" name="product" id="product" required>
                <?php
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

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["ID_Produk"] . "'>" . $row["Nama_Produk"] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select>
        </div>
        <!-- Kolom Formulir Lainnya -->
        <div class="mb-3">
            <label for="jumlah">Jumlah:</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="alamat_pengiriman">Alamat Pengiriman:</label>
            <textarea class="form-control" name="alamat_pengiriman" id="alamat_pengiriman" required></textarea>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select class="form-select" name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="BRI">BRI</option>
                <option value="BNI">BNI</option>
                <option value="DANA">DANA</option>
                <option value="MANDIRI">MANDIRI</option>
                <option value="BCA">BCA</option>
                <option value="OVO">OVO</option>
                <option value="GOPAY">GOPAY</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('form#orderForm').submit(function (e) {
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
                        text: 'Pesanan berhasil disimpan!',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            // Redirect ke halaman daftar_pesanan.php atau sesuai kebutuhan
                            window.location.replace('daftar_pesanan.php');
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
