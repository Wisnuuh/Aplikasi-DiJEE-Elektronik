<?php
require_once "koneksi.php";

session_start();

if(!isset($_SESSION['id'])){
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesID = $_SESSION ['id'];
$sesName = $_SESSION ['name'];
$sesLvl = $_SESSION ['level'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // $data = json_decode(file_get_contents("php://input"), true);

    // Ambil data dari POST request
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];
    $jumlahBarang = isset($_POST['jumlahBarang']) ? $_POST['jumlahBarang'] : [];
    $pembayaran = isset($_POST['bayar']) ? $_POST['bayar'] : 0;
    $total = isset($_POST['total']) ? $_POST['total'] : 0;
    // $id = $_GET['ids'];

}

// echo $id;

// Lakukan sesuatu dengan IDs dan jumlah barang
$response = "<br>"."IDs yang diterima: " . print_r($ids, true) ."<br>";
$response2 = "Jumlah Barang yang diterima: " . print_r($jumlahBarang, true) . "<br>";

if(isset($_POST['proses'])) {
    $tglPenjualan = $_POST['tgl'];
    $totalbayar = $_POST['totalbayar'];
    $bayar = $_POST['pembayaran'];
    $kembali = $_POST['kembalian'];

    // Melakukan query untuk INSERT ke tabel 'penjualan'
    $query = "INSERT INTO penjualan VALUES ('', '$tglPenjualan', '$totalbayar', '$bayar', '$kembali', '$sesID')";
    $result = mysqli_query($koneksi, $query);

    // Mendapatkan ID terakhir yang dihasilkan oleh query INSERT sebelumnya
    $id_penjualan = mysqli_insert_id($koneksi);

    // Melakukan perulangan untuk mengolah data dari 'penampungID' dan 'penampungJumlah'
    foreach ($_POST['IDBarang'] as $key => $idbarang) {
        // Dapatkan jumlahItem dari form atau sesuaikan dengan kebutuhan
        $jumlahItem = $_POST['JumlahBarang'][$key];

        // Melakukan query untuk SELECT data barang
        $ambilID = "SELECT * FROM barang WHERE Barang_ID = $idbarang";
        $hasil = mysqli_query($koneksi, $ambilID);

        $row = $hasil->fetch_assoc();

        $subtotal = $row['HargaJual'] * $jumlahItem;

        // Melakukan query untuk INSERT ke tabel 'detailpenjualan'
        $query2 = "INSERT INTO `detailpenjualan` VALUES ('', '$id_penjualan', '$idbarang', '$jumlahItem', '$subtotal')";
        $result2 = mysqli_query($koneksi, $query2);

        $minStok = $row['Jumlah'] - $jumlahItem;

        $kurangiStok = mysqli_query($koneksi, "UPDATE barang SET Jumlah = '$minStok' WHERE Barang_ID = '$idbarang'");
    }

    echo '<script>window.open("print.php", "_blank"); window.location.href = "index.php";</script>';

    // Redirect setelah selesai mengolah data
    // header('Location: home.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DiJEE Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body class="sb-nav">
    <nav class="sb-topnav navbar navbar-expand maincol">
        <!-- Navbar Brand-->
        <img class="ms-3" src="assets/img/logo dijee.png" alt="" style="width: 40px;">
        <a class="h4 namatoko" href="index.php">Toko DiJEE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 p" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="akun-karyawan.php">Profil</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav_content">
        <main>
            <div class="p-4">
                <form action="proses.php" method="post">
                    <div class="col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header bg-primary text-white">
                                <div class="row">
                                    <div class="col"><h5><i class="fa fa-shopping-cart"></i>CHECK OUT</h5></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="keranjang" class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>Tanggal</b></td>
                                            <td>
                                                <input type="hidden" readonly="readonly" class="form-control bg-secondary bg-opacity-25" value="<?php echo date("Y-m-d");?>" name="tgl">
                                                <?php echo date("j F Y");?>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <td> ID</td>
                                                <td> Nama Barang</td>
                                                <td> Harga</td>
                                                <td style="width:10%;"> Jumlah</td>
                                                <td style="width:20%;"> SubTotal</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                        foreach($ids['id'] as $key => $barangID) {
                                            $sqlSelect = "SELECT * FROM barang WHERE Barang_ID = '$barangID'";
                                            $result = $koneksi->query($sqlSelect);

                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                                $hargaJual = $row['HargaJual'];
                                                $namaBarang = $row['Nama'];
                                                        
                                                // Periksa apakah ada jumlah barang yang sesuai
                                                if (isset($jumlahBarang[$key])) {
                                                    $jumlah = $jumlahBarang[$key];
                                                    $subTotal = $hargaJual * $jumlah;

                                        ?>
                                            <tr>
                                                <td><input type="hidden" name="IDBarang[]" value="<?php echo $barangID; ?>"><?php echo $barangID; ?></td>
                                                <td><?php echo $namaBarang; ?></td>
                                                <td><?php echo $hargaJual; ?></td>
                                                <td><input type="hidden" name="JumlahBarang[]" value="<?php echo $jumlah; ?>"><?php echo $jumlah; ?></td>
                                                <td><?php echo $subTotal; ?></td>
                                            </tr>
                                        <?php
                                                    $total += $subTotal;
                                                }
                                            } else {
                                                echo "Error: " . $koneksi->error;
                                            }
                                        }
                                        $kembalian = intval($pembayaran) - intval($total);
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <table class="table table-bordered w-25">
                                            
                                            <tr>
                                                <td class="col-1"><b>Total</b></td>
                                                <td class="col-5">
                                                    <?php echo "Rp ".number_format($total, 0, ',', '.'); ?>
                                                    <input type="hidden" name="totalbayar" value="<?php echo $total; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-1"><b>Bayar</b></td>
                                                <td class="col-5">
                                                    <?php echo "Rp ".number_format($pembayaran, 0, ',', '.'); ?>
                                                    <input type="hidden" name="pembayaran" value="<?php echo $pembayaran; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-1"><b>Kembali</b></td>
                                                <td class="col-5">
                                                    <?php echo "Rp ".number_format($kembalian, 0, ',', '.'); ?>
                                                    <input type="hidden" name="kembalian" value="<?php echo $kembalian; ?>">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary  float-end" name="proses">Proses</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </main>
    </div>
    <script>
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
