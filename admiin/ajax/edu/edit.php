<?php
require('../../config.php');
if (isset($_POST['getId'])){
    $id = $_POST['getId'];
    $qry = mysqli_query($conn, "SELECT * FROM education WHERE edu_id='$id' ");
    $editEdu = mysqli_fetch_assoc($qry);
}

?>
<form action="" method="post">
        <div class="form-group">
        <label>Nama Sekolah</label>
        <input type="text" name="schnamee" value="<?= $editEdu['nama_sekolah']; ?>" class="form-control">
        <input type="hidden" name="idd" value="<?= $_POST['getId']; ?>">
        </div>
        <div class="form-group">
        <label>Durasi</label>
        <input type="text" name="durasii" value="<?= $editEdu['durasi']; ?>" class="form-control">
        </div>
        <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="desc" cols="30" rows="5" class="form-control"><?= $editEdu['deskripsi']; ?></textarea>
      </div>
        
        <div class="form-group">       
        <input type="submit" name="save_edit" value="Save Change" class="btn btn-primary">
        </div>
    </form>