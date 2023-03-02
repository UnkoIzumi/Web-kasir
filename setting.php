<?php
session_start();
include "koneksi.php";
$alert = "";
if(isset($_GET["alert"])){
    $alert = $_GET["alert"];
    if($alert == "sukses"){
        echo "<script>alert('Password berhasil diubah')</script>";
    }
    if($alert == "match"){
        echo "<script>alert('Password gagal diubah, masukkan password baru dan ulangi dengan benar')</script>";
    }
    if($alert == "wrong"){
        echo "<script>alert('Password gagal diubah, masukkan password lama dengan benar')</script>";
    }
}
?>
<!DOCTYPE html>
<html class="hydrated">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Kasir</title>
    <link rel="shortcut icon" href="Images\favicon.ico" type="ico">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <!--bagian view content-->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <span class="title"><?= $_SESSION['nama']?></span>
                    </a>
                </li>
                <li>
                    <a href="kasir.php">
                        <span class="icon"><ion-icon name="home"></ion-icon></span>
                        <span class="title">Dasboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="help"></ion-icon></span>
                        <span class="title">Bantuan</span>
                    </a>
                </li>
                <li>
                    <a href="absensi.php">
                        <span class="icon"><ion-icon name="people"></ion-icon></span>
                        <span class="title">Absen Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php">
                        <span class="icon"><ion-icon name="settings"></ion-icon></span>
                        <span class="title">Pengaturan</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><ion-icon name="log-out"></ion-icon></span>
                        <span class="title">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--utama-->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu"></ion-icon>
                </div>
                <!--Name-->
                <div class="name_web">
                    <label>
                        <h2 align="center">Web Kasir</h2>
                    </label>
                </div>
                <!--user-->
                <div class="user">
                    <img src="Images\foto.png">
                </div>
            </div>

            <!--top menu-->
            <div class="cardBox">
                <div class="card">
                    <a href="income.php">
                        <div>
                            <?php
                            $bulan = date('m');
                            function rupiah($angka){
                                $hasil_rp = "Rp " . number_format($angka,0,',','.');
                                return($hasil_rp);
                            }
                            $sql1 = "SELECT SUM(TOTAL_PENJUALAN) FROM NOTA WHERE month(TANGGAL_PENJUALAN)='$bulan'";
                            $run1 = mysqli_query($kon, $sql1);
                            if($run1 == TRUE){
                                $row1 = mysqli_fetch_array($run1);
                                if($row1 != NULL){
                                    $in =  rupiah($row1["SUM(TOTAL_PENJUALAN)"]);
                                }else{
                                    $in = 'Rp 0';
                                }
                            }else{
                                $in = 'Rp 0';
                            }
                        
                            ?>
                            <div class="numbers"><?= $in?></div>
                            <div class="cardName">Income</div>
                        </div>
                        <div class="iconBx">
                            <img src="Images\Iconly\Light\Wallet.png" width="50px" height="50px">
                        </div>
                        </a>
                </div>

                <div class="card">
                    <a href="outcome.php">
                    <div>
                        <?php
                            $sql2 = "SELECT SUM(TOTAL_BAYAR) FROM PEMBELIAN WHERE month(TANGGAL_PEMBELIAN)='$bulan'";
                            $run2 = mysqli_query($kon, $sql2);
                            if($run2 == TRUE){
                                $row2 = mysqli_fetch_array($run2);
                                if($row2 != NULL){
                                    $out =  rupiah($row2["SUM(TOTAL_BAYAR)"]);
                                }else{
                                    $out = 'Rp 0';
                                }
                            }else{
                                $out = 'Rp 0';
                            }
                        
                            ?>
                        <div class="numbers"><?= $out?></div>
                        <div class="cardName">Outcome</div>
                    </div>
                    <div class="iconBx">
                        <img src="Images\Iconly\Light\Wallet.png" width="50px" height="50px">
                    </div>
                    </a>
                </div>

                <div class="card">
                    <a href="kasir.php">
                        <div>
                            <div class="numbers">Kasir</div>
                            <div class="cardName">Lakukan Transaksi</div>
                        </div>
                        <div class="iconBx">
                            <img src="Images\Iconly\Light\transaksion.png" width="50px" height="50px">
                        </div>
                    </a>
                </div>

                <div class="card">
                    <a href="Stok.php">
                        <div>
                            <?php
                            $sql3 = "SELECT COUNT(ID_BARANG) FROM BARANG";
                            $row3 = mysqli_fetch_array(mysqli_query($kon,$sql3)); 
                            if($row3== NULL){
                                $barang3 = 0;
                            }else{
                                $barang3 = $row3["COUNT(ID_BARANG)"];
                            }
                            ?>
                            <div class="numbers"><?= $barang3?> Barang</div>
                            <div class="cardName">Stok Barang</div>
                        </div>
                        <div class="iconBx">
                            <img src="Images\Iconly\Light\bag.png" width="50px" height="50px">
                        </div>
                    </a>
                </div>
            </div>

            <!-- content -->
            <div class="details2">
                <!-- Income -->
                <div class="Income">
                    <div class="cardHeader">
                        <h2>Setting</h2>
                        <h4 class="btn">----</h4>
                    </div>
                <div class="containpeg">
                <div class="txt_field">
                    <form action="Upass.php" method="post">
                    <h4 class="txtpas">Password Lama </h4>
                    <input class="in_txt" type="password" name = "plama"required>
                    <h4 class="txtpas">Password Baru </h4>
                    <input class="in_txt" type="password" name = "pbaru"required>
                    <h4 class="txtpas">Ulangi Password Baru</h4>
                    <input class="in_txt" type="password" name="pbarukon" required>
                    <br>
                    <input type="submit" value="Submit" class="sub_pass">
                    </form>
                    
            <div class="mark"></div>
            </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script>
        // menu toggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }

        //hover class list
        let list = document.querySelectorAll('.navigation li');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink));
    </script>
</body>

</html>