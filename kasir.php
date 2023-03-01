<?php
//session start
session_start();
if (empty($_SESSION['username'])) {
    header("Location:index.php?error=invalid");
}
//if akun unset
//err message
if (isset($_GET['err'])) {
    $err = $_GET['err'];
    if ($err == "quantity") {
        echo '<script>alert("Gagal ditambahkan. Stok tidak mencukupi")</script>';
    }
}
include "koneksi.php";
$totalnota = 0;
$tahun = date('Y');
$bulan = date('m');
$tgl = date('d');
//generate no nota
if (isset($_SESSION["nota"])) {
    $id_nota = $_SESSION["nota"];
} else {
    $query = "SELECT * FROM NOTA";
    $hasil = mysqli_query($kon, $query);
    $row = mysqli_num_rows($hasil);
    if ($row == NULL) {
        $numb = 1;
    } else {
        $numb = $row + 1;
    }
    $id_nota = "" . $tahun . $bulan . $tgl . $numb;
    $_SESSION["nota"] = $id_nota;
}
// $id_nota = "202112074";
function rupiah($angka)
{
    $hasil_rp = "Rp " . number_format($angka, 0, ',', '.');
    return ($hasil_rp);
}
?>

<!DOCTYPE html>
<html class="hydrated">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Kasir</title>
    <link rel="shortcut icon" href="Images\favicon.ico" type="ico">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <!-- <link rel="stylesheet" href="lib/bootstrap-4.0.0\dist\css\bootstrap.min.css"> -->
    <link rel="stylesheet" href="lib/select2/dist/css/select2.min.css">
    <script type="text/javascript" src="lib/js/Chart.js"></script>
</head>

