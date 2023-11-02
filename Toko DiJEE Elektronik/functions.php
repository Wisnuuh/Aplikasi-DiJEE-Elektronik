<?php
require("koneksi.php");
function tampil_karyawan($query)
{
    global $koneksi;

    // data ditampung
    $result = mysqli_query($koneksi, $query);

    $karyawans = [];
    //masukkan satu per satu record $karyawans
    while ($karyawan = mysqli_fetch_assoc($result)) {
        $karyawans[] = $karyawan;
    }
    return $karyawans;
}

function tampil_jenisKaryawan($query)
{
    global $koneksi;

    // data ditampung
    $result = mysqli_query($koneksi, $query);

    $jenisKaryawans = [];
    //masukkan satu per satu record $jenisKaryawans
    while ($jenisKaryawan = mysqli_fetch_assoc($result)) {
        $jenisKaryawans[] = $jenisKaryawan;
    }
    return $jenisKaryawans;
}

function tambahKaryawan($data)
{
    global $koneksi;

    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $divisi_user = $data["divisi_user"];
    $username = $data["username1"];
    $password = $data["password2"];

    $query = "INSERT INTO `user`(`User_ID`, `Nama`, `Alamat`, `Nomor_HP`, `JenisUser_ID`, `username`, `password`)
    VALUES ('','$nama','$alamat','$no_hp','$divisi_user','$username','$password')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// edit karyawan
function editKaryawan($data)
{
    global $koneksi;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $divisi_user = $data["divisi_user"];
    $username = $data["username1"];
    $password = $data["password2"];

    $query = "UPDATE `user` SET `Nama`='$nama',
    `Alamat`='$alamat',`Nomor_HP`='$no_hp',`JenisUser_ID`='$divisi_user',`username`='$username',`password`='$password' WHERE `User_ID`='$id_user' ";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error' . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}


// hapus karyawan
function hapuskaryawan($id)
{
    global $koneksi;

    $query = "DELETE FROM `user` WHERE `User_ID` = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}