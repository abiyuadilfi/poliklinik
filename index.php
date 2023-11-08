<?php
session_start();

// Koneksi ke database
$db = new mysqli('localhost', 'root', '', 'poliklinik');

// Periksa koneksi
if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna di tabel admin
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login berhasil, simpan informasi pengguna dalam sesi
            $_SESSION["username"] = $username;
            $_SESSION["nama"] = $row['nama'];
            $_SESSION["login"] = true;

            // Redirect ke halaman index2.php
            header("Location: index2.php");
            exit();
        } else {
            $error_message = "Password salah. Coba lagi.";
        }
    } else {
        $error_message = "Username tidak ditemukan.";
    }
}

// Tutup koneksi database
$db->close();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <!-- Section: Design Block -->
        <section class="text-center">
            <!-- Background image -->
            <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
            <!-- Background image -->

            <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
                <div class="card-body py-5 px-md-5">

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-5">LOGIN</h2>
                            <form method="post" action="">
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example4" class="form-control" name="username" />
                                    <label class="form-label" for="form3Example4">Username</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4" class="form-control" name="password" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                </div>

                                <?php if (isset($error_message)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error_message; ?>
                                    </div>
                                <?php } ?>


                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Masuk
                                </button>


                            </form>
                            <a href="register.html" class="btn btn-primary">
                                Daftar</a>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>
</body>

</html>