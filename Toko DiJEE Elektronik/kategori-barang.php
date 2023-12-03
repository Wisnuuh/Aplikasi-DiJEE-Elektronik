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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kategori Barang | DiJEE Elektronik</title>
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
                    <h1 class="mt-4">Data Kategori Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kategori Barang</li>
                    </ol>
                </div>
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Data Kategori Barang
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                Tambah Kategori
                            </button>
                            </div>
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($kategories as $kategori) : ?>
                                        <tr>
                                            <td><?= $kategori["Kategori_ID"] ?></td>
                                            <td><?= $kategori["Nama"] ?></td>
                                            <td><?= $kategori["Deskripsi"] ?></td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $kategori['Kategori_ID'] ?>">edit</button>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <button class="btn btn-md btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#hapus<?= $kategori['Kategori_ID'] ?>">hapus</button>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Nama Kategori:</label>
                            <input type="name" name="kategori" class="form-control" id="kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi:</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi" required>
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
    <?php foreach ($kategories as $kategori) : ?>
        <div class="modal fade" id="edit<?= $kategori["Kategori_ID"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="ID" value="<?= $kategori["Kategori_ID"] ?>">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Nama Kategori:</label>
                                <input type="name" name="kategori" class="form-control" id="kategori" value="<?= $kategori["Nama"] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="<?= $kategori["Deskripsi"] ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit_kategori" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($kategories as $kategori) : ?>
        <div class="modal fade zoomIn" id="hapus<?= $kategori["Kategori_ID"] ?>" tabindex="-1" aria-hidden="true">
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
                                <input type="hidden" value="<?= $kategori["Kategori_ID"] ?>" name="id">
                                <button type="submit" name="hapus_kategori" class="btn w-sm btn-danger">Ya, Hapus!</button>
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
    if (tambahKategori($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan'
                }).then(function (){
                    document.location.href = 'kategori-barang.php';
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
                document.location.href = 'kategori-barang.php';
            });
            </script>
        ";
    }
}



// edit barang
if (isset($_POST["edit_kategori"])) {
    // var_dump($_POST);
    if (edit_kategori($_POST)) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diupdate'
                }).then(function (){
                    document.location.href = 'kategori-barang.php';
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
                document.location.href = 'kategori-barang.php';
            });
            </script>
        ";
    }
}

// hapus data barang
if (isset($_POST["hapus_kategori"])) {
    $id = $_POST["id"];
    if (hapusKategori($id) > 0) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data barang berhasil dihapus'
        }).then(function () {
            document.location.href = 'kategori-barang.php';
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
            document.location.href = 'kategori-barang.php'; 
        });
        </script>
    ";
    }
}


?>