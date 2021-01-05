<?php
session_start();
$pagename = "Profile";
require('../config.php');
require('../lib/cek_session.php');
$respon = " ";
if (isset($_POST['saveuser'])) {
  $pass1 = protek($_POST['new_pw']);
  $pass2 = protek($_POST['new_pw2']);
  if (empty($pass1) OR empty($pass2)) {
    $respon =  '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Mohon Mengisi Semua Input
    </div>';
  }else { 
    if ($pass1 == $pass2) {
      $passhash = password_hash($pass1, PASSWORD_DEFAULT);
      $changepw = mysqli_query($conn, "UPDATE user SET password='$passhash' ");
      if ($changepw == false) {
        $respon = '<div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
        </div>';
      }else {
        $respon = '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button><b>Sukses</b> Sukses Mengganti Password <br> New Password : {$pass1}
        </div>';
      }
  }else {
    $respon =  '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Mohon Masukan Password Yang Sama
    </div>';
  }
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
                    <h3 class="h6 text-uppercase mb-0">Profile Setting</h3>
                  </div>
                  <div class="card-body">
                 <?= $respon; ?>
                    <form method="post" action="">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Username</label>
                        <input type="text" disabled value="<?= $infouser['username']; ?>" name="username" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Nama</label>
                        <input type="text" placeholder="" disabled value="<?= $infouser['nama']; ?>" name="nama_user" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">New Password</label>
                        <input type="text" placeholder="" name="new_pw" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Confrim New Password</label>
                        <input type="text" placeholder="" name="new_pw2" class="form-control">
                      </div>
                      <div class="col-md-9 ml-auto">
                          <button type="submit" name="saveuser" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </section>
        </div>
       <?php
       include('../lib/footer.php');
       ?>