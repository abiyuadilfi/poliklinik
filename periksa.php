<body>
    <div class = "container">   
        <!--Form Input Data-->

        <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
                $tgl_periksa = '';
                $catatan = '';
                if (isset($_GET['id'])) {
                    $ambil = mysqli_query($mysqli, "SELECT * FROM periksa 
                    WHERE id='" . $_GET['id'] . "'");
                    while ($row = mysqli_fetch_array($ambil)) {
                        $tgl_periksa = $row['tgl_periksa'];
                        $catatan = $row['catatan'];
                        $id_pasien = $row['id_pasien'];
                        $id_dokter = $row['id_dokter'];

                    }
                ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <?php
                }
            ?>
            <!-- data pasien -->
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPasien" class="sr-only">Pasien</label>
                <select class="form-control" name="id_pasien">
                    <?php
                    $selected = '';
                    $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
                    while ($data = mysqli_fetch_array($pasien)) {
                        if ($data['id'] == $id_pasien) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        }
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <!-- data dokter -->
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputdokter" class="sr-only">dokter</label>
                <select class="form-control" name="id_dokter">
                    <?php
                    $selected = '';
                    $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
                    while ($data = mysqli_fetch_array($dokter)) {
                        if ($data['id'] == $id_dokter) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        }
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="tgl_periksa" class="form-label fw-bold">
                    tgl_periksa
                </label>
                <input type="datetime-local" class="form-control" name="tgl_periksa" id="tgl_periksa" placeholder="tgl_periksa" value="<?php echo $tgl_periksa ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="catatan" class="form-label fw-bold">
                    catatan
                </label>
                <input type="text" class="form-control" name="catatan" id="catatan" placeholder="catatan" value="<?php echo $catatan ?>">
            </div>
            
            <!-- menurunkan posisi submit -->
            <div class="row mt-3">
                <div class = "col">
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
                    <th scope="col">pasien</th>
                    <th scope="col">dokter</th>
                    <th scope="col">tgl_periksa</th>
                    <th scope="col">catatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
            <tbody>
                <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
                berdasarkan status dan tanggal awal-->
                <?php
                    $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['nama_pasien'] ?></td>
                            <td><?php echo $data['nama_dokter'] ?></td>
                            <td><?php echo $data['tgl_periksa'] ?></td>
                            <td><?php echo $data['catatan'] ?></td>
                            <td>
                                <a class="btn btn-success rounded-pill px-3" 
                                href="index.php?page=periksa&id=<?php echo $data['id'] ?>">
                                Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" 
                                href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">
                                Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- logi simpan ubah deleted -->
        <?php
                if (isset($_POST['simpan'])) {
                    if (isset($_POST['id'])) {
                        $ubah = mysqli_query($mysqli, "UPDATE periksa SET 
                                                        id_pasien = '" . $_POST['id_pasien'] . "',
                                                        id_dokter = '" . $_POST['id_dokter'] . "',
                                                        tgl_periksa = '" . $_POST['tgl_periksa'] . "',
                                                        catatan = '" . $_POST['catatan'] . "'
                                                        WHERE
                                                        id = '" . $_POST['id'] . "'");
                    } else {
                        $tambah = mysqli_query($mysqli, "INSERT INTO periksa(id_pasien,id_dokter,tgl_periksa,catatan) 
                                                        VALUES ( 
                                                            '" . $_POST['id_pasien'] . "',
                                                            '" . $_POST['id_dokter'] . "',
                                                            '" . $_POST['tgl_periksa'] . "',
                                                            '" . $_POST['catatan'] . "'
                                                            )");
                    }

                    echo "<script> 
                            document.location='index.php?page=periksa';
                            </script>";
                }

                if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
                    } 
                    echo "<script> 
                            document.location='index.php?page=periksa';
                            </script>";
                }
        ?>
</body>
</html>