<?php
include "koneksi.php";
$id = $_POST["idbarang"];
$jmlh = $_POST["quantity"];
$select = "SELECT * FROM BARANG WHERE ID_BARANG = '$id'";
$comp = mysqli_query($kon,$select);
$data = mysqli_fetch_array($comp);
$quantity = $jmlh + $data["STOK_BARANG"];
$update= "UPDATE BARANG SET STOK_BARANG = '$quantity'  WHERE ID_BARANG = '$id'";
$comp = mysqli_query($kon,$update);
$harga = $data["HARGA_BELI"];
$biaya = $harga*$jmlh;
$tgl = date('Y-m-d');
$insert2 = "INSERT INTO PEMBELIAN VALUES ('', '$id', '$jmlh', '$biaya', '$tgl')";
$comp = mysqli_query($kon,$insert2);
header("location:stok.php");
?>