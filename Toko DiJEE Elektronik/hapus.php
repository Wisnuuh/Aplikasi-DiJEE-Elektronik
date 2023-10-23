<?php

    require ('koneksi.php');

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }

    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM user_detail WHERE id='$id'") or die (mysqli_error($koneksi));

    header("location: home.php");

?>