<?php
require("koneksi.php");
session_start();
if(!isset($_SESSION['id'])){
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesID = $_SESSION ['id'];
$sesName = $_SESSION ['name'];
$sesLvl = $_SESSION ['level'];

$ambilIDPenjualanTerakhir = mysqli_query($koneksi, "SELECT MAX(ID_Penjualan) as max_id FROM penjualan;");
$maxID = mysqli_fetch_assoc($ambilIDPenjualanTerakhir);

$IDterakhir = $maxID['max_id'];

?>
<html>
<head>
    <title>nota</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                font-size: 12pt;
            }

            table {
                font-size: 10pt;
            }

            /* Menyembunyikan elemen dengan ID tertentu */
            #tombolSave, #tombolCancel {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <center>
                    <p><?php echo "DIJEE ELEKTRONIK" ?></p>
                    <p><?php echo "Jl.BersamaTidakBersatu" ?></p>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <?php echo "<p>" . date("j F Y, G:i") . "</p>"; ?>
                    <p>Kasir : <?php echo htmlentities($sesName); ?></p>
                </center>
                <table class="table table-bordered" style="width:100%;">
                    <tr>
                        <td>No.</td>
                        <td>Nama Produk</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>SubTotal</td>
                    </tr>
                    <?php
                    // Koneksi ke database (gantilah dengan koneksi sesuai dengan database Anda)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "aplikasidijee";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi ke database gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan data penjualan
                    $query = "SELECT dp.ID_detailPenjualan, b.Nama, b.HargaJual, dp.Jumlah, dp.subTotal
                                FROM detailpenjualan dp
                                JOIN barang b ON dp.Barang_ID = b.Barang_ID
                                WHERE ID_Penjualan = '$IDterakhir'";
                    $result = $koneksi->query($query);

                    if ($result === false) {
                        // Query execution failed
                        die("Error executing query: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        $no = 1;

                        // Tampilkan data penjualan dalam bentuk tabel
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['Nama'] . "</td>";
                            echo "<td>" . $row['HargaJual'] . "</td>";
                            echo "<td>" . $row['Jumlah'] . "</td>";
                            echo "<td>" . $row['subTotal'] . "</td>";
                            echo "</tr>";

                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data penjualan</td></tr>";
                    }

                    ?>
                </table>
                <?php
                // Query untuk mendapatkan data pembayaran dan kembalian
                $query_pembayaran = "SELECT total, pembayaran, uangKembalian FROM penjualan WHERE ID_penjualan = '$IDterakhir'";
                $result_pembayaran = $conn->query($query_pembayaran);

                if ($result_pembayaran === false) {
                    // Query execution failed
                    die("Error executing query: " . $conn->error);
                }

                if ($result_pembayaran->num_rows > 0) {
                    $row_pembayaran = $result_pembayaran->fetch_assoc();
                    $total = $row_pembayaran['total'];
                    $pembayaran = $row_pembayaran['pembayaran'];
                    $kembalian = $row_pembayaran['uangKembalian'];

                    echo '<div class="pull-right">';
                    echo 'Total : Rp.' . number_format($total) . ',<br />';
                    echo 'Bayar : Rp.' . number_format($pembayaran) . ',<br />';
                    echo 'Kembali : Rp.' . number_format($kembalian) . ',';
                    echo '</div>';
                }
                ?>
                <div class="clearfix"></div>
                <center>
                    <p>Terima Kasih Telah berbelanja di toko kami !</p>
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>