<?php
session_start();
$pagename = "Setting";
require('../config.php');
require('../lib/cek_session.php');
$qry = mysqli_query($conn,"SELECT * FROM website_setting ");
$infoWeb = mysqli_fetch_assoc($qry);
$respon = " ";
if (isset($_POST['save_web'])) {
    $diizinkan = ['jpg', 'png', 'jpeg'];
    $title = protek($_POST['title_web']);
    $save = mysqli_query($conn, "UPDATE website_setting SET title_web='$title' ");
    if ($save == false) {
      $respon = '<div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
      </div>';
    }else {
      header("Location: website");
    }

  if (isset($_FILES['icon_web'])) {
    $temp_icon = $_FILES['icon_web']['tmp_name'];
    $name_icon = $_FILES['icon_web']['name'];
    $ex = explode('.',$name_icon);
    $eks_icon = strtolower(end($ex));
    $name_icon = rand(0,99).$name_icon;
   
    if (in_array($eks_icon, $diizinkan, true)) {
      mysqli_query($conn, "UPDATE website_setting SET icon_web='$name_icon' ");
      move_uploaded_file($temp_icon, '../../img/'.$name_icon);
    }

  }
  if (isset($_FILES['bg_home'])) {
    $temp_bg = $_FILES['bg_home']['tmp_name'];
    $name_bg = $_FILES['bg_home']['name'];
    $eX = explode('.',$name_bg);
    $eks_bg = strtolower(end($eX));
    $name_bg = rand(0,99).$name_bg;
    
    if (in_array($eks_bg, $diizinkan, true)) {
      mysqli_query($conn, "UPDATE website_setting SET bg_home='$name_bg' ");
      move_uploaded_file($temp_bg, '../../img/'.$name_bg);
    }

  }


  header("Location: website");


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
                    <h3 class="h6 text-uppercase mb-0">Pengaturan Website</h3>
                  </div>
                  <div class="card-body">
                 <?= $respon ?>
                    <form action="" method="POST" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Title Website</label>
                        <input type="text" placeholder="" value="<?= $infoWeb['title_web']; ?>" name="title_web" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Icon Website</label><br>
                        <img src="<?= $base_url."img/".$infoWeb['icon_web']; ?>" width="70" style="margin: 0 0 10px 12px;" alt="">
                        <input type="file" placeholder="" value="" name="icon_web" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">background home Website</label><br>
                        <img src="<?= $base_url."img/".$infoWeb['bg_home']; ?>" width="80"   style="margin: 0 0 10px 12px;"  alt="">
                        <input type="file" placeholder="" value="" name="bg_home" class="form-control">
                      </div>
                      <div class="col-md-9 ml-auto">
                          <button type="submit" name="save_web" class="btn btn-primary">Save changes</button>
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