<?php
include "koneksi.php";
$tgl = date('Y-m-d');
$jam = date('H:i:sa');
var_dump($jam);
$status = $_GET["s"];
$idpeg = $_GET["i"];

if($status == "y"){
    $query = "INSERT INTO ABSENSI VALUES ('', '$idpeg', '$tgl', '$jam', 'HADIR')";
    $present = mysqli_query($kon,$query);
}else{
    $query = "INSERT INTO ABSENSI VALUES ('', '$idpeg', '$tgl', '', 'TIDAK HADIR')";
    $present = mysqli_query($kon,$query);
}

header("Location:absensi.php");
?>