<?php
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $qry = mysqli_query($conn,"SELECT username FROM user WHERE username='$user'");
    $cek = mysqli_num_rows($qry);
    if ($cek = 0) {
        header("Location: ".$base_admin."logout");

    }else {
        $usernm = $_SESSION['username'];
    }
}else {
    header("Location: ".$base_admin."login");
}