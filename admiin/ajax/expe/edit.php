<?php
require('../../config.php');
if (isset($_POST['getId'])){
    $id = $_POST['getId'];
    $qry = mysqli_query($conn, "SELECT * FROM experience WHERE experience_id='$id' ");
    $editExpe = mysqli_fetch_assoc($qry);
}

?> 
    <form action="" method="post">
    <div class="form-group">
    <label>Tempat</label>
    <input type="text" name="tempatt" value="<?= $editExpe['expe_nama']; ?>" class="form-control">
    <input type="hidden" name="idd" value="<?=$_POST['getId'];?>">
    </div>
    <div class="form-group">
    <label>Posisi</label>
    <input type="text" name="posisii" value="<?= $editExpe['posisi']; ?>" class="form-control">
    </div>
    <div class="form-group">
    <label>Durasi</label>
    <input type="text" name="durasii" value="<?= $editExpe['durasi']; ?>" class="form-control">
    </div>
    <div class="form-group">
    <label>Deskripsi</label>
    <textarea name="desc" cols="30" rows="5" class="form-control"><?= $editExpe['deskripsi']; ?></textarea>
    </div>
    <div class="form-group">       
    <input type="submit" name="save_edit" value="Save Change" class="btn btn-primary">
    </div>
    </form>