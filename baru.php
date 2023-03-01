<?php
include "koneksi.php";
$nama = $_POST["nbarang"];
$hj = $_POST["jbarang"];
$hb = $_POST["bbarang"];
$desc = $_POST["desc"];
$stok = $_POST["stok"];
    
$kuery = "INSERT INTO BARANG (NAMA_BARANG,DESKRIPSI_BARANG, HARGA_JUAL, HARGA_BELI, STOK_BARANG) VALUES ('$nama','$desc', '$hj', '$hb', '$stok')";
$insert = mysqli_query($kon,$kuery);
header('location:stok.php?s='.$nama);

?>