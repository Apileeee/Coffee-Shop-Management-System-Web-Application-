<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME BACK IN ONE PIECE</title>
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
                    <a class="nav-link" aria-current="page" href="#home">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#menu">Menu</a>
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

<!-- Banner -->
<div class="container-fluid banner" id="home">
    <div class="container text-center">
        <?php
            // Mengasumsikan Anda menyimpan username dalam variabel sesi setelah login berhasil
        session_start();
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo "<h4 class='display-6'>Selamat Datang Kembali, $username !</h4>";
        } else {
                // Jika username tidak diatur, tangani kasus tersebut secara sesuai
            echo "<h4 class='display-6'>Selamat Datang Kembali!</h4>";
        }
        ?>
        <h3>Mau minum apa hari ini ? </h3>
        <h3 class="display-1" style="color: orange;">One<span style="color: blue;"> Piece</span></h3>
        <a href="#menu">
            <button type="button" class="btn btn-danger btn-outline-light btn-lg">
                Menu
            </button>
        </a>
    </div>
</div>
<!-- Close Banner -->

<!-- Menu -->
<div class="bg-dark text-white service p-5" id="menu">
    <div class="container text-center">
      <div data-aos="fade-up"
      data-aos-anchor-placement="center-bottom">
      <h4 class="display-6" style="color: orange;">ME<span style="color: blue;">NU</span></h4>
      <p>
        Jelajahi berbagai layanan di One Piece Coffee Shop yang diciptakan untuk mewujudkan impian Anda!
    </p>
</div>
</div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
        <div data-aos="fade-right"
        data-aos-duration="1000">
        <div class="card h-100 bg-dark">
            <a href="categories1.php" style="text-decoration: none;">
              <img src="img/coffe.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" style="color: orange;">COF<span style="color: blue;">FEE</span></h5></a>
                <p class="card-text">Nikmati aroma dan rasa kopi terbaik dari biji kopi pilihan kami. Kartu ini membuka pintu menuju perjalanan yang menggembirakan dengan informasi pendukung di bawahnya, memberikan gambaran tentang dunia kopi premium kami.</p>
            </div>
        </div>
    </div>
</div>
<div class="col">
  <div data-aos="fade-down"
  data-aos-duration="2000">
  <div class="card h-100 bg-dark">
    <a href="categories2.php" style="text-decoration: none;">
        <img src="img/tea.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title" style="color: orange;">TE<span style="color: blue;">A</span></h5></a>
          <p class="card-text">Rasakan ketenangan dalam setiap teguk dengan pilihan teh kami yang istimewa. Kartu ini dengan elegan mempersembahkan berbagai teh, dengan teks pendukung di bawah sebagai transisi mulus untuk mengeksplorasi lebih lanjut tentang penawaran teh kami.</p>
      </div>
  </div>
</div>
</div>
<div class="col">
    <div data-aos="fade-right"
    data-aos-duration="1500">
    <div class="card h-100 bg-dark">
        <a href="categories3.php" style="text-decoration: none;">
          <img src="img/iced.jpg" class="card-img-top" alt="..." height="365px">
          <div class="card-body">
            <h5 class="card-title" style="color: orange;">ICED<span style="color: blue;"> BLENDED</span></h5></a>
            <p class="card-text">Rasakan perpaduan sempurna antara kesegaran dan kenikmatan dengan kreasi minuman berbahan dasar es krim kami. Kartu yang lebih lebar ini memberikan tampilan menggoda tentang minuman khusus kami, disertai informasi detail di bawahnya, memperlihatkan variasi dan keunggulan dalam setiap minuman.</p>
        </div>
    </div>
</div>
</div>
<div class="col">
  <div data-aos="fade-left"
  data-aos-duration="2000">
  <div class="card h-100 bg-dark">
    <a href="categories4.php" style="text-decoration: none;">
        <img src="img/frappe.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title" style="color: orange;">FRA<span style="color: blue;">PPE</span></h5>
      </a>
      <p class="card-text">Merambahlah ke dunia nikmat yang sejuk dengan pilihan frappe kami. Kartu yang lebih lebar, mirip dengan kategori ICED BLENDED, memperkenalkan berbagai frappe dengan teks pendukung di bawah, memastikan pemahaman menyeluruh tentang penawaran kami. Jelajahi konten yang luas untuk mengungkap pesona unik dari setiap frappe.</p>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
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
