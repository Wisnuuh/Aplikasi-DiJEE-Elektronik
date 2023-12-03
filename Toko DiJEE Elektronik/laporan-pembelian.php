<?php

    require ("koneksi.php");
    // $email = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : "";

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }
    $sesID = $_SESSION ['id'];
    $sesName = $_SESSION ['name'];
    $sesLvl = $_SESSION ['level'];

    $bulan_tes =array(
        '01'=>"Januari",
        '02'=>"Februari",
        '03'=>"Maret",
        '04'=>"April",
        '05'=>"Mei",
        '06'=>"Juni",
        '07'=>"Juli",
        '08'=>"Agustus",
        '09'=>"September",
        '10'=>"Oktober",
        '11'=>"November",
        '12'=>"Desember"
    );

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laporan Pembelian | DiJEE Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

<!-- Memanggil navbar -->
<?php require_once "navbar.php"; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Laporan Pembelian</h1>
                    <ol class="breadcrumb mb-4">
                        <a class="breadcrumb-item active" href="home.php">
                            <li>Dashboard</li>
                        </a>
                        <li class="breadcrumb-item active">Laporan Pembelian</li>
                    </ol>
                </div>
                <!-- Tombol Cari -->
                <div class="col mb-3 px-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h5 class="">Cari Laporan Per Bulan</h5>
                                    </div>
                                        <form method="post" action="laporan-pembelian.php?page=laporan&cari=ok">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>
                                                        Pilih Bulan
                                                    </th>
                                                    <th>
                                                        Pilih Tahun
                                                    </th>
                                                    <th>
                                                        Aksi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select name="bln" class="form-control">
                                                            <option selected="selected">Bulan</option>
                                                            <?php

                                                            $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                                            $jlh_bln=count($bulan);
                                                            $bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                                            $no=1;
                                                            for($c=0; $c<$jlh_bln; $c+=1){
                                                                echo"<option value='$bln1[$c]'> $bulan[$c] </option>";
                                                            $no++;}
                                                            
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        $now = date('Y');
                                                        echo "<select name='thn' class='form-control'>";
                                                        echo '<option selected="selected">Tahun</option>';
                                                        for ($a = 2017; $a <= $now; $a++) {
                                                            echo "<option value='$a'>$a</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="periode" value="ya">
                                                        <button class="btn btn-primary">
                                                            <i class="fa fa-search"></i> Cari
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <form method="post" action="laporan-pembelian.php?page=laporan&hari=cek">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>
                                                        Pilih Hari
                                                    </th>
                                                    <th>
                                                        Aksi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="periode" value="ya">
                                                        <button class="btn btn-primary">
                                                            <i class="fa fa-search"></i> Cari
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <a href="laporan-pembelian.php?page=laporan" class="btn btn-success">
                                                <i class="fa fa-refresh"></i> Refresh
                                            </a>
                                        </form>
                                <!--End Pencarian -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tabel --> 
                <div class="col mb-3 px-4">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Hasil</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <td>ID pembelian</td>
                                            <td>Tanggal</td>
                                            <td>Jumlah</td>
                                            <td>Total</td>
                                            <td>Nama barang</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if (isset($_GET['cari']) && $_GET['cari'] == 'ok') {
                                        $bulan = $_POST['bln'];
                                        $tahun = $_POST['thn'];

                                        $tampil = mysqli_query($koneksi, "SELECT pembelian.Pembelian_ID, DATE_FORMAT(pembelian.Tanggal_Pembelian, '%d %M %Y') as formatted_date, pembelian.Total_Pembayaran, detailpembelian.Jumlah, barang.Nama
                                                                            FROM pembelian 
                                                                            JOIN detailpembelian ON pembelian.Pembelian_ID = detailpembelian.Pembelian_ID
                                                                            JOIN barang ON detailpembelian.Barang_ID = barang.Barang_ID
                                                                            WHERE MONTH(pembelian.Tanggal_Pembelian) = '$bulan' AND YEAR(pembelian.Tanggal_Pembelian) = '$tahun'
                                                                            ORDER BY pembelian.Tanggal_Pembelian DESC");
                                    } elseif (isset($_GET['hari']) && $_GET['hari'] == 'cek') {
                                        $tanggal = $_POST['hari'];

                                        $tampil = mysqli_query($koneksi, "SELECT pembelian.Pembelian_ID, DATE_FORMAT(pembelian.Tanggal_Pembelian, '%d %M %Y') as formatted_date, pembelian.Total_Pembayaran, detailpembelian.Jumlah, barang.Nama
                                                                            FROM pembelian 
                                                                            JOIN detailpembelian ON pembelian.Pembelian_ID = detailpembelian.Pembelian_ID
                                                                            JOIN barang ON detailpembelian.Barang_ID = barang.Barang_ID
                                                                            WHERE DATE(pembelian.Tanggal_Pembelian) = '$tanggal'
                                                                            ORDER BY pembelian.Tanggal_Pembelian DESC");
                                    } else {
                                        $tampil = mysqli_query($koneksi, "SELECT pembelian.Pembelian_ID, DATE_FORMAT(pembelian.Tanggal_Pembelian, '%d %M %Y') as formatted_date, pembelian.Total_Pembayaran, detailpembelian.Jumlah, barang.Nama
                                                                            FROM pembelian 
                                                                            JOIN detailpembelian ON pembelian.Pembelian_ID = detailpembelian.Pembelian_ID
                                                                            JOIN barang ON detailpembelian.Barang_ID = barang.Barang_ID
                                                                            ORDER BY pembelian.Pembelian_ID DESC");
                                    }

                                    $no = 1;
                                    while ($data = mysqli_fetch_array($tampil)) {

                                    ?>
                                        <tr>
                                            <td><?= $data['Pembelian_ID'] ?></td>
                                            <td><?= $data['formatted_date'] ?></td>
                                            <td><?= $data['Jumlah'] ?></td>
                                            <td><?= $data['Total_Pembayaran'] ?></td>
                                            <td><?= $data['Nama'] ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tabel -->
            </main>
        </div>
    </div>
    <script>
    const datatablesSimple4 = document.getElementById('datatablesSimple4');
    if (datatablesSimple4) {
        new simpleDatatables.DataTable(datatablesSimple4);
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>