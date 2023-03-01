<?php
session_start();
include "koneksi.php";
$id = $_SESSION['id'];
$pbaru = $_POST["pbaru"];
$pbaru2 = $_POST["pbarukon"];
$plama = $_POST["plama"];
$kueri = "SELECT PASSWORD FROM PENGGUNA WHERE ID_USER = '$id'";
$get =  mysqli_query($kon, $kueri);
$pw = mysqli_fetch_array($get);
$pass = $pw["PASSWORD"];
if($pbaru == $pbaru2){
    if($pass == $plama){
        $upd = "UPDATE PENGGUNA SET PASSWORD = '$pbaru' WHERE PASSWORD = '$pass'";
        $run = mysqli_query($kon,$upd);
        header('location:setting.php?alert=sukses');
    }else{
        header('location:setting.php?alert=wrong');
    }
}else{
    header('location:setting.php?alert=match');
}

?>