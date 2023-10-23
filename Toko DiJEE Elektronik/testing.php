<?php

    require ('koneksi.php');

    $id = $_GET['id'];

    foreach($id as $i) {

        echo $i;
    }

?>