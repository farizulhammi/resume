<?php
//error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$config = [
    "host"     => "localhost",
    "username"  => "root",
    "password" => "",
    "dbname"     => "resume"
];

    
$conn = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);

if (mysqli_connect_errno()) {
    "KONEKSI ERROR DI SEBABKAN ".mysqli_connect_error();
}
$base_url = "http://localhost/resume/";
$base_admin = $base_url."admiin/"; 


$ymd = date("Y-m-d");
$his = date("H:i:s");
require('lib/function.php');