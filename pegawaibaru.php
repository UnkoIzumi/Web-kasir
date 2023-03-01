<?php
include "koneksi.php";
$nama = $_POST["npeg"];
$hp = $_POST["hppeg"];
$alam = $_POST["apeg"];
$ID = $_POST["ID"];

    
$kuery = "INSERT INTO PEGAWAI (ID_PEGAWAI, NAMA_PEGAWAI, NO__TELP, ALAMAT) VALUES ('$ID','$nama', '$hp', '$alam')";
$insert = mysqli_query($kon,$kuery);
header('location:absensi.php');

?>