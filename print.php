<?php
$id_nota = $_GET['nt'];
include "koneksi.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images\favicon.ico" type="ico">
    <title>Print</title>
    <style type="text/css">
        .top {
            display: flex;
            width: 100%;
            height: 4rem;
            justify-content: space-between;
            align-items: center;
            padding: 5px 5px;
            margin-top: 10px;
        }
        table {
            margin-top: 10px;
            margin: auto;
            width: 98%;
            border-collapse: collapse;
            border-spacing: 0;
            border: none;
        }
        .txt_top {
            position: relative;
            margin-right: 20px;
        }
        .txt_top p {
            font-size: 3.5vw;
            font-weight: bold;
        }
        .logo {
            position: relative;
            width: 30%;
            height: 100%;
            padding: 10px 10px 10px 10px;
        }
        img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        thead {
            background-color: #C4C4C4;
            color: black;
        }
        thead tr {
            font-weight: bold;
            text-align: center;
            font-size: 3.5vw;
        }
        tbody td {
            text-align: center;
            font-size: 3.5vw;
        }
        .alltotal {
            text-align: left;
            font-size: 3.5vw;
        }
        tr, td {
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>

<body>
    <div class="top">
        <div class="logo">
            <img src="Images\logo_ud.png">
        </div>
        <div class="txt_top">
        <p>Bukti Pembayaran<br>
        No.Nota: INV/<?= $id_nota ?><br>
        Tanggal: <?= date('Y-m-d') ?></p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <td>Nama</td>
                <td>Harga Satuan</td>
                <td>Jumlah</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM DETIL_NOTA INNER JOIN BARANG ON DETIL_NOTA.ID_BARANG = BARANG.ID_BARANG WHERE DETIL_NOTA.ID_NOTA = '$id_nota'";
            $hasil = mysqli_query($kon, $query);
            $belanja = 0;
            function rupiah($angka){
                $hasil_rp = "Rp " . number_format($angka,0,',','.');
                return($hasil_rp);
            }
            if (!$hasil) {
                die("Query error:" . mysqli_errno($kon) . " - " . mysqli_error($kon));
            }
            while ($row = mysqli_fetch_array($hasil)) {
            ?>
                <tr>
                    <td><?= $row["NAMA_BARANG"] ?></td>
                    <td><?= rupiah($row["HARGA_JUAL"]) ?></td>
                    <td><?= $row["JUMLAH_BARANG"] ?></td>
                    <td><?= rupiah($row["TOTAL_HARGA"]) ?></td>
                </tr>
            <?php
                $belanja = $belanja + $row["TOTAL_HARGA"];
            }
            ?>
            <tr>
                <td colspan="3" class="alltotal">
                    <p>Total Belanja: </p>
                </td>
                <td>
                    <p><?= rupiah($belanja) ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <p style="text-align: center;">Terima kasih</p>
</body>
<script>
    window.onload = function() {
        window.print();
        setTimeout("window.close();", 3000);
    }
</script>

</html>