<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP | ONE PIECE</title>
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
            <a class="logo" href="./home/index.html" style="color: orange;">One<span style="color: blue;"> Piece</span></a>
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
            <h2 class="fw-bold mb-2 text-uppercase" style="color: orange;">Sign<span style="color:blue;"> Up</span></h2>
            <p class="text-white-50 mb-5">Enter your data to Sign Up !</p>

            <form id="signupForm" action="process_signup.php" method="post">
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="username">Username</label>
                    <input id="username" name="username" type="text" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="address">Address</label>
                    <input id="address" name="address" type="text" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="cellphone">Cellphone</label>
                    <input id="cellphone" name="cellphone" type="tel" class="form-control form-control-lg" />
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>
                <div class="d-flex justify-content-center text-center mt-4 pt-1"></div>
            </form>

            
            <script>
                $(document).ready(function () {
                    $('#signupForm').submit(function (e) {
                        e.preventDefault();
                        var form = $(this);

                        // Pemeriksaan apakah semua input tidak kosong
                        var allInputsFilled = true;
                        form.find('input').each(function () {
                            if ($(this).val() === '') {
                                allInputsFilled = false;
                    return false; // Hentikan iterasi jika ada input yang kosong
                }
            });

                        if (!allInputsFilled) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Mendaftar',
                                text: 'Harap isi semua kolom data.'
                            });
                            return;
                        }

                        $.post(form.attr('action'), form.serialize(), function (response) {
                            // Parse respon JSON
                            var jsonResponse = JSON.parse(response);

                            if (jsonResponse.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pendaftaran Berhasil!',
                                    text: 'Anda berhasil terdaftar sebagai pelanggan.'
                                }).then(function () {
                                    window.location.href = 'login.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Mendaftar',
                                    text: 'Anda gagal terdaftar sebagai pelanggan. Error: ' + jsonResponse.error
                                });
                            }
                        });
                    });
                });
            </script>

            <div>
                <p class="mb-5">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>
