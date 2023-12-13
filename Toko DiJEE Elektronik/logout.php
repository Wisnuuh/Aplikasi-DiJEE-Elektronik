<?php 

    require_once "koneksi.php";
    session_start();
    date_default_timezone_set('Asia/Jakarta');

    $sesID = $_SESSION['id'];
    $tanggalRiwayat = date("Y-m-d H:i:s");
    $insertRiwayat = "INSERT INTO riwayataktivitas VALUES ('', '$sesID', '$tanggalRiwayat', 'Logout')";
    $insertQuery = mysqli_query($koneksi, $insertRiwayat);

    if (session_destroy()) {
        
        header("Location: index.php");
    }

?>