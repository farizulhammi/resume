<?php
session_start();
$pagename = "Activity";
require('../config.php');
require('../lib/cek_session.php');

include('../lib/header.php');
?>
        <div class="container-fluid px-xl-5">
          <section class="py-5">
             <!-- Basic Form-->
             <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Aktivitas Login</h6>
                  </div>
                  <div class="card-body">                           
                    <table class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Log IP</th>
                          <th>Log Waktu</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        $qry = mysqli_query($conn,"SELECT * FROM log WHERE username='$usernm' ORDER BY log_id DESC ");
                        while($log = mysqli_fetch_assoc($qry)){
                        ?>
                        <tr>
                          <th scope="row"><?=$no;?></th>
                          <td><?= $log['log_ip'];?></td>
                          <td><?= $log['log_waktu'];?></td>
                        </tr>
                        <?php
                        $no++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </section>
        </div>
       <?php
       include('../lib/footer.php');
       ?>