<?php

if ($_SESSION["login"] != true) {
    header("Location: index.php");
}
?>

<body>
    <div class="container">
        <!--Form Input Data-->

        <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, "SELECT * FROM dokter 
                    WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $alamat = $row['alamat'];
                    $no_hp = $row['no_hp'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="row">
                <label for="inputNama" class="form-label fw-bold">
                    Nama
                </label>
                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama ?>">
            </div>
            <div class="row mt-1">
                <label for="inputAlamat" class="form-label fw-bold">
                    Alamat
                </label>
                <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
            </div>
            <div class="row mt-1">
                <label for="inputNoHp" class="form-label fw-bold">
                    Nomor HP
                </label>
                <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="Nomor HP" value="<?php echo $no_hp ?>">
            </div>
            <!-- menurunkan posisi submit -->
            <div class="row mt-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary rounded-pill px-3 mt-auto" name="simpan">Simpan</button>
                </div>
            </div>
        </form>
        <br>
        <br>
        <!-- Table-->
        <table class="table table-hover">
            <!--thead atau baris judul-->
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
            <tbody>
                <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM dokter");
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['alamat'] ?></td>
                        <td><?php echo $data['no_hp'] ?></td>
                        <td>
                            <a class="btn btn-success rounded-pill px-3" href="index2.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah</a>
                            <a class="btn btn-danger rounded-pill px-3" href="index2.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id'])) {
                $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                                    nama = '" . $_POST['nama'] . "',
                                                    alamat = '" . $_POST['alamat'] . "',
                                                    no_hp = '" . $_POST['no_hp'] . "'
                                                    WHERE
                                                    id = '" . $_POST['id'] . "'");
            } else {
                $tambah = mysqli_query($mysqli, "INSERT INTO dokter(nama,alamat,no_hp) 
                                                    VALUES ( 
                                                        '" . $_POST['nama'] . "',
                                                        '" . $_POST['alamat'] . "',
                                                        '" . $_POST['no_hp'] . "'
                                                        )");
            }
            echo "<script> 
                        document.location='index2.php?page=dokter';
                        </script>";
        }
        if (isset($_GET['aksi'])) {
            if ($_GET['aksi'] == 'hapus') {
                $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
            } else if ($_GET['aksi'] == 'ubah_status') {
                $ubah_status = mysqli_query($mysqli, "UPDATE kegiatan SET 
                                                    status = '" . $_GET['status'] . "' 
                                                    WHERE
                                                    id = '" . $_GET['id'] . "'");
            }
            echo "<script> 
                        document.location='index2.php?page=dokter';
                        </script>";
        }
        ?>

</body>