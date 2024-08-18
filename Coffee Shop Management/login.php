<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | ONE PIECE</title>
    <link rel="icon" type="image/png" href="./img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./home/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark sticky-top">
        <div class="container">
            <a class="logo" href="./home/index.html" style="color: orange";>One<span style="color: blue;"> Piece</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item active mx-2">
                    <a class="nav-link" aria-current="page" href="./home/index.html">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="signup.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Close Navbar -->

<div class="container-fluid banner">
    <div class="container text-center">
        <h2 class="fw-bold mb-2 text-uppercase" style="color: orange;">Log<span style="color:blue;">in</span></h2>
        <p class="text-white-50 mb-5">Please enter your login and password!</p>

        <form action="process_login.php" method="post">
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control form-control-lg" autocomplete="username" />
            </div>

            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" autocomplete="current-password" />
            </div>

            <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            <div class="d-flex justify-content-center text-center mt-4 pt-1">
            </div>

        </form>

        <script>
            $(document).ready(function () {
                $('form').submit(function (e) {
                    e.preventDefault();
                    var form = $(this);

                    $.post(form.attr('action'), form.serialize(), function (response) {
                        if (response.success) {
                            if (response.role === 'admin') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Berhasil!',
                                    text: 'Anda berhasil login sebagai admin.'
                                }).then(function () {
                                    window.location.href = 'dashboard_admin.php';
                                });
                            } else if (response.role === 'pelanggan') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Berhasil!',
                                    text: 'Anda berhasil login sebagai pelanggan.'
                                }).then(function () {
                                    window.location.href = 'dashboard_pelanggan.php';
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Login',
                                text: 'Username atau password salah. Silakan coba lagi.'
                            });
                        }
                    }, 'json');
                });
            });
        </script>


    </div>

    <div>
      <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
      </p>
  </div>
</div>
</div>
</body>
</html>
