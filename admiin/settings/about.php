<?php
session_start();
$pagename = "About";
require('../config.php');
require('../lib/cek_session.php');

$qry = mysqli_query($conn, "SELECT * FROM about");
$tampilAbout = mysqli_fetch_assoc($qry);
$respon = " ";
if (isset($_POST['save_about'])) {
  $nama = protek($_POST['nama_about']);
  $profesi = protek($_POST['profesi_about']);
  $tentang = mysqli_escape_string($conn,$_POST['tentang_about']);
  
  $save = mysqli_query($conn, "UPDATE `about` SET `nama`='$nama',`profesi`='$profesi',`tentang`='$tentang' ");
  if ($save == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    header("Location: about");
  }


}
include('../lib/header.php');
?>
     
        <div class="container-fluid px-xl-5">
          <section class="py-5"> 
          <div class="row">
             <!-- Basic Form-->
             <div class="col-lg-12 mb-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="h6 text-uppercase mb-0">tentang saya</h3>
                  </div>
                  <div class="card-body">
                  <?= $respon ?>
                    <form action="" method="post">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Nama</label>
                        <input type="text" placeholder="" value="<?= $tampilAbout['nama']; ?>" name="nama_about" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Profesi</label>
                        <input type="text" placeholder="" value="<?= $tampilAbout['profesi']; ?>" name="profesi_about" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Deskripsi Website</label>
                        <textarea name="tentang_about" id="" cols="30" rows="4" class="ckeditor"><?= $tampilAbout['tentang'] ?></textarea>
                      </div>
                      <div class="col-md-9 ml-auto">
                          <button type="submit" name="save_about" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </section>
        </div>
        <script src="../../ckeditor/ckeditor.js"></script>
       <?php
       include('../lib/footer.php');
       ?>