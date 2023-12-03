<?php

    require ("koneksi.php");
    require_once "functions.php";

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }
    $sesID = $_SESSION ['id'];
    $sesName = $_SESSION ['name'];
    $sesLvl = $_SESSION ['level'];

    $tampilSupp = tampil_supplier("SELECT * FROM supplier");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Supplier | DiJEE Elektronik</title>
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
                <h1 class="mt-4">Data Supplier</h1>
                <ol class="breadcrumb mb-4">
                    <a class="breadcrumb-item active" href="home.php"><li>Dashboard</li></a>
                    <li class="breadcrumb-item active">Data Supplier</li>
                </ol>
            </div>
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        Data Supplier
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                Tambah Supplier
                            </button>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID Supplier</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Acton</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $query = "SELECT ID_Supplier, Nama_Supplier, Alamat, No_Telp FROM supplier;";
                                $result = mysqli_query($koneksi, $query);
                                $no = 1;
                                
                                while ($row = mysqli_fetch_array($result)) {
                                        
                                echo "<tr>";
                                echo     "<td>" . $row['ID_Supplier'] . "</td>";
                                echo     "<td>" . $row['Nama_Supplier'] . "</td>";
                                echo     "<td>" . $row['Alamat'] . "</td>";
                                echo     "<td>" . $row['No_Telp'] . "</td>";
                                echo     "<td>";
                                echo         '<ul class="list-inline">';
                                echo             '<li class="list-inline-item">';
                                echo            '<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSupp' . $row['ID_Supplier'] . '">Edit</button>';

                                echo             '</li>';
                                echo             '<li class="list-inline-item">';
                                echo                 '<button class="btn btn-md btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#hapusSupp' . $row['ID_Supplier'] . '">Hapus</button>';
                                echo             '</li>';
                                echo         '</ul>';
                                echo     "</td>";
                                echo "</tr>";
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- modal tambah supplier -->
            <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Supplier:</label>
                                    <input type="name" name="namaSupp" class="form-control" id="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamatsupp" class="form-label">Alamat:</label>
                                    <input type="text" name="alamatSupp" class="form-control" id="alamatsupp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="garansi" class="form-label">No Telepon:</label>
                                    <input type="number" name="noSupp" class="form-control" id="garansi">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- modal update -->
            <?php foreach ($tampilSupp as $suppliers) : ?>
                <div class="modal fade" id="editSupp<?= $suppliers['ID_Supplier'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="ID" value="<?= $suppliers['ID_Supplier'] ?>">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Supplier:</label>
                                        <input type="name" name="nama" class="form-control" id="nama" value="<?= $suppliers['Nama_Supplier'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Alamat:</label>
                                        <input type="text" name="alamat" class="form-control" id="jumlah" value="<?= $suppliers['Alamat'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Nomor Telepon:</label>
                                        <input type="number" name="nomorTelfon" class="form-control" id="tambahstok" value="<?= $suppliers['No_Telp'] ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- modal hapus -->
            <?php foreach ($tampilSupp as $suppliers) : ?>
                <div class="modal fade zoomIn" id="hapusSupp<?= $suppliers['ID_Supplier'] ?>" tabindex="-1" aria-hidden="true">
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
                                        <input type="hidden" value="<?= $suppliers['ID_Supplier'] ?>" name="id">
                                        <button type="submit" name="hapus_barang" class="btn w-sm btn-danger">Ya, Hapus!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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

// tambah supplier
if (isset($_POST["submit"])) {
    if (tambahSupplier($_POST) > 0) {
        
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data gagal ditambahkan'
            }).then(function (){
                document.location.href = 'data-supplier.php';
            });
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan'
                }).then(function (){
                    document.location.href = 'data-supplier.php';
                });
            </script>
        ";
    }
}

// edit supplier
if (isset($_POST["edit"])) {
    if (edit_supplier($_POST)) {
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data gagal diubah'
            }).then(function (){
                document.location.href = 'data-supplier.php';
            });
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diubah'
                }).then(function (){
                    document.location.href = 'data-supplier.php';
                });
            </script>
        ";
        
    }
}

// hapus data barang
if (isset($_POST["hapus_barang"])) {
    $id = $_POST["id"];
    if (hapusSupplier($id) > 0) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data barang berhasil dihapus'
        }).then(function () {
            document.location.href = 'data-supplier.php';
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
            document.location.href = 'data-supplier.php'; 
        });
        </script>
    ";
    }
}

?>