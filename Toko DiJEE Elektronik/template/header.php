<!-- By : Adgrafika -->
<!-- Di Larang Memperjual Source Code ini -->
<?php
include "koneksi.php";
session_start();
	if($_SESSION['status']!="login"){
		header("location:login.php");
	}
  function ribuan ($nilai){
    return number_format ($nilai, 0, ',', '.');
}
// $result1 = mysqli_query($conn, "SELECT * FROM login");
// while($data = mysqli_fetch_array($result1))
// {
//     $user = $data['username'];
//     $id = $data['id_login'];
//     $toko = $data['nama_toko'];
//     $alamat = $data['alamat'];
//     $telp = $data['telepon'];
// }
?>