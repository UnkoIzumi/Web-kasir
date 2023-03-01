<?php
include "koneksi.php";
$idpeg = $_GET["i"];
$query = "DELETE FROM ABSENSI WHERE ID_PEGAWAI ='$idpeg'";
$present = mysqli_query($kon,$query);
$query = "DELETE FROM PEGAWAI WHERE ID_PEGAWAI ='$idpeg'";
$present = mysqli_query($kon,$query);

header("Location:absensi.php");
?>