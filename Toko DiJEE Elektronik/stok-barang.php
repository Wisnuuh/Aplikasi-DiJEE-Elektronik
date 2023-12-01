<?php

require("koneksi.php");
require("functions.php");
// $email = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : "";

session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesID = $_SESSION['id'];
$sesName = $_SESSION['name'];
$sesLvl = $_SESSION['level'];


$kategories = tampil_kategori("SELECT * FROM kategori");
$suppliers = tampil_kategori("SELECT * FROM supplier");
$barangs = tampil_barang("SELECT Barang_ID, barang.Kategori_ID, barang.ID_Supplier ,barang.Nama as 'barang', Jumlah, Garansi, HargaBeli, HargaJual, kategori.Nama as 'kategori', supplier.Nama_Supplier as 'supplier'
FROM barang JOIN supplier ON supplier.ID_Supplier = barang.ID_Supplier JOIN kategori ON kategori.Kategori_ID = barang.Kategori_ID");

if (isset($_POST['tambah'])) {
    // Ambil nilai dari form
    $tgl_input = $_POST["tgl_input"];
    $nama_barang = $_POST["nama_barang"];
    $harga_beli = $_POST["harga_beli"];
    $harga_jual = $_POST["harga_jual"];
    $id_kategori = $_POST["pilihKategori"];
    $stok = $_POST["stok"];
    $garansi = $_POST["garansi"];
    $id_supplier = $_POST["pilihSupplier"];
    $totalBayar = $_POST["totalBayar"];
    // var_dump($_POST);

    // Insert data kedalam barang
    $inputBarang = mysqli_query($koneksi,
    "INSERT INTO barang VALUES 
    ('', '$nama_barang', '$stok', '$garansi', '$harga_beli', '$harga_jual', '$id_kategori', '$id_supplier');"
    );

    // Mengambil ID Barang yang baru diinputkan
    $IDterbaru = mysqli_insert_id($koneksi);

    // Menampung ID yang baru diinputkan
    $IDbarangTerbaru = $IDterbaru;

    // Menyimpan pembelian ke database
    $inputPembelian = mysqli_query($koneksi, "INSERT INTO pembelian VALUES ('', '$tgl_input','$totalBayar')");

    // Mengambil ID Barang yang baru diinputkan dari tabel pembelian
    $IDterbaru = mysqli_insert_id($koneksi);

    // Menampung ID pembelian yang baru diinputkan
    $IDpembelianTerbaru = $IDterbaru;

    // Melakukan query untuk SELECT hargajual barang
    $hasil = mysqli_query($koneksi, "SELECT * FROM barang WHERE Barang_ID = $IDbarangTerbaru;");
    $hargaBeli = $hasil->fetch_assoc();
    $subtotalHargaBeli = $hargaBeli['HargaBeli'] * $stok;

    $inputDetailPembelian = mysqli_query($koneksi,
    "INSERT INTO detailpembelian VALUES
    ('', '$IDbarangTerbaru', '$IDpembelianTerbaru', '$stok', '$subtotalHargaBeli');"
    );
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Barang | DiJEE Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Memanggil navbar -->
    <?php require_once "navbar.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Stok Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Stok Barang</li>
                    </ol>
                </div>
                <!-- Inputan Barang -->
                <div class="container">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-box"></i>
                                Tambah Barang
                            </div>
                            <div class="card-body py-4">
                            <form method="POST" name="tambah" class="px-4">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal Inputtan Barang :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo date("j F Y"); ?>" readonly>
                                        <input type="hidden" class="form-control form-control-sm" name="tgl_input" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="text" class="form-control form-control-sm" name="nama_barang">
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Jumlah Stok :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="number" class="form-control form-control-sm" name="stok">
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Garansi :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="text" class="form-control form-control-sm" name="garansi">
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga Beli :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="number" class="form-control form-control-sm" name="harga_beli">
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga Jual :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="number" class="form-control form-control-sm" name="harga_jual">
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kategori :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <select class="form-select" name="pilihKategori">
                                            <option selected disabled>Pilih Kategori</option>
                                            <?php
                                            // Kode untuk mengambil data supplier dari database
                                            $koneksi = mysqli_connect($server, $username, $password, $db);
                                            // Query untuk mengambil data supplier
                                            $query = "SELECT Kategori_ID, Nama FROM kategori";
                                            $result = mysqli_query($koneksi, $query);

                                            // Loop untuk membangun opsi dari hasil query
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Kategori_ID'] . "'>" . $row['Nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Supplier :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <select class="form-select" name="pilihSupplier">
                                            <option selected disabled>Pilih Supplier</option>
                                            <?php
                                            // Kode untuk mengambil data supplier dari database
                                            $koneksi = mysqli_connect($server, $username, $password, $db);
                                            // Query untuk mengambil data supplier
                                            $query = "SELECT id_supplier, nama_supplier FROM supplier";
                                            $result = mysqli_query($koneksi, $query);

                                            // Loop untuk membangun opsi dari hasil query
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id_supplier'] . "'>" . $row['nama_supplier'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- <label class="col-sm-4 col-form-label col-form-label-sm"><b>Total Bayar :</b></label>
                                    <div class="col-sm-8 mb-2">
                                        <input type="number" class="form-control form-control-sm" name="totalBayar">
                                    </div> -->
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" name="tambah">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Data Stok Barang
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                tambah barang
                            </button>
                            </div>
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Kategori</th>
                                            <th>Supplier</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>Garansi</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT Barang_ID, barang.Nama as 'barang', Jumlah, Garansi, HargaBeli, HargaJual, kategori.Nama as 'kategori', supplier.Nama_Supplier as 'supplier' FROM barang JOIN supplier ON supplier.ID_Supplier = barang.ID_Supplier JOIN kategori ON kategori.Kategori_ID = barang.Kategori_ID";
                                        $result = mysqli_query($koneksi, $query);
                                        $no = 1;

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                            echo     "<td>" . $no . "</td>";
                                            echo     "<td>" . $row['Barang_ID'] . "</td>";
                                            echo     "<td>" . $row['kategori'] . "</td>";
                                            echo     "<td>" . $row['supplier'] . "</td>";
                                            echo     "<td>" . $row['barang'] . "</td>";
                                            echo     "<td>" . $row['Jumlah'] . "</td>";
                                            echo     "<td>" . $row['Garansi'] . "</td>";
                                            echo     "<td>" . $row['HargaBeli'] . "</td>";
                                            echo     "<td>" . $row['HargaJual'] . "</td>";
                                            echo     "<td>";
                                            echo         '<ul class="list-inline">';
                                            echo             '<li class="list-inline-item">';
                                            echo            '<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit' . $row['Barang_ID'] . '">edit</button>';

                                            echo             '</li>';
                                            echo             '<li class="list-inline-item">';
                                            echo                 '<button class="btn btn-md btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#hapus' . $row['Barang_ID'] . '">hapus</button>';
                                            echo             '</li>';
                                            echo         '</ul>';
                                            echo     "</td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <!-- <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div> -->
                </div>
            </footer>
        </div>
    </div>

    <!-- modal tambah barang -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">nama barang</label>
                            <input type="name" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="garansi" class="form-label">garansi</label>
                            <input type="text" name="garansi" class="form-control" id="garansi" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">harga beli</label>
                            <input type="number" name="harga_beli" class="form-control" id="harga_beli" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">harga jual</label>
                            <input type="number" name="harga_jual" class="form-control" id="harga_jual" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Pilih kategori:</label>
                            <select name="kategori" id="kategori" required>
                                <option>Pilih kategori</option>
                                <?php foreach ($kategories as $kategori) : ?>
                                    <option value="<?= $kategori["Kategori_ID"] ?>"><?= $kategori["Nama"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="supplier">Pilih supplier:</label>
                            <select name="supplier" id="supplier" required>
                                <option>Pilih kategori</option>
                                <?php foreach ($suppliers as $supplier) : ?>
                                    <option value="<?= $supplier["ID_Supplier"] ?>"><?= $supplier["Nama_Supplier"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal update -->
    <?php foreach ($barangs as $barang) : ?>
        <div class="modal fade" id="edit<?= $barang['Barang_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="ID" value="<?= $barang['Barang_ID'] ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">nama barang</label>
                                <input type="name" name="nama" class="form-control" id="nama" value="<?= $barang['barang'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?= $barang['Jumlah'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="garansi" class="form-label">garansi</label>
                                <input type="text" name="garansi" class="form-control" id="garansi" value="<?= $barang['Garansi']  ?>" >
                            </div>
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">harga beli</label>
                                <input type="number" name="harga_beli" class="form-control" id="harga_beli" value="<?= $barang['HargaBeli']  ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_jual" class="form-label">harga jual</label>
                                <input type="number" name="harga_jual" class="form-control" id="harga_jual" value="<?= $barang['HargaJual'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Pilih kategori:</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <?php foreach ($kategories as $kategori) : ?>
                                        <?php if ($kategori["Kategori_ID"] === $barang['Kategori_ID']) : ?>
                                            <option selected value="<?= $kategori["Kategori_ID"] ?>"><?= $barang['kategori'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $kategori["Kategori_ID"] ?>"><?= $kategori["Nama"] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Pilih supplier:</label>
                                <select name="supplier" id="supplier" class="form-control" required>
                                    <?php foreach ($suppliers as $supplier) : ?>
                                        <?php if ($supplier["ID_Supplier"] === $barang['ID_Supplier']) : ?>
                                            <option selected value="<?= $supplier["ID_Supplier"] ?>"><?= $barang['supplier'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $supplier["ID_Supplier"] ?>"><?= $supplier["Nama_Supplier"] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($barangs as $barang) : ?>
        <div class="modal fade zoomIn" id="hapus<?= $barang['Barang_ID'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Anda Yakin ?</h4>
                                <p class="text-muted mx-4 mb-0">Anda Yakin Mau Menghapus Data Ini ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Batal</button>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" value="<?= $barang['Barang_ID'] ?>" name="id">
                                <button type="submit" name="hapus_barang" class="btn w-sm btn-danger">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>


<?php


// tambah barang
if (isset($_POST["submit"])) {
    if (tambahBarang($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan'
                }).then(function (){
                    document.location.href = 'stok-barang.php';
                });
            </script>
        ";
    } else {
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data gagal ditambahkan'
            }).then(function (){
                document.location.href = 'stok-barang.php';
            });
            </script>
        ";
    }
}



// edit barang
if (isset($_POST["edit"])) {
    // var_dump($_POST);
    if (edit_barang($_POST)) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diupdate'
                }).then(function (){
                    document.location.href = 'stok-barang.php';
                });
            </script>
        ";
    } else {
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data gagal diupdate'
            }).then(function (){
                document.location.href = 'stok-barang.php';
            });
            </script>
        ";
    }
}

// hapus data barang
if (isset($_POST["hapus_barang"])) {
    $id = $_POST["id"];
    if (hapusBarang($id) > 0) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data barang berhasil dihapus'
        }).then(function () {
            document.location.href = 'stok-barang.php';
        });
        </script> 
    ";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'data barang gagal di hapus!'
        }).then(function () {
            document.location.href = 'stok-barang.php'; 
        });
        </script>
    ";
    }
}


?>