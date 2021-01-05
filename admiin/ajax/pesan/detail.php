<?php
require('../../config.php');
if (isset($_POST['getId'])) {
    $id =  ($_POST['getId']);
    $qry =  mysqli_query($conn, "SELECT * FROM pesan WHERE pesan_id='$id'");
    $detailPesan = mysqli_fetch_assoc($qry);
    if ($detailPesan['status_read'] == 'no') {
    mysqli_query($conn, "UPDATE pesan SET status_read='yes' WHERE pesan_id='$id' ");
    }
   
}

?>

<p><b><?= $detailPesan['nama_pengirim'];?></b>, <?= $detailPesan['mail_pengirim'];?></p>
<p><?= $detailPesan['waktu'];?></p>
<hr>
<p>
<?= $detailPesan['pesan'];?>
</p>