<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORI TEA | ONE PIECE</title>
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
                                window.location.replace('./home/index.html');

                            // Nonaktifkan tombol "kembali" di browser
                                window.history.pushState(null, null, './home/index.html');
                                window.addEventListener('popstate', function () {
                                    window.location.replace('./home/index.html');
                                });
                            }
                        });
                    }
                </script>

            </ul>
        </div>
    </div>
</nav>
<!-- Close Navbar -->

<!-- Menu -->
<section class="bg-dark text-white service p-5" id="menu">
    <div class="container text-center">
      <div data-aos="fade-up"
      data-aos-anchor-placement="center-bottom">
      <h4 class="display-6" style="color: orange;">TE<span style="color: blue;">A</span></h4>
      <p>
          Rasakan ketenangan dalam setiap teguk dengan pilihan teh kami yang istimewa !
      </p>
  </div>
</div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
        <div data-aos="fade-right"
        data-aos-duration="1000">
        <div class="card h-20 bg-dark">
          <img src="img/com.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="color: orange;">KOM<span style="color: blue;">BUCHA</h5>
                <p class="card-text">Rp 20.000</p>
            </div>
        </div>
    </div>
</div>
<div class="col">
  <div data-aos="fade-left"
  data-aos-duration="2000">
  <div class="card h-20 bg-dark">
    <img src="img/icedtea.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title" style="color: orange;">ICED<span style="color: blue;"> TEA</h5>
          <p class="card-text">Rp 20.000</p>
      </div>
  </div>
</div>
</div>
<div class="col">
    <div data-aos="fade-right"
    data-aos-duration="1500">
    <div class="card h-20 bg-dark">
        <img src="img/lemon.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title" style="color: orange;">LEMON<span style="color: blue;"> TEA</h5>
                <p class="card-text">Rp 17.000</p>
            </div>
        </div>
    </div>
</div>
<div class="col">
  <div data-aos="fade-left"
  data-aos-duration="1000">
  <div class="card h-20 bg-dark">
    <img src="img/hot.jpg" class="card-img-top" alt="..." height="310">
    <div class="card-body">
      <h5 class="card-title" style="color: orange;">HOT<span style="color: blue;"> TEA</h5>
          <p class="card-text">Rp 25.000</p>
      </div>
  </div>
</div>
</div>
</div>
</div>
</section>
<!-- Close Menu --> 

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
