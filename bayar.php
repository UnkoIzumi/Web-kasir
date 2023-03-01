<?php
session_start();
include "koneksi.php";
if ($_POST["submit"] == "Bayar") {
    // inisiasi
    $nota = $_POST["nota"];
    $bayar = $_POST["bayar"];
    //insert nota 
    $query = "UPDATE NOTA SET TOTAL_PENJUALAN = '$bayar', JAM_PENJUALAN = NOW() , TANGGAL_PENJUALAN = NOW() WHERE ID_NOTA = '$nota'";
    $update = mysqli_query($kon, $query);
    unset($_SESSION["nota"]);
    //Kurangi stok
    $query = "SELECT * FROM DETIL_NOTA WHERE ID_NOTA = '$nota'";
    $hasil = mysqli_query($kon, $query);
    if (!$hasil) {
        die("Query error:" . mysqli_errno($kon) . " - " . mysqli_error($kon));
    }
    while ($row = mysqli_fetch_array($hasil)) {
        $jum = $row["JUMLAH_BARANG"];
        $brg = $row["ID_BARANG"];
        $readstok = "SELECT STOK_BARANG FROM BARANG WHERE ID_BARANG = '$brg'";
        $run = mysqli_query($kon, $readstok);
        $barang = mysqli_fetch_array($run);
        $sisa = $barang["STOK_BARANG"] - $jum;
        $minstok =  "UPDATE BARANG SET STOK_BARANG = '$sisa' WHERE ID_BARANG = '$brg'";
        $run = mysqli_query($kon, $minstok);
    }
    //CETAK NOTA
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
</head>

<body>

</body>
<script>
    window.onload = function() {
        window.open("kasir.php", "_blank"); // will open new tab on window.onload
        window.open("print.php?nt=" + <?= $nota ?>, "_blank"); // will open new tab on window.onload
        window.close();
    }
</script>

</html>