<?php
require('admiin/config.php');
$ip = get_ip();
$cekip = mysqli_num_rows(mysqli_query($conn, "SELECT visitor_id FROM visitor WHERE visitor_ip='$ip'"));
if ($cekip == 0) {
  mysqli_query($conn, "INSERT INTO visitor VALUES ('','$ip','$ymd $his') ");
}
if (isset($_POST['kirim_pesan'])) {
  $nama = protek($_POST['nama']);
  $mail = protek($_POST['mail']);
  $pesan = protek($_POST['pesan']);
  mysqli_query($conn, "INSERT INTO pesan VALUES ('','$nama','$mail','$pesan','$ymd $his','no') ");
  // if (empty($nama) OR empty($mail) OR empty($pesan)) {
  //   # code...
  // }
}
$tampilContact = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM contact "));

$infoWeb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM website_setting "));
$tampilAbout = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about "));
$tampilSkill = mysqli_query($conn,"SELECT * FROM skill ");
$tampilEdu = mysqli_query($conn,"SELECT * FROM education ORDER BY edu_id DESC ");
$tampilExpe = mysqli_query($conn,"SELECT * FROM experience ORDER BY experience_id DESC ");
$tampilSosmed = mysqli_query($conn,"SELECT * FROM sosmed");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $infoWeb['title_web']; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?= $base_url."img/".$infoWeb['icon_web']; ?>">
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container"><a class="navbar-brand" href="#"><img src="<?= $base_url."img/".$infoWeb['icon_web']; ?>" alt="" width="45"></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link link-scroll active" href="#home">Home <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#about">About</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#expertise">Expertise</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#education">Education</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#experience">Experience</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#contact">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
<!-- Modal-->
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="exampleModalLabel" class="modal-title">Send Massage</h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <form method="post" action="">
            <div class="form-group">
              <label>Nama</label>
              <input type="txt" name="nama" placeholder="Your Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="mail" placeholder="Email Address" class="form-control" required>
            </div> 
            <div class="form-group">
              <label>Pesan</label>
              <textarea class="form-control" placeholder="Your Massage" name="pesan" cols="30" rows="5" required></textarea>
            </div>
            <div class="form-group">       
              <input type="submit" name="kirim_pesan" value="Send" class="btn btn-primary">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal end -->

    <!-- Hero Section-->
    <section class="hero bg-cover bg-center mt-5" id="home" style="background: url(<?= $base_url."img/".$infoWeb['bg_home']; ?>)">
      <div class="container py-5 my-5 index-forward">
        <div class="row">
          <div class="col-md-8 text-white">
            <h2 class="h4 text-primary font-weight-normal mb-0">Hi, I am</h2>
            <?php
            $namaa = explode(' ', $tampilAbout['nama']);
            $tentangg = explode('</p>', $tampilAbout['tentang']);

            ?>
            <h2 class="text-uppercase text-lg mb-0"><?= $namaa['0'] ?> <span class="text-primary"><?= $namaa['1'] ?></span></h2>
            <h4 class="font-weight-normal mb-5"><?= $tampilAbout['profesi']; ?></h4>
            <p class="text-shadow"><?= $tentangg['0'] ?></p>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section-->
    <section class="bg-light" id="about">
      <div class="container">
        <header class="mb-5">
          <p class="font-weight-bold text-primary text-uppercase letter-spacing-3">Innovative solutions</p>
          <h2 class="h3 lined">About</h2>
        </header>
           <div class="text-muted">
           <?= $tampilAbout['tentang'] ?>
           </div>
      </div>
    </section>
    <!-- Expertise Section  -->
    <section id="expertise">
      <div class="container">
        <header class="mb-5 pb-4">
          <p class="font-weight-bold text-primary text-uppercase letter-spacing-3">Batman would be jealous.</p>
          <h2 class="text-uppercase lined">Expertise</h2>
        </header>
        <div class="row">
          <?php
          $no=1;
          while($skl = mysqli_fetch_assoc($tampilSkill)){
            ?>
          <div class="col-md-6 mb-5">
            <h3 class="h4"><span class="text-primary mr-2"><?= $no; ?></span><?= $skl['skill_nama'] ?></h3>
            <p class="text-muted text-small ml-4 pl-3"><?= $skl['deskripsi'] ?></p>
          </div>
          <?php
          $no++;
          }
          ?>
        </div>
      </div>
    </section>
    <!-- Education Section-->
    <section class="bg-light" id="education">
      <div class="container">
        <header class="mb-5 pb-4">
          <p class="font-weight-bold text-primary text-uppercase letter-spacing-3">Lazy isn't in my vocabulary.</p>
          <h2 class="text-uppercase lined">Education</h2>
        </header>
        <!--  Timeline -->
        <ul class="timeline">
          <?php
         while($edu = mysqli_fetch_assoc($tampilEdu)){
          ?>
              <!-- Timeline item-->
              <li class="timeline-item ml-3 pb-4">
                <div class="timeline-arrow"></div>
                <div class="row no-gutter">
                  <div class="col-lg-5 mb-4 mb-lg-0">
                    <p class="font-weight-bold mb-2 text-primary text-small"><?= $edu['durasi']; ?></p>
                    <h2 class="h5 mb-0 text-uppercase"><?= $edu['nama_sekolah']; ?></h2>
                  </div>
                  <div class="col-lg-7">
                    <p class="text-muted"><?= $edu['deskripsi']; ?></p>
                  </div>
                </div>
              </li>
              <?php
                  }
              ?>
           
        </ul>
      </div>
    </section>
    <!-- Experience Section        -->
    <section id="experience">
      <div class="container">
        <header class="mb-5 pb-4">
          <p class="font-weight-bold text-primary text-uppercase letter-spacing-3">Yes. I've been around.</p>
          <h2 class="text-uppercase lined">Experience</h2>
        </header>
        <!--  Timeline -->
        <ul class="timeline">
        <?php
         while($expe = mysqli_fetch_assoc($tampilExpe)){
          ?>
              <!-- Timeline item-->
              <li class="timeline-item ml-3 pb-4">
                <div class="timeline-arrow"></div>
                <div class="row no-gutter">
                  <div class="col-lg-5 mb-4 mb-lg-0">
                    <p class="font-weight-bold mb-2 text-primary text-small"><?= $expe['durasi']; ?> </p>
                    <h2 class="h5 mb-0 text-uppercase"><?= $expe['expe_nama']; ?></h2>
                    <p class="text-small mb-0"><?= $expe['posisi']; ?></p>
                  </div>
                  <div class="col-lg-7">
                    <p class="text-muted"><?= $expe['deskripsi']; ?></p>
                  </div>
                </div>
              </li>
        <?php
         }
        ?>
        </ul>
      </div>
    </section>
    <!-- Education Section        -->
    <section class="bg-light" id="contact">
      <div class="container">
        <header class="mb-5 pb-4">
          <p class="font-weight-bold text-primary text-uppercase letter-spacing-3">Call me, maybe.</p>
          <h2 class="text-uppercase lined">Contact</h2>
        </header>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <div class="px-4 py-5 text-center contact-item shadow-sm"><i class="fas fa-map-marker-alt fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">Location</h4>
              <p class="text-small mb-0"><?= $tampilContact['location'];?></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <div class="px-4 py-5 text-center contact-item shadow-sm"><i class="fas fa-mobile fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">Phone</h4>
              <p class="text-small mb-0"><?= $tampilContact['phone'];?></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0"><a class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor" href="<?= $tampilContact['website'];?>"><i class="fas fa-globe-americas fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">Website</h4>
              <p class="text-small mb-0"><?= $tampilContact['website'];?></p></a></div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0"><a class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor" href="mailto:<?= $tampilContact['email'];?>"><i class="fas fa-envelope fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">Email</h4>
              <p class="text-small mb-0"><?= $tampilContact['email'];?></p></a></div>
        </div>
      </div>
    </section>
    <!-- Footer-->
    <footer>
      <div class="container text-center section-padding-y">
        <div class="row px-4">
          <div class="col-lg-7 mx-auto">
            <h2 class="text-uppercase mb-0"><?= $tampilAbout['nama'];?> </h2>
            <h6 class="text-primary text-uppercase mb-0 letter-spacing-3"><?= $tampilAbout['profesi'];?></h6>
            <br>
            <ul class="list-inline mb-0">
              <?php
              while($sosmed = mysqli_fetch_assoc($tampilSosmed)){
              ?>
               <li class="list-inline-item"><a class="social-link" target="_blank" href="<?= $sosmed['sosmed_link'];?>"><i class="fab fa-<?= $sosmed['sosmed_name'];?>"></i></a></li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <br>
      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Send Massage </button>
      </div>
        
      <div class="copyrights px-4">
        <div class="container py-4 border-top text-center">
          <p class="mb-0 text-muted py-2">&copy; All rights reserved. designed by <a href="#">Bootstrap Temple</a>. </p>
        </div>
      </div>
    </footer>
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState(null, null, window.location.href);
    }
    </script>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/front.js"></script>
    <link rel="stylesheet" href="fontawesome-free/css/all.css">
  </body>
</html>