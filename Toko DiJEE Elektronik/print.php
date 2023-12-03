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

$tanggal = mysqli_query($koneksi, "SELECT date_format(Tgl_Penjualan, '%d %M %Y') as formatted_date FROM penjualan where id_penjualan = $IDterakhir");
$ambil_tgl = $tanggal->fetch_assoc();

// Menampilkan kasir yang bertugas pada transaksi
$kasir = mysqli_query($koneksi, "SELECT penjualan.User_ID, user.Nama FROM penjualan JOIN user ON penjualan.User_ID = user.User_ID WHERE ID_Penjualan = '$IDterakhir'");
$ambilKasir = $kasir->fetch_assoc();
$namaKasir = $ambilKasir['Nama'];

?>
<html>
<head>
    <title>nota</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles2.css">
</head>

<body id="ukurannota">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <center>
                    <p><?php echo "DIJEE ELETRONIK" ?></p>
                    <p><?php echo "Jl. Ambulu, Purwojari, Dukuh Dempok, Kec. Wuluhan" ?></p>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <p><?php echo  $ambil_tgl['formatted_date']; ?></p>
                    <p>Kasir : <?php echo htmlentities($namaKasir); ?></p>
                </center>
                <table class="tabel" class="table table-bordered" style="width:100%;">
                    <tr class="trBold">
                        <th class="tabel">No.</th>
                        <th class="tabel">Nama Produk</th>
                        <th class="tabel">Harga</td>
                        <th class="tabel">Jumlah</th>
                        <th class="tabel">SubTotal</th>
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
                            echo "<td class='tabel'>" . $no . "</td>";
                            echo "<td class='tabel'>" . $row['Nama'] . "</td>";
                            echo "<td class='tabel harga'> Rp" . number_format($row['HargaJual']) . "</td>";
                            echo "<td class='tabel' style='text-align: center;'>" . $row['Jumlah'] . "</td>";
                            echo "<td class='tabel harga'> Rp" . number_format($row['subTotal']) . "</td>";
                            echo "</tr>";

                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data penjualan</td></tr>";
                    }

                    ?>
                    <?php
                    // Query untuk mendapatkan data pembayaran dan kembalian
                    $query_pembayaran = "SELECT total, pembayaran, uangKembalian FROM penjualan WHERE ID_penjualan = '$IDterakhir'";
                    $result_pembayaran = $conn->query("SELECT total, pembayaran, uangKembalian FROM penjualan WHERE ID_penjualan = '$IDterakhir'");

                    if ($result_pembayaran->num_rows > 0) {
                        $row_pembayaran = $result_pembayaran->fetch_assoc();
                        $total = $row_pembayaran['total'];
                        $pembayaran = $row_pembayaran['pembayaran'];
                        $kembalian = $row_pembayaran['uangKembalian'];

                        ?>
                        <tr>
                            <th colspan="4" class='tabel '>Total</th>
                            <td class='tabel harga'><?php echo 'Rp' . number_format($total); ?></td>
                        </tr>
                        <tr>
                            <th colspan="4" class='tabel '>Bayar</th>
                            <td class='tabel harga'><?php echo 'Rp' . number_format($pembayaran); ?></td>
                        </tr>
                        <tr>
                            <th colspan="4" class='tabel '>Kembali</th>
                            <td class='tabel harga'><?php echo 'Rp' . number_format($kembalian) ; ?></td>
                        </tr>
                    </table>

                    <?php
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
    <script>
        window.print();
    </script>
</body>
</body>

</html>