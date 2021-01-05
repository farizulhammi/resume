<?php
require('../../config.php');
if (isset($_POST['getId'])){
    $id = $_POST['getId'];
    $qry = mysqli_query($conn, "SELECT * FROM skill WHERE skill_id='$id' ");
    $editSkill = mysqli_fetch_assoc($qry);
}

?>

<form action="" method="post">
        <div class="form-group">
        <label>Skill</label>
        <input type="text" name="skilln" value="<?= $editSkill['skill_nama'] ?>" class="form-control">
        <input type="hidden" name="idd" value="<?= $_POST['getId']; ?>">
        </div>
        <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="desc" cols="30" rows="5" class="form-control"><?= $editSkill['deskripsi'] ?></textarea>
    </div>
        
        <div class="form-group">       
        <input type="submit" name="save_edit" value="Save Change" class="btn btn-primary">
        </div>
    </form>