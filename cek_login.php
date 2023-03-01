<?php
include "koneksi.php";
$username = $_POST['username'];
$pass = $_POST['password'];
$query = "SELECT * FROM PENGGUNA where USERNAME = '$username' and PASSWORD = '$pass'";

$hasil = mysqli_query($kon, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($kon)." - ".mysqli_error($kon));
        }

if($row = mysqli_fetch_assoc($hasil)){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $row['NAMA'];
    $_SESSION['id'] = $row['ID_USER'];

    header("location:kasir.php");
}else{
    header("location:index.php?error=login");
}
?>