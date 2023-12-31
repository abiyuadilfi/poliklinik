<?php
session_start();
include_once("koneksi.php");

if ($_SESSION["login"] != true) {
  header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        Sistem Informasi Poliklinik
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto"> <!-- Menu utama di sebelah kiri -->
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">
              Home
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data Master
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="index2.php?page=dokter">
                  Dokter
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="index2.php?page=pasien">
                  Pasien
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index2.php?page=periksa">
              Periksa
            </a>
          </li>
        </ul>

        <ul class="navbar-nav"> <!-- Menu Logout di sebelah kanan -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              Logout
            </a>
          </li>
        </ul>
      </div>



    </div>
  </nav>
  <main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
    ?>
      <h2><?php echo ucwords($_GET['page']) ?></h2>
    <?php
      include($_GET['page'] . ".php");
    } else {
      echo "Selamat Datang di Sistem Informasi Poliklinik";
    }
    ?>
  </main>
</body>

</html>