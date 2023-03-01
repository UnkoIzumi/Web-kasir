<?php
include "koneksi.php";
$id_nota = $_POST["id_nota"];
if($_POST["submit"] == "Tambah"){
    //CEK nota
    $query = "SELECT ID_NOTA FROM NOTA WHERE ID_NOTA = '$id_nota'";
    $hasil = mysqli_query($kon, $query);
    $row = mysqli_fetch_array($hasil);
    if($row == NULL){
        $query = "INSERT INTO NOTA (ID_NOTA, TOTAL_PENJUALAN, JAM_PENJUALAN, TANGGAL_PENJUALAN) VALUES ('$id_nota', NULL, NULL, NULL)";
        $createnota = mysqli_query($kon, $query);
        if(!$createnota){
            die("Query error:".mysqli_errno($kon)." - ".mysqli_error($kon));
        }
    }
    //inisiasi variabel
    $count = "SELECT COUNT(ID_DETIL) FROM DETIL_NOTA";
    $result = mysqli_query($kon,$count);
    $nilai = mysqli_fetch_array($result);
    $detil = $nilai["COUNT(ID_DETIL)"]+1;
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];
    $query = "SELECT * FROM BARANG WHERE ID_BARANG = '$product'";
    $read = mysqli_query($kon,$query);
    $row= mysqli_fetch_array($read);
    var_dump($row);
    if ($quantity > $row['STOK_BARANG']){
        header("location:kasir.php?err=quantity");
    }else{
        $bayar = $row['HARGA_JUAL']*$quantity;
        //insert / update ke detil_nota
        $query = "INSERT INTO DETIL_NOTA (ID_BARANG, ID_NOTA, ID_DETIL, JUMLAH_BARANG, TOTAL_HARGA) VALUES ('$product', '$id_nota', '$detil', '$quantity', '$bayar')";
        $adddetail = mysqli_query($kon, $query);
    }
}
header("location:kasir.php");
?>