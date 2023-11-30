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


function tampil_kategori($query)
{
    global $koneksi;

    // data ditampung
    $result = mysqli_query($koneksi, $query);

    $kategories = [];
    while ($kategori = mysqli_fetch_assoc($result)) {
        $kategories[] = $kategori;
    }
    return $kategories;
}

function tambahKategori($data)
{
    global $koneksi;

    // Menghasilkan angka acak 5 digit
    $random_number = mt_rand(0, 99999);

    // Menggunakan str_pad untuk memastikan panjang angka tetap 5 digit
    $id = str_pad($random_number, 5, '0', STR_PAD_LEFT);
    $nama = $data["kategori"];
    $deskripsi = $data["deskripsi"];

    $query = "INSERT INTO `kategori`(`Kategori_ID`, `Nama`, `Deskripsi`) VALUES 
    ('$id','$nama','$deskripsi')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function edit_kategori($data)
{
    global $koneksi;

    $id = $data["ID"];
    $nama = $data["kategori"];
    $deskripsi = $data["deskripsi"];

    $query = "UPDATE `kategori` SET `Nama`='$nama',`Deskripsi`='$deskripsi' WHERE Kategori_ID = $id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error' . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}

function hapusKategori($id)
{
    global $koneksi;

    $query = "DELETE FROM `kategori` WHERE Kategori_ID = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tampil_supplier($query)
{
    global $koneksi;

    // data ditampung
    $result = mysqli_query($koneksi, $query);

    $suppliers = [];
    while ($supplier = mysqli_fetch_assoc($result)) {
        $suppliers[] = $supplier;
    }
    return $suppliers;
}

function tambahBarang($data)
{
    global $koneksi;

    // Menghasilkan angka acak 5 digit
    $random_number = mt_rand(0, 99999);

    // Menggunakan str_pad untuk memastikan panjang angka tetap 5 digit
    $id = str_pad($random_number, 5, '0', STR_PAD_LEFT);
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $garansi = $data["garansi"];
    $harga_beli = $data["harga_beli"];
    $harga_jual = $data["harga_jual"];
    $kategori = $data["kategori"];
    $supplier = $data["supplier"];

    $query = "INSERT INTO `barang`(`Barang_ID`, `Nama`, `Jumlah`, `Garansi`, `HargaBeli`, `HargaJual`, `Kategori_ID`, `ID_Supplier`) VALUES 
    ('$id','$nama','$jumlah','$garansi','$harga_beli','$harga_jual','$kategori','$supplier')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tampil_barang($query)
{
    global $koneksi;

    // data ditampung
    $result = mysqli_query($koneksi, $query);

    $barangs = [];
    //masukkan satu per satu record $barangs
    while ($barang = mysqli_fetch_assoc($result)) {
        $barangs[] = $barang;
    }
    return $barangs;
}

// edit karyawan
function edit_barang($data)
{
    global $koneksi;

    $idbarang = $data["ID"];
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $garansi = $data["garansi"];
    $harga_beli = $data["harga_beli"];
    $harga_jual = $data["harga_jual"];
    $kategori = $data["kategori"];
    $supplier = $data["supplier"];

    $query = "UPDATE `barang` SET `Nama`='$nama',`Jumlah`='$jumlah',`Garansi`='$garansi',`HargaBeli`='$harga_beli',`HargaJual`='$harga_jual',`Kategori_ID`='$kategori',`ID_Supplier`='$supplier' WHERE Barang_ID = '$idbarang'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error' . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}

// hapus karyawan
function hapusBarang($id)
{
    global $koneksi;

    $query = "DELETE FROM `barang` WHERE Barang_ID = '$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ambil_data($query)
{

    global $koneksi;

    $db = [];
    $sql_query = mysqli_query($koneksi, $query);

    while ($q = mysqli_fetch_assoc($sql_query)) {

        array_push($db, $q);
    }

    return $db;
}

function tambah_data_pesanan()
{

    global $koneksi;

    // Nama Pelanggan
    // $pelanggan = htmlspecialchars($_POST["pelanggan"]);

    // Mengambil Data Qty dan Kode Menu
    $list_pesanan = [];

    $max_menu = count(ambil_data("SELECT * FROM barang"));

    for ($i = 1; $i <= $max_menu; $i++) {

        if ((int) $_POST["qty$i"] != 0) {

            array_push($list_pesanan, [

                "kode_menu" => $_POST["kode_menu$i"],
                "qty" => (int) $_POST["qty$i"]
            ]);
        }
    }

    // Cek Jika Memesan Tapi Kosong
    if (count($list_pesanan) == 0) {
        echo "<script>
            alert('Anda belum memesan menu!');
        </script>";
        return -1;
    }

    global $sesID; // $sesID belum didefinisikan dalam potongan kode yang diberikan

    // Tambah Data Transaksi
    mysqli_query(
        $koneksi,
        "INSERT INTO penjualan
                            VALUES ('', NOW(), 0, 0, NULL, 2);"

    );

    $ambilIdPenjualan = mysqli_insert_id($koneksi);

    // Tambah Data Pesanan
    foreach ($list_pesanan as $lp) {

        $kode_menu = $lp["kode_menu"];
        $qty = $lp["qty"];

        mysqli_query($koneksi, "INSERT INTO detailpenjualan
                                VALUES ('', $ambilIdPenjualan, '$kode_menu', '', 0, $qty, 0);

        ");
    }

    return mysqli_affected_rows($koneksi);
}
