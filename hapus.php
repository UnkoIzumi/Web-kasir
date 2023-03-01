<?php
//inisiasi
$id= $_GET["id"];
$nota = $_GET["nota"];

include "koneksi.php";
$query = "DELETE FROM DETIL_NOTA WHERE ID_BARANG = '$id' AND ID_NOTA = '$nota'";
$hapus = mysqli_query($kon,$query);
header("Location:index.php?err=hapus")
?>