<?php
session_start();
$pagename = "Skill";
require('../config.php');
require('../lib/cek_session.php');


$respon = " ";
if (isset($_GET['delete'])) {
  $id = protek($_GET['delete']);
  $dell = mysqli_query($conn, "DELETE FROM skill WHERE skill_id='$id' ");
  if ($dell == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    $respon = '<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Sukses</b> Data Berhasil Di Hapus
    </div>';
  }
}
if (isset($_POST['save_edit'])) {
  $skill = $_POST['skilln'];
  $desc = $_POST['desc'];
  $idd = $_POST['idd'];
  $edit = mysqli_query($conn, "UPDATE `skill` SET `skill_nama`='$skill',`deskripsi`='$desc' WHERE skill_id='$idd' ");
  if ($edit == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    $respon = '<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Sukses</b> Data Berhasil Di Ubah
    </div>';
  }
}
if (isset($_POST['save_add'])) {
  $skillc = $_POST['skillnc'];
  $descc = $_POST['descc'];
  $add = mysqli_query($conn, "INSERT INTO `skill`(`skill_id`, `skill_nama`, `deskripsi`) VALUES ('','$skillc','$descc')");
  if ($add == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    $respon = '<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Sukses</b> Berhasil Menambahkan Data Baru
    </div>';
  }
}
include('../lib/header.php');
?>
      <!-- Modal-->
      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="exampleModalLabel" class="modal-title">EDIT</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

              <div class="modal-data"></div>

            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
          </div>
        </div>
      </div>

<!-- batas  -->
<div id="modalSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="exampleModalLabel" class="modal-title">Add</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
    <div class="form-group">
    <label>Skill</label>
    <input type="text" name="skillnc" value="" class="form-control">
    </div>
    <div class="form-group">
    <label>Deskripsi</label>
    <textarea name="descc" cols="30" rows="5" class="form-control"></textarea>
  </div>
    <div class="form-group">       
    <input type="submit" name="save_add" value="Add" class="btn btn-primary">
    </div>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
        <div class="container-fluid px-xl-5">
          <section class="py-5"> 
          <div class="row">
             <!-- Basic Form-->
             <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="card-header">
                          
                    <h6 class="text-uppercase mb-0">Kemampuan
                      <span style="float:right" class="text-success">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSkill"><i class="fa fa-plus" aria-hidden="true"></i></button></span></h6>
                  </div>
                  <div class="card-body"> 
                 <?= $respon ?>
                  <div class="table-responsive-sm">                        
                    <table class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Skill</th>
                          <th>Deskripsi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        $qry = mysqli_query($conn,"SELECT * FROM skill");
                        while($data = mysqli_fetch_assoc($qry)){
                        ?>
                        <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['skill_nama'] ?></td>
                        <td><?= $data['deskripsi'] ?></td>
                  
                        <td>
                          <form action="" method="get">
                          <button type="button" class="btn btn-success btn-sm" style="padding: 2px 19px;" data-toggle="modal" data-target="#myModal" data-id="<?= $data['skill_id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                          <button name="delete" value="<?= $data['skill_id']; ?>" class="btn btn-danger btn-sm" style="padding: 2px 20px; margin:2px"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </form>
                        </td>
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
             </div>
          </div>
          </section>
        </div>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var getId = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '../ajax/skill/edit.php',
                data :  'getId='+ getId,
                success : function(data){
                $('.modal-data').html(data);
                }
            });
         });
    });
  </script>
   
       <?php
       include('../lib/footer.php');
       ?>