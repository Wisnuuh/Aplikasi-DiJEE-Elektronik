<?php

    require_once "functions.php";
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

    $menu = ambil_data("SELECT * FROM detailpenjualan");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table table-bordered table-hover" style="margin-top: 100px;">

<tr class="text-bg-success">
    <th>No</th>
    <th>Kode Pesanan</th>
    <th>Nama Pelanggan</th>
    <th>Waktu</th>
    <th>Total Harga</th>
    <th>Pembayaran</th>
    <th>Cetak</th>
</tr>
<?php   

$i = 1;
foreach ($menu as $m) {
    $kode_pesanan = $m["ID_detailPenjualan"];
    $total_pembayaran = ambil_data("SELECT * FROM detailpenjualan"
                                    );
?>

    <form action="cetak/cetak.php" target="_blank" method="GET">

        <input type="hidden" name="ID_detailPenjualan" value="<?= $m["ID_detailPenjualan"]; ?>">

        <tr style="background-color: white;">

            <td><?= $i; ?></td>

            <td><?= $m["ID_detailPenjualan"]; ?></td>

            <td><?= $m["nama_Barang"]; ?></td>

            <td><?= $m["subTotal"]; ?></td>
            <td>
                <!-- <?php
                $total = 0;
                foreach ($total_pembayaran as $tp) {
                    $total += $tp["qty"] * $tp["harga"];
                }
                echo "Rp." . $total;
                ?> -->
            </td>
            <td><input name="pembayaran" min="0" type="number"></td>
            <td>

                <button class="btn btn-primary">Cetak</button>

                <!-- <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $m["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">Hapus</a> -->

            </td>

        </tr>

    </form>
<?php $i++;
} ?>

</table>
</body>
</html>