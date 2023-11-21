<?php
require("koneksi.php");

$koneksi = mysqli_connect($server, $username, $password, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil nilai ID barang dari parameter GET
$barangID = $_GET['Barang_ID'];

// Lakukan proses transaksi di sini menggunakan $barangID
// Ambil nilai dari parameter GET
$barangID = $_GET['barang_id'];
$jumlah = $_GET['jumlah']; // Sesuaikan dengan cara Anda mengirimkan jumlah

// Query untuk mendapatkan informasi barang berdasarkan ID
$queryBarang = "SELECT * FROM barang WHERE Barang_ID = '$barangID'";
$resultBarang = mysqli_query($koneksi, $queryBarang);

// Ambil data barang
$rowBarang = mysqli_fetch_assoc($resultBarang);
$hargaBarang = $rowBarang['HargaJual'];

// Hitung total
$total = $jumlah * $hargaBarang;

// Query untuk memasukkan nilai ke dalam tabel transaksi
$queryInsert = "INSERT INTO transaksi (id_barang, jumlah, total) VALUES ('$barangID', '$jumlah', '$total')";
$resultInsert = mysqli_query($koneksi, $queryInsert);

// Cek apakah query insert berhasil
if ($resultInsert) {
    echo "Transaksi berhasil!";
} else {
    echo "Transaksi gagal: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
