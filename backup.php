<?php
include_once("koneksi.php");
?>

<form class="row" method="POST" action="" name="myForm">
<?php
$isi = '';
$tgl_awal = '';
$tgl_akhir = '',
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM kegiatan WHERE id='" . $_GET['id'] . '"' );
    while ($row = mysqli_fetch_array($ambil)) {
        $isi = $row['isi'];
        $tgl_awal = $row['tgl_awal'];
        $tgl_akhir = $row['tgl_akhir'];
    }
?>
<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
<?php
}
?>
<div class="row">
<div class="col">
    <label for="inputIsi" class="visually-hidden">Kegiatan</label>
    <input type="text" class="form-control" name="isi" placeholder="Kegiatan" value="<?php echo $isi ?>">
</div>
<div class="col">
    <label for="inputTanggalAwal" class="visually-hidden">awal </label>
    <input type="text" class="form-control" name="tgl_awal" placeholder="Tanggal Awal" value="<?php echo $tgl_awal ?>">
</div>
<div class="col">
    <label for="inputTanggalAkhir" class="visually-hidden">akhir </label>
    <input type="text" class="form-control" name="tgl_akhir" placeholder="Tanggal Akir" value="<?php echo $tgl_akhir ?>">
</div>
<div class="col">
    <button type="submit" class="btn btn-primary  rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</div> 
</form>  

<tbody>
    <?php
    $result =mysqli_query($mysqli, "SELECT * FROM kegiatan ORDER BY STATUS,tgl_awal");
    $no = 1;
    while ($data = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <th scope="row"><?php echo $no++ ?></th>
            <td><?php echo $data['isi']  ?></td>
            <td><?php echo $data['tgl_awal']  ?></td>
            <td><?php echo $data['tgl_akhir']  ?></td>

            <td> 
                <?php
                if ($data['status'] == '1') {
                    ?>
                    <a class="btn btn-success rounded-pill px-3" type="button" href="index.php?id=<?php echo $data['id']?>&aksi=ubah_status&status=0">Sudah</a>
                    <?php
                } else {
                    ?>
                    <a class="btn btn-warning rounded-pill px-3" type="button" href="index.php?id=<?php echo $data['id']?>&aksi=ubah_status&status=0">Belum</a>
                    <?php
                }
                ?>
                </td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $data['id']?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id<?php echo $data['id']?>&aksi=hapus">Hapus</a>
            <?php
    }
    ?>        
      <?php 
      if (isset($_POST['simpan'])) {
          if (isset($_POST['id'])) {
              $ubah = mysqli_query($mysqli, "UPDATE kegiatan SET
                                             isi = '" . $_POST['isi'] . "',
                                             tgl_awal = '" . $_POST['tgl_awal'] . "',
                                             tgl_akhir = '" . $_POST['tgl_akhir'] . "'
                                             WHERE
                                             id = '" . $_POST['id'] . "'");
          } else {
              $tambah = mysqli_query($mysqli, "INSERT INTO kegiatan(isi,tgl_awal,tgl_akhir,status)
                                              VALUES (
                                                  '" . $_POST['isi'] . "',
                                                  '" . $_POST['tgl_awal'] . "',
                                                  '" . $_POST['tgl_akhir'] . "',
                                                  '0'
                                                  )");
          }                                         
 
           echo "<script>
                 document.location='index.php';
                 </script>";

        }

        if (isset($_GET['aksi'])) {   
            if (isset($_GET['aksi'] == 'hapus') {
                $hapus = mysqli_query($mysqli, "DELETE FROM kegiatan WHERE id = '" . $_GET['id'] . "'");
            } else if ($_GET['aksi'] == 'ubah_status') {
                $ubah_status = mysqli_query($mysqli, "UPDATE kegiatan SET
                status = '" . $_GET['status'] . "'
                WHERE
                id = '" . $_GET['id'] . "'");

            }                                     
             echo "<script>
             document.location='index.php';
             </script>";

        }
?>

<script type="text/javascript">
    function validate() {
    if (document.myForm.isi.value == "") {
        allert("silahkan lengkapi bagian isi!");
        document.myForm.isi.focus();
        return false;
    } else if (document.myForm.tgl_awal.value == "") {
        allert("silahkan lengkapi bagian Tanggal Awal!");
        document.myForm.tgl_awal.focus();
        return false;
    } else if (document.myForm.tgl_akhir.value == "") {
        allert("silahkan lengkapi bagian Tanggal Akhir!");
        document.myForm.tgl_akhir.focus();
        return false;
    } else {
        return true;
    }
    }
</script>























</script>
              

    

     
