<?php
require('../../config.php');
if (isset($_POST['getId'])){
    $id = $_POST['getId'];
    $qry = mysqli_query($conn, "SELECT * FROM sosmed WHERE sosmed_id='$id' ");
    $editSosmed = mysqli_fetch_assoc($qry);
}

?>
<form action="" method="post">
    <div class="form-group">
    <label>Sosmed Nama</label>
    <input type="text" name="s_name" value="<?= $editSosmed['sosmed_name']; ?>" class="form-control">
    <input type="hidden" name="idd" value="<?= $_POST['getId'];?>">
    </div>
    <div class="form-group">
    <label>Sosmed Link</label>
    <input type="text" name="s_link" value="<?= $editSosmed['sosmed_link']; ?>" class="form-control">
    </div>
    <div class="form-group">       
    <input type="submit" name="save_edit" value="Save Change" class="btn btn-primary">
    </div>
</form>