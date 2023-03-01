<?php
session_start();
include "koneksi.php";
$tgl = date('Y-m-d');
$jam = date('H:m:sa');
?>

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
                        <span class="icon"><ion-icon name="person" style="margin-top: 12px"></ion-icon></span>
                        <span class="title"><?= $_SESSION['nama']?></span>
                    </a>
                </li>
                <li>
                    <a href="kasir.php">
                        <span class="icon"><ion-icon name="home" style="margin-top: 12px"></ion-icon></span>
                        <span class="title">Dasboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="help" style="margin-top: 12px"></ion-icon></span>
                        <span class="title">Bantuan</span>
                    </a>
                </li>
                <li>
                    <a href="absensi.php">
                        <span class="icon"><ion-icon name="people" style="margin-top: 12px"></ion-icon></span>
                        <span class="title">Absen Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php">
                        <span class="icon"><ion-icon name="settings" style="margin-top: 12px"></ion-icon></span>
                        <span class="title">Pengaturan</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><ion-icon name="log-out" style="margin-top: 12px"></ion-icon></span>
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
                <!-- Absensi -->
                <div class="Absensi">
                    <div class="cardHeader">
                        <h2>Absensi</h2>
                        <h4 class="btn">----</h4>
                    </div>
                <div class="contain2">
                    <!--popup pegawai baru-->
                    <div class="stok_input">
                        <label class="cardd">
                            <button class="open" data-target="#pegawaibaru">
                            <ion-icon name="create"></ion-icon>
                            Tambah Pegawai
                            </button>
                                <div class="model" id="pegawaibaru">
                                        <div class="header">
                                        <h3>Tambah Pegawai</h3>
                                        </div>
                                        <div class = "stokpopup">
                                            <form action="pegawaibaru.php" method="post">
                                                    <?php
                                                    $sql = "SELECT COUNT(ID_PEGAWAI) FROM PEGAWAI";
                                                    $scount = mysqli_query($kon, $sql);
                                                    $sid = mysqli_fetch_array($scount);
                                                    $jml = $sid["COUNT(ID_PEGAWAI)"];
                                                    if($jml<10){
                                                        $genID = "PG00".$jml;
                                                    }else if($jml<100){
                                                        $genID = "PG0".$jml;
                                                    }else if($jml>=100){
                                                        $genID = "PG".$jml;
                                                    }
                                                    ?>
                                                    <input type="hidden" name="ID" value="<?=$genID?>" required>
                                                    <h3>Nama</h3>
                                                    <input type="text" name = "npeg" placeholder="Nama" required>
                                                    <h3>Nomer HP</h3>
                                                    <input type="text" name = "hppeg" placeholder="Nomer HP">
                                                    <h3>Alamat</h3>
                                                    <input type="text" name = "apeg" placeholder="Alamat">
                                                    <br>
                                                    <div class="su">
                                                    <button type = "submit" name = "btn" value = "ok" class="close" id="close">
                                                        Submit
                                                    </button>
                                                    </div>
                                            </form>
                                        </div>
                                        <br>
                                        <button class="close" data-target="#pegawaibaru">
                                        Tutup
                                        </button>
                                </div>
                        </label>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Nama Karyawan</td>
                                    <td>No. Telp</td>
                                    <td>Alamat</td>
                                    <td style = "width: 15%">Riwayat Hadir</td>
                                    <td>Absensi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor = 1;
                                $query = "SELECT * FROM PEGAWAI ";
                                $hasil = mysqli_query($kon, $query);
                                if(!$hasil){
                                    die("Query error:".mysqli_errno($kon)." - ".mysqli_error($kon));
                                }
                                while($row = mysqli_fetch_array($hasil)){
                                ?>
                                <input type="hidden" id = "idpeg" value = "<?=$row["ID_PEGAWAI"]?>">
                                <tr>
                                    <td><?= $row["NAMA_PEGAWAI"]?></td>
                                    <td><?= $row["NO__TELP"]?></td>
                                    <td><?= $row["ALAMAT"]?></td>
                                    <td>
                                    <button class="open" data-target="#<?=$row["ID_PEGAWAI"]?>">Lihat Riwayat</button>
                                        <div class="model" id="<?=$row["ID_PEGAWAI"]?>">
                                            <div class="header">
                                            <h3>Riwayat</h3>
                                            </div>
                                            <div class = "absenpopup">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <td>Tanggal</td>
                                                            <td>Keterangan</td>
                                                            <td>Waktu</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $id_peg = $row["ID_PEGAWAI"];
                                                        $query = "SELECT * FROM ABSENSI WHERE ID_PEGAWAI ='$id_peg' ORDER BY TANGGAL_ABSENSI DESC";
                                                        $run = mysqli_query($kon,$query);
                                                        while($riwayat = mysqli_fetch_array($run)){
                                                            ?>
                                                            <tr>
                                                                <td><?=$riwayat["TANGGAL_ABSENSI"]?></td>
                                                                <td><?=$riwayat["KETERANGAN"]?></td>
                                                                <td><?=$riwayat["JAM_ABSENSI"]?></td>
                                                            </tr>
                                                            <?php
                                                        } 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <button class="close" data-target="#<?=$row["ID_PEGAWAI"]?>">
                                            Tutup
                                            </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="status-ah">
                                        <?php
                                        $id_peg2 = $row["ID_PEGAWAI"];
                                        $query = "SELECT * FROM ABSENSI WHERE ID_PEGAWAI ='$id_peg2' AND TANGGAL_ABSENSI = '$tgl'";
                                        $run = mysqli_query($kon,$query);
                                        if(mysqli_fetch_array($run)){

                                        }else{
                                        ?>
                                        <div class="absen-b">
                                            <a href="hapusPegawai.php?i=<?=$id_peg2?>">
                                            <span class="title">Hapus</span>
                                            </a>
                                        </div>
                                        <div class="absen">
                                            <a href="hadir.php?s=y&i=<?=$id_peg2?>">
                                            <span class="title">Hadir</span>
                                            </a>
                                        </div>
                                        <div class="no-absen">
                                            <a href="hadir.php?s=n&i=<?=$id_peg2?>">
                                            <span class="title">Tidak Hadir</span>
                                            </a>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    </td>
                                </tr>
                                <?php
                                $nomor++;
                                }
                                ?>
                            </tbody>
                        </table>
                </div>
                <div id="overlay"></div>
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
    <script>
        const opens = document.querySelectorAll("[data-target]");
        const closes = document.querySelectorAll(".close");
        const overlay = document.querySelector("#overlay");
        
        opens.forEach((open) => {
            open.addEventListener("click", () => {
                document.querySelector(open.dataset.target).classList.add("active");
                overlay.classList.add("active");
            });
        });

        closes.forEach((open) => {
            open.addEventListener("click", () => {
                document.querySelector(open.dataset.target).classList.remove("active");
                overlay.classList.remove("active");
            });
        });
    </script>
</body>

</html>