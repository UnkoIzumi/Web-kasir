<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location:index.php?error=invalid");
}
if(isset($_GET['s'])){
    $bara = $_GET['s'];
    echo "<script>alert('Berhasil menambahkan '$bara')</script>";
}
include "koneksi.php";
?>

<html class="hydrated">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Kasir</title>
    <link rel="shortcut icon" href="Images\favicon.ico" type="ico">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <!--content-->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="person"  style="margin-top: 12px"></ion-icon></span>
                        <span class="title"><?= $_SESSION['nama']?></span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
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
                <!--search-->
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
                    <a href="stok.php">
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
                <!-- Stok -->
                <div class="Barang">
                    <div class="cardHeader">
                        <h2>Stok Barang</h2>
                        <h4 class="btn">----</h4>
                    </div>
                    <div class="stokdata">
                        <!--popup stok-->
                        <div class="stok_input">
                        <label class="cardd">
                            <button class="open" data-target="#stokbaru">
                            <ion-icon name="create"></ion-icon>
                            Stok Baru
                            </button>
                                <div class="model" id="stokbaru">
                                        <div class="header">
                                        <h3>Stok Baru</h3>
                                        </div>
                                        <div class = "stokpopup">
                                            <form action="baru.php" method="post">
                                                    <h3>Tambahkan Barang</h3>
                                                    <input type="text" name = "nbarang" placeholder="Nama Barang" required>
                                                    <h3>Harga Beli Barang</h3>
                                                    <input type="number" min = "0" name = "bbarang" placeholder="Harga Beli" required>
                                                    <h3>Harga Jual Barang</h3>
                                                    <input type="number" min = "0" name = "jbarang" placeholder="Harga Jual" required>
                                                    <br>
                                                    <h3>Stok Awal Barang</h3>
                                                    <input type="number" min = "0" name="stok" required>
                                                    <br>
                                                    <h3>Deskripsi barang</h3>
                                                    <input type="text" name = desc placeholder="..." required>
                                                    <br>
                                                    <div class="su">
                                                    <button type = "submit" name = "btn" value = "ok" class="close" id="close">
                                                        Submit
                                                    </button>
                                                    </div>
                                            </form>
                                        </div>
                                        <br>
                                        <button class="close" data-target="#stokbaru">
                                        Tutup
                                        </button>
                                </div>
                        </label>
                        </div>
                        <!--Search-->
                        <div class="search">
                            <span class="cardd">
                                <input type="text" id="search" onkeyup="myFunction()" placeholder="Cari..">
                                <ion-icon name="search"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div class="tableContain">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <td style = "width:15%">Nama</td>
                                <td style = "width:30%">Deskripsi</td>
                                <td>Harga Jual</td>
                                <td>Harga Beli</td>
                                <td style = "width:5%">Jumlah</td>
                                <td style = "width:15%">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $query = "SELECT * FROM BARANG ";
                            $hasil = mysqli_query($kon, $query);
                            if(!$hasil){
                                die("Query error:".mysqli_errno($kon)." - ".mysqli_error($kon));
                            }
                            while($row = mysqli_fetch_array($hasil)){
                            ?>
                            <form method = "post" action="edit.php">
                            <input type="hidden" name="idbarang" value="<?=$row["ID_BARANG"]?>">
                                        <tr>
                                            <td><?=$row["NAMA_BARANG"]?></td>
                                            <td><?=$row["DESKRIPSI_BARANG"]?></td>
                                            <td><?=rupiah($row["HARGA_JUAL"])?></td>
                                            <td><?=rupiah($row["HARGA_BELI"])?></td>
                                            <td> Stok saat ini : <?=$row["STOK_BARANG"]?><br>
                                                Tambahkan :<input type="number" class = "quantity" name="quantity"></td>
                                            <td>
                                                <button class="btnrestok">Restok</button>
                            </form>
                                                <button class="btnedit" data-target="#BR<?=$row["ID_BARANG"]?>">Edit</button>
                                                <div class="model" id="BR<?=$row["ID_BARANG"]?>">
                                                            <div class="header">
                                                            <h3>Edit Stok</h3>
                                                            </div>
                                                            <div class = "stokedit">
                                                                <form action="update.php" method="post">
                                                                        <h3>Edit informasi</h3>
                                                                        <input type="hidden" name="id" value = "<?= $row["ID_BARANG"]?>">
                                                                        <input type="text" name = "nbarang" value="<?= $row["NAMA_BARANG"]?>" disabled>
                                                                        <h3>Deskripsi barang</h3>
                                                                        <input type="text" name = desc value="<?= $row["DESKRIPSI_BARANG"]?>" disabled>
                                                                        <h3>Harga Beli Barang</h3>
                                                                        <input type="number" min = "0" name = "bbarang" value="<?=$row["HARGA_BELI"]?>">
                                                                        <h3>Harga Jual Barang</h3>
                                                                        <input type="number" min = "0" name = "jbarang" value="<?= $row["HARGA_JUAL"]?>">
                                                                        <br>
                                                                        <div class="su">
                                                                        <button type = "submit" name = "btn" value = "ok" class="close" id="close">
                                                                            Submit
                                                                        </button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <br>
                                                            <button class="close" data-target="#BR<?= $row["ID_BARANG"]?>">
                                                            Tutup
                                                            </button>
                                                </div>      
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div id="overlay"></div>
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

        opens.forEach((btnedit) => {
            btnedit.addEventListener("click", () => {
                document.querySelector(btnedit.dataset.target).classList.add("active");
                overlay.classList.add("active");
            });
        });

        closes.forEach((btnedit) => {
            btnedit.addEventListener("click", () => {
                document.querySelector(btnedit.dataset.target).classList.remove("active");
                overlay.classList.remove("active");
            });
        });
    </script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");


            for (i = 1; i<tr.length; i++){
                td = tr[i].getElementsByTagName("td")[0];

                if (td){
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter)> -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>