<body>
    <!--bagian view content-->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="person"></ion-icon>
                        </span>
                        <span class="title"><?= $_SESSION['nama'] ?></span>
                    </a>
                </li>
                <li>
                    <a href="kasir.php">
                        <span class="icon">
                            <ion-icon name="home"></ion-icon>
                        </span>
                        <span class="title">Dasboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help"></ion-icon>
                        </span>
                        <span class="title">Bantuan</span>
                    </a>
                </li>
                <li>
                    <a href="absensi.php">
                        <span class="icon">
                            <ion-icon name="people"></ion-icon>
                        </span>
                        <span class="title">Absen Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php">
                        <span class="icon">
                            <ion-icon name="settings"></ion-icon>
                        </span>
                        <span class="title">Pengaturan</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out"></ion-icon>
                        </span>
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
            <!--top menu-->
            <div class="cardBox">
                <div class="card">
                    <a href="income.php">
                        <div>
                            <?php
                            $sql1 = "SELECT SUM(TOTAL_PENJUALAN) FROM NOTA WHERE month(TANGGAL_PENJUALAN)='$bulan'";
                            $run1 = mysqli_query($kon, $sql1);
                            if ($run1 == TRUE) {
                                $row1 = mysqli_fetch_array($run1);
                                if ($row1 != NULL) {
                                    $in =  rupiah($row1["SUM(TOTAL_PENJUALAN)"]);
                                } else {
                                    $in = 'Rp 0';
                                }
                            } else {
                                $in = 'Rp 0';
                            }

                            ?>
                            <div class="numbers"><?= $in ?></div>
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
                            if ($run2 == TRUE) {
                                $row2 = mysqli_fetch_array($run2);
                                if ($row2 != NULL) {
                                    $out =  rupiah($row2["SUM(TOTAL_BAYAR)"]);
                                } else {
                                    $out = 'Rp 0';
                                }
                            } else {
                                $out = 'Rp 0';
                            }

                            ?>
                            <div class="numbers"><?= $out ?></div>
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
                            $row3 = mysqli_fetch_array(mysqli_query($kon, $sql3));
                            if ($row3 == NULL) {
                                $barang3 = 0;
                            } else {
                                $barang3 = $row3["COUNT(ID_BARANG)"];
                            }
                            ?>
                            <div class="numbers"><?= $barang3 ?> Barang</div>
                            <div class="cardName">Stok Barang</div>
                        </div>
                        <div class="iconBx">
                            <img src="Images\Iconly\Light\bag.png" width="50px" height="50px">
                        </div>
                    </a>
                </div>
            </div>


            <!-- content -->
            <div class="details">
                <!-- Transaksi -->
                <div class="transaksi">
                    <div class="cardHeader">
                        <h2>Transaksi</h2>
                        <a href="#" class="btn">----</a>
                    </div>
                    <div class="inputdata">
                        <form action="aksi.php" method="post">
                            <div class="data">
                                <label for="quantity">
                                    <h4>Data Barang</h4>
                                    <!-- <input type="text" placeholder="nama barang"> -->
                                    <select name="product" id="barang" required>
                                        <option></option>
                                        <?php
                                        include "koneksi.php";
                                        $query =  "SELECT * FROM BARANG ORDER BY NAMA_BARANG";
                                        $hasil = mysqli_query($kon, $query);
                                        while ($row = mysqli_fetch_array($hasil)) {
                                            $tempstok = $row['STOK_BARANG'];

                                        ?>
                                            <option value="<?php echo $row['ID_BARANG']; ?>"><?php echo $row['NAMA_BARANG'] . " | Stok : " . $tempstok; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </label>
                                <label for="quantity">
                                    <h4><br>Jumlah</h4>
                                    <input type="number" class="quantity" name="quantity" min="1" max="200" required>
                                </label>
                                <input type="hidden" name="id_nota" value="<?php echo $id_nota ?>">
                                <label class="cardd">
                                    <input type="submit" name="submit" class="subs1" value="Tambah">
                                </label>
                            </div>
                        </form>
                        <div class="harga">
                            <h4>Nota : <?= $id_nota ?></h4>
                            <?php
                            $query = "SELECT TOTAL_HARGA FROM DETIL_NOTA WHERE ID_NOTA = '$id_nota'";
                            $hasil = mysqli_query($kon, $query);
                            if ($hasil) {
                                while ($row = mysqli_fetch_array($hasil)) {
                                    $totalnota = $totalnota + $row['TOTAL_HARGA'];
                                }
                            }
                            ?>
                            <h1><?= rupiah($totalnota) ?></h1>
                            <form method="post" action="bayar.php">
                                <div class="data">
                                    <input type="hidden" name="nota" value="<?= $id_nota ?>">
                                    <input type="hidden" name="bayar" value="<?= $totalnota ?>">
                                    <label class="cardd">
                                        <input type="submit" name="submit" class="subs2" value="Bayar & Cetak">
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="contain">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nama</td>
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                    <td>Total</td>
                                    <td>Hapus</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM DETIL_NOTA INNER JOIN BARANG ON DETIL_NOTA.ID_BARANG = BARANG.ID_BARANG WHERE DETIL_NOTA.ID_NOTA = '$id_nota'";
                                $hasil = mysqli_query($kon, $query);
                                if (!$hasil) {
                                    die("Query error:" . mysqli_errno($kon) . " - " . mysqli_error($kon));
                                }
                                while ($row = mysqli_fetch_array($hasil)) {
                                ?>
                                    <tr>
                                        <td><?= $row["NAMA_BARANG"] ?></td>
                                        <td>Rp<?= $row["HARGA_JUAL"] ?></td>
                                        <td><?= $row["JUMLAH_BARANG"] ?></td>
                                        <td>Rp<?= $row["TOTAL_HARGA"] ?></td>
                                        <td><a href="hapus.php?id=<?= $row["ID_BARANG"] ?>&nota=<?= $row["ID_NOTA"] ?>"><span class="status ret">x</span></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- New right side content -->
                <div class="chart">
                    <div class="cardHeader">
                        <h2>Chart</h2>
                        <a href="#" class="btn">----</a>
                    </div>
                    <canvas style="height : 200px;" id="penjualan"></canvas>
                    <?php
                    $bulan = [];
                    $no = 1;
                    for ($i = 0; $i <= 13; $i++) {
                        $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '$no' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            $bulan[$i] = 0;
                        } else {
                            $bulan[$i] = mysqli_num_rows($jumlah_nota);
                        }
                        $no++;
                    }
                    ?>
                    <div class="contain">
                        <table>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Januari<br><span><?= $bulan[0] ?> Penjualan</span></h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Februari<br><span><?= $bulan[1] ?> penjualan</span></h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Maret<br><span><?= $bulan[2] ?> penjualan</span></h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan April<br><span><?= $bulan[3] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Mei<br><span><?= $bulan[4] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Juni<br><span><?= $bulan[5] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Juli<br><span><?= $bulan[6] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Agustus<br><span><?= $bulan[7] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan September<br><span><?= $bulan[8] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Oktober<br><span><?= $bulan[9] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan November<br><span><?= $bulan[10] ?> penjualan</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="chartBx"></div>
                                </td>
                                <td>
                                    <h4>Bulan Desember<br><span><?= $bulan[11] ?> penjualan</span></h4>
                                </td>
                            </tr>
                        </table>
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
    <script src="lib/jquery.js"></script>
    <script src="lib/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $("#barang").select2({
                    placeholder: "Cari Barang        "
                });
            }
        );
    </script>
    <script>
        var penjualan = document.getElementById('penjualan').getContext('2d');
        var myChart = new Chart(penjualan, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: "Penjualan tahun <?= $tahun ?>",
                    data: [

                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '01' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '02' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '03' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '04' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '05' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '06' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '07' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '08' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '09' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '10' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '11' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>,
                        <?php $jumlah_nota = mysqli_query($kon, "SELECT * FROM NOTA where month(TANGGAL_PENJUALAN) = '12' and year(TANGGAL_PENJUALAN) = '$tahun'");
                        if (mysqli_num_rows($jumlah_nota) == NULL) {
                            echo '0';
                        } else {
                            echo mysqli_num_rows($jumlah_nota);
                        }
                        ?>
                    ],

                    backgroundColor: [
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                        'rgba(86, 241, 185, 0.8)',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>