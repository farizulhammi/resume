<?php
$infouser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE username='$usernm' "));
$infoWeb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM website_setting "));

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bubbly Admin - <?= $pagename;?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <script src="<?= $base_admin;?>vendor/jquery/jquery.min.js"></script> 
    <script src="<?= $base_url;?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= $base_url;?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?= $base_url;?>fontawesome-free/css/all.css">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="<?= $base_admin;?>css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?= $base_admin;?>css/style.blue.css"  id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?= $base_admin;?>img/favicon.png?3">
   
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.html" class="navbar-brand font-weight-bold text-uppercase text-base">Bubbly Dashboard</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item dropdown mr-3"><a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
            <div aria-labelledby="notifications" class="dropdown-menu"><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 2 followers</p>
                  </div>
                </div></a><a href="#" class="dropdown-item"> 
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 6 new messages</p>
                  </div>
                </div></a><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">Server rebooted</p>
                  </div>
                </div></a><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 2 followers</p>
                  </div>
                </div></a>
              <div class="dropdown-divider"></div><a href="#" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a>
            </div>
          </li>
          <li class="nav-item dropdown ml-auto"><a id="userInfo" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="<?= $base_url."img/".$infoWeb['icon_web']; ?>" alt="<?=$infouser['nama'] ;?>" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family"><?= $infouser['nama']; ?></strong><small><?= $infouser['username']; ?></small></a>
              <div class="dropdown-divider"></div><a href="<?= $base_admin."profile/setting";?> " class="dropdown-item">Settings</a><a href="<?= $base_admin."profile/logs";?>" class="dropdown-item">Logs</a>
              <div class="dropdown-divider"></div><a href="<?= $base_admin."logout";?>" class="dropdown-item">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family"></div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>" class="sidebar-link text-muted<?php if($pagename == "Home") echo " active"; ?>"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/website" class="sidebar-link text-muted <?php if($pagename == "Setting") echo " active"; ?>"><i class="o-settings-window-1 mr-3 text-gray"></i><span>Setting</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/about" class="sidebar-link text-muted <?php if($pagename == "About") echo " active"; ?>"><i class="o-id-card-1 mr-3 text-gray"></i><span>About</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/skill" class="sidebar-link text-muted <?php if($pagename == "Skill") echo " active"; ?>"><i class="o-survey-1 mr-3 text-gray"></i><span>Skill</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/education" class="sidebar-link text-muted <?php if($pagename == "Education") echo " active"; ?>"><i class="o-diploma-1 mr-3 text-gray"></i><span>Education</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/experience" class="sidebar-link text-muted <?php if($pagename == "Experience") echo " active"; ?>"><i class="o-document-1 mr-3 text-gray"></i><span>Experience</span></a></li>
              <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/contact" class="sidebar-link text-muted <?php if($pagename == "Contact") echo " active"; ?>"><i class="o-contact-card-1 mr-3 text-gray"></i><span>Contact</span></a></li>
        </ul>
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="<?= $base_admin;?>settings/sosmed" class="sidebar-link text-muted <?php if($pagename == "Sosmed") echo " active"; ?>"><i class="o-network-1 mr-3 text-gray"></i><span>Sosmed</span></a></li>
        </ul>
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">