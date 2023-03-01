<?php
include "koneksi.php";
$id = $_POST['id'];
$hj = $_POST['jbarang'];
$hb = $_POST['bbarang'];
$query = "UPDATE BARANG SET HARGA_BELI = '$hb', HARGA_JUAL = '$hj' WHERE ID_BARANG = '$id'";
$run = mysqli_query($kon, $query);
header('location:stok.php');
?>