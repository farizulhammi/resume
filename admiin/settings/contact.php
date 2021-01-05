<?php
session_start();
$pagename = "Contact";
require('../config.php');
require('../lib/cek_session.php');
$qry = mysqli_query($conn, "SELECT * FROM contact");
$tampilContact = mysqli_fetch_assoc($qry);
$respon = " ";
if (isset($_POST['save_contact'])) {
  $lokasi = protek($_POST['lokasi']);
  $website = protek($_POST['website']);
  $phone = protek($_POST['phone']);
  $email = protek($_POST['email']);
  $save = mysqli_query($conn, "UPDATE `contact` SET `location`='$lokasi',`phone`='$phone',`website`='$website',`email`='$email' ");
  if ($save == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    header("Location: contact");
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
                    <h3 class="h6 text-uppercase mb-0">Kontak</h3>
                  </div>
                  <div class="card-body">
                  <?= $respon ?>
                    <form action="" method="post">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Lokasi</label>
                        <input type="text" placeholder="" value="<?= $tampilContact['location']; ?>" name="lokasi" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Phone</label>
                        <input type="number" placeholder="" value="<?= $tampilContact['phone']; ?>" name="phone" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Website</label>
                        <input type="text" placeholder="" value="<?= $tampilContact['website']; ?>" name="website" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Email</label>
                        <input type="email" placeholder="" value="<?= $tampilContact['email']; ?>" name="email" class="form-control">
                      </div>
                      <div class="col-md-9 ml-auto">
                          <button type="submit" name="save_contact" class="btn btn-primary">Save changes</button>
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