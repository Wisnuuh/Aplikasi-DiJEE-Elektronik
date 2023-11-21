<?php
require_once "koneksi.php";

// Ambil nilai integer dari kolom dalam database
// $sqlSelect = "SELECT HargaJual FROM barang WHERE Barang_ID = 18";
// $result = $koneksi->query($sqlSelect);

// $row = $result->fetch_assoc();

// $total = $row['HargaJual'];

// echo "Rp" . $total . "<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari POST request
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];
    $jumlahBarang = isset($_POST['jumlahBarang']) ? $_POST['jumlahBarang'] : [];
    $total = isset($_POST['total']) ? $_POST['total'] : 0;
    $pembayaran = isset($_POST['bayar']) ? $_POST['bayar'] : 0;
    $kembalian = isset($_POST['kembalian']) ? $_POST['kembalian'] : 0;

    // Lakukan sesuatu dengan IDs dan jumlah barang
    $response = "IDs yang diterima: " . print_r($ids, true) . "<br>";
    
    $response2 = "Jumlah Barang yang diterima: " . print_r($jumlahBarang, true) . "<br>";

    // Echo total, pembayaran, dan kembalian setelah variabel dari POST request
    echo $response;
    echo $response2;
    echo $total;
    echo "<br>".$pembayaran;
    echo "<br>".$kembalian;

    $barangID = $ids["id"][0];
    echo "<br>".$jumlahBarang[0];

    $sqlSelect = "SELECT HargaJual FROM barang WHERE Barang_ID = '$barangID'";
    $result = $koneksi->query($sqlSelect);

    $row = $result->fetch_assoc();

    $hargaBarID1 = $row['HargaJual'];
    echo "<br>".$hargaBarID1;

    $subtotal = $hargaBarID1 * $jumlahBarang[0];

    echo "<br>".$subtotal;

    // mengambil jumlah dari setiap barang lalu di jumlahkan
    
} else {
    // Jika bukan request POST, kirim pesan error
    echo "Error: Metode request harus POST";
}
?>