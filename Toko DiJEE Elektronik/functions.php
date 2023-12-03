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

    // Menggunakan str_pad untuk memastikan panjang angka tetap 5 digit
    $tgl_input = $data["tgl_input"];
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $garansi = $data["garansi"];
    $harga_beli = $data["harga_beli"];
    $harga_jual = $data["harga_jual"];
    $kategori = $data["kategori"];
    $supplier = $data["supplier"];

    $query = "INSERT INTO `barang` VALUES 
    ('','$nama','$jumlah','$garansi','$harga_beli','$harga_jual','$kategori','$supplier')";

    mysqli_query($koneksi, $query);

    // Mengambil ID Barang yang baru diinputkan
    $IDterbaru = mysqli_insert_id($koneksi);

    // Menampung ID yang baru diinputkan
    $IDbarangTerbaru = $IDterbaru;

    // Melakukan query untuk SELECT hargajual barang
    $hasil = mysqli_query($koneksi, "SELECT * FROM barang WHERE Barang_ID = $IDbarangTerbaru;");
    $hargaBeli = $hasil->fetch_assoc();
    $totalBayar = $hargaBeli['HargaBeli'] * $jumlah;
    
    // Menyimpan pembelian ke database
    $inputPembelian = mysqli_query($koneksi, "INSERT INTO pembelian VALUES ('', '$tgl_input','$totalBayar')");

    // Mengambil ID Barang yang baru diinputkan dari tabel pembelian
    $IDterbaru = mysqli_insert_id($koneksi);

    // Menampung ID pembelian yang baru diinputkan
    $IDpembelianTerbaru = $IDterbaru;

    // Menyimpan detail pembelian ke database
    $inputDetailPembelian = mysqli_query($koneksi,
    "INSERT INTO detailpembelian VALUES
    ('', '$IDbarangTerbaru', '$IDpembelianTerbaru', '$jumlah', '$totalBayar');"
    );

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

// edit barang
function edit_barang($data)
{
    global $koneksi;

    $idbarang = $data["ID"];
    $tgl_input = $data["tgl_input"];
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $tambahStok = $data['tambahstok'];
    $garansi = $data["garansi"];
    $harga_beli = $data["harga_beli"];
    $harga_jual = $data["harga_jual"];
    $kategori = $data["kategori"];
    $supplier = $data["supplier"];

    if ($tambahStok > 0) {

        // Ambil jumlah terakhir
        $ambilStok = mysqli_query($koneksi, "SELECT * FROM barang WHERE Barang_ID = '$idbarang'");
        $row = $ambilStok->fetch_assoc();

        // tambah stok
        $tambahJumlah = $row['Jumlah'];
        $inputTotal = $row['HargaBeli'] * $tambahStok;
        
        // eksekusi query
        $inputstok = mysqli_query($koneksi, "UPDATE barang SET Jumlah = '$tambahJumlah + $tambahStok' WHERE Barang_ID = '$idbarang';");

        // input tabel pembelian
        $inputpembelian = mysqli_query($koneksi, "INSERT INTO pembelian VALUES ('', '$tgl_input', '$inputTotal');");

        // Mengambil ID Barang yang baru diinputkan
        $IDterbaru = mysqli_insert_id($koneksi);

        // input tabel detail pembelian
        $inputdetailpembelian = mysqli_query($koneksi, "INSERT INTO detailpembelian VALUES ('', '$idbarang', '$IDterbaru', '$tambahStok', '$inputTotal');");

    } else {

        $query = "UPDATE `barang` SET `Nama`='$nama',`Jumlah`='$jumlah',`Garansi`='$garansi',`HargaBeli`='$harga_beli',`HargaJual`='$harga_jual',`Kategori_ID`='$kategori',`ID_Supplier`='$supplier' WHERE Barang_ID = '$idbarang'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die('Error' . mysqli_error($koneksi));
        }
    }

    return mysqli_affected_rows($koneksi);
}

// hapus barang
function hapusBarang($id)
{
    global $koneksi;

    $query = "DELETE FROM `barang` WHERE Barang_ID = '$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambahSupplier($data) {

    global $koneksi;

    $nama = $data['namaSupp'];
    $alamat = $data['alamatSupp'];
    $noHP = $data['noSupp'];

    $query = "INSERT INTO supplier VALUES ('', '$nama', '$alamat', '$noHP');";
    $result = mysqli_query($koneksi, $query);

}

function edit_supplier($data) {

    global $koneksi;

    $idSupplier = $data["ID"];
    $namaSuppllier = $data["nama"];
    $alamatSuppllier = $data["alamat"];
    $noHP = $data["nomorTelfon"];
    
    $result = mysqli_query($koneksi, "UPDATE supplier SET Nama_Supplier = '$namaSuppllier', Alamat = '$alamatSuppllier', No_Telp = '$noHP' WHERE ID_Supplier = '$idSupplier' ");
}

// hapus barang
function hapusSupplier($id)
{
    global $koneksi;

    $query = "DELETE FROM `supplier` WHERE ID_Supplier = '$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}