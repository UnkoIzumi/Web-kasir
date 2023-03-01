<?php
session_start();
if(isset($_SESSION["username"])){
  header("location:kasir.php");
}
$alert = "";
 if(isset($_GET['error'])){
    $alert = $_GET['error'];
  }
  if($alert == "invalid"){
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
  }else if($alert == "login"){
    echo "<script>alert('Password atau Username yang anda masukkan salah')</script>";
  }
?><!DOCTYPE html>
<html class="hydrated", lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images\favicon.ico" type="ico">
    <title>Aplikasi Kasir</title>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
</head>

<body>
    <div class="center">
        <h1>Aplikasi Kasir</h1>
        <form method="post" action="cek_login.php">
            <div class="txt_field">
                <input type="text" name = "username" id = "username" required>
                <span></span>
                <label>username</label>
            </div>
            <div class="txt_field">
                <input type="password" name = "password" id = "password" required>
                <span></span>
                <label>password</label>
            </div>
            <input type="submit" value="login">
            <div class="mark"></div>
        </form>
    </div>
</body>
</html>