<?php
include "koneksi.php";
$tahun = date('Y');
$jumlah_nota = mysqli_query($kon,"SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '01' and year(PENJUALAN) = '$tahun'");
$bulan = [];
for($i=0; $i<=12; $i++){
$bulan[$i] = "tryuhujkghjkl".$i;
echo $bulan[$i]."<br>";
}
echo "<hr>";
for($i=0; $i<=12; $i++){
    echo $bulan[$i]."<br>";
}
