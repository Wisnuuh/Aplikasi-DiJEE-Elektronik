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

$koneksi = mysqli_connect($server, $username, $password, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil nilai pencarian dari parameter GET
$cari = $_GET['cari'];

// Query pencarian ke database (sesuaikan dengan struktur tabel Anda)
$query = "SELECT * FROM barang WHERE Nama LIKE '%$cari%' OR Barang_ID LIKE '%$cari%'";
$resultcari = mysqli_query($koneksi, $query);

// Tampilkan hasil pencarian
echo "<table style='border-collapse: collapse; width: 100%;'>";
while ($row = mysqli_fetch_assoc($resultcari)) {
    echo "<tr style='border-bottom: 1px solid #000;'>";
    echo "<td style='padding: 5px;'><input type='hidden' value='".$row['Barang_ID']."'><strong>ID Barang</strong><br> " . $row['Barang_ID'] . "</td>";
    echo "<td style='padding: 5px;'><strong>Harga_Jual</strong><br> " . $row['HargaJual'] . "</td>";
    echo "<td style='padding: 5px;'><strong>Nama Barang</strong><br>" . $row['Nama'] . "</td>";
    echo "<td style='padding: 5px;'><strong>Garansi</strong><br>" . $row['Garansi'] . "</td>";

    // Tambahkan tombol pada setiap baris dengan aksi JavaScript
    echo "<td style='padding: 5px;'><button class='btn btn-primary' onclick='pilihBarang(\"" . $row['Barang_ID'] . "\", \"" . $row['Nama'] . "\", \"" . $row['HargaJual'] . "\", \"" . $row['HargaJual'] . "\")'>Pilih</button></td>";

    echo "</tr>";
}
echo "</table>";
// Tutup koneksi ke database
mysqli_close($koneksi);