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

$karyawans = tampil_karyawan(
    "SELECT `User_ID`, `Nama`, `Alamat`, `Nomor_HP`, 'JenisUser_ID',
  jenis_user.Divisi_User, `username`, `password` FROM 
  `user` JOIN jenis_user ON user.JenisUser_ID = jenis_user.JenisUser_ID "
);
$jenisKaryawans = tampil_jenisKaryawan("SELECT * FROM jenis_user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Karyawan | DiJEE Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand maincol">
        <!-- Navbar Brand-->
        <img class="ms-3" src="assets/img/logo dijee.png" alt="" style="width: 40px;">
        <a class="h4 namatoko" href="home.php">Toko DiJEE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 p" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="akun-karyawan.php">Profil</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion maincol" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav grid gap-3">
                        <div class="sb-sidenav-menu-heading textcolor">Utama</div>
                        <a class="nav-link textcolor" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house fa-lg iconcolor"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed textcolor" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns fa-lg iconcolor"></i></div>
                            Data Barang
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg iconcolor"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link textcolor" href="stok-barang.php">Stok Barang</a>
                                <a class="nav-link textcolor" href="data-supplier.php">Data Supplier</a>
                                <a class="nav-link textcolor" href="data-retur-barang.php" id="dataretur"></a>
                            </nav>
                        </div>
                        <a class="nav-link textcolor" href="keuangan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar fa-lg iconcolor"></i></div>
                            Keuangan
                        </a>
                        <a class="nav-link textcolor" href="data-karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group fa-lg iconcolor"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link textcolor" href="data-customer.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users fa-lg iconcolor"></i></div>
                            Data Customer
                        </a>
                        <a class="nav-link textcolor" href="data-transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer fa-lg iconcolor"></i></div>
                            Data Transaksi
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Karyawan</h1>
                    <ol class="breadcrumb mb-4">
                        <a class="breadcrumb-item active" href="home.php">
                            <li>Dashboard</li>
                        </a>
                        <li class="breadcrumb-item active">Data Karyawan</li>
                    </ol>
                </div>
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Data Karyawan
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                tambah karyawan
                            </button>
                            <table id="datatablesSimple" class="table ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>nama</th>
                                        <th>alamat</th>
                                        <th>no hp</th>
                                        <th>Jenis user</th>
                                        <th>username</th>
                                        <th>password</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($karyawans as $karyawan) : ?>
                                        <tr>
                                            <td><?= $karyawan["User_ID"] ?></td>
                                            <td><?= $karyawan["Nama"] ?></td>
                                            <td><?= $karyawan["Alamat"] ?></td>
                                            <td><?= $karyawan["Nomor_HP"] ?></td>
                                            <td><?= $karyawan["Divisi_User"] ?></td>
                                            <td><?= $karyawan["username"] ?></td>
                                            <td><?= $karyawan["password"] ?></td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $karyawan['User_ID'] ?>">edit</button>
                                                    </li>
                                                    <li class="list-inline-item">
                                                    <button class="btn btn-md btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#hapus<?= $karyawan['User_ID'] ?>">hapus</button>
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
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- modal tambah karyawan -->
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
                            <label for="nama" class="form-label">nama</label>
                            <input type="name" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">alamat</label>
                            <input type="name" name="alamat" class="form-control" id="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">no hp</label>
                            <input type="tel" name="no_hp" class="form-control" id="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="divisi_user">Pilih divisi_user:</label>
                            <select name="divisi_user" id="divisi_user" required>
                                <option>Pilih jenis user</option>
                                <?php foreach ($jenisKaryawans as $jenisKaryawan) : ?>
                                    <option value="<?= $jenisKaryawan["JenisUser_ID"] ?>"><?= $jenisKaryawan["Divisi_User"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username1" class="form-label">username</label>
                            <input type="name" name="username1" class="form-control" id="username1" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">password</label>
                            <input type="password2" name="password2" class="form-control" id="password2" required>
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
    <?php foreach ($karyawans as $karyawan) : ?>
        <div class="modal fade" id="edit<?= $karyawan['User_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_user" value="<?= $karyawan['User_ID'] ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">nama</label>
                                <input type="name" name="nama" class="form-control" id="nama" value="<?= $karyawan['Nama'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">alamat</label>
                                <input type="name" name="alamat" class="form-control" id="alamat" value="<?= $karyawan['Alamat'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">no hp</label>
                                <input type="tel" name="no_hp" class="form-control" id="no_hp" value="<?= $karyawan['Nomor_HP'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="divisi_user">Pilih divisi_user:</label>
                                <select name="divisi_user" id="divisi_user" required>
                                    <?php foreach ($jenisKaryawans as $jenisKaryawan) : ?>
                                        <?php if ($jenisKaryawan["JenisUser_ID"] === $karyawan['JenisUser_ID']) : ?>
                                            <option selected value="<?= $jenisKaryawan["JenisUser_ID"] ?>"><?= $karyawan["Divisi_User"] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $jenisKaryawan["JenisUser_ID"] ?>"><?= $jenisKaryawan["Divisi_User"] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username1" class="form-label">username</label>
                                <input type="name" name="username1" class="form-control" id="username1" value="<?= $karyawan["username"] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label">password</label>
                                <input type="password2" name="password2" class="form-control" id="password2" value="<?= $karyawan['password'] ?>" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit-barang" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <!-- modal hapus -->
    <?php foreach ($karyawans as $karyawan) : ?>
        <div class="modal fade zoomIn" id="hapus<?= $karyawan['User_ID'] ?>" tabindex="-1" aria-hidden="true">
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
                                <input type="hidden" value="<?= $karyawan['User_ID'] ?>" name="id_user">
                                <button type="submit" name="hapus_barang" class="btn w-sm btn-danger">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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
// tambah karyawan
if (isset($_POST["submit"])) {
    if (tambahKaryawan($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan'
                }).then(function (){
                    document.location.href = 'data-karyawan.php';
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
                document.location.href = 'data-karyawan.php';
            });
            </script>
        ";
    }
}

// edit karyawan
if (isset($_POST["edit-barang"])) {
    if (editKaryawan($_POST)) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diupdate'
                }).then(function (){
                    document.location.href = 'data-karyawan.php';
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
                document.location.href = 'data-karyawan.php';
            });
            </script>
        ";
    }
}

// hapus data karyawan
if (isset($_POST["hapus_barang"])) {
    $id = $_POST["id_user"];
    if (hapusKaryawan($id) > 0) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data barang berhasil dihapus'
        }).then(function () {
            document.location.href = 'data-karyawan.php';
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
            document.location.href = 'data-karyawan.php'; 
        });
        </script>
    ";
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
    <h1>Selamat Datang <?php echo $email; ?></h1>
    <h1>Selamat Datang <?php echo $sesName; ?></h1>
    <table border="1">
        <tr style="text-align: center;">
            <td>No</td>
            <td>Email</td>
            <td>Nama</td>
            <td>Edit</td>
        </tr>
        <?php

        $query = "SELECT * FROM user";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        if ($sesLvl == 1) {

            $dis = "";
        } else {

            $dis = "disabled";
        }

        while ($row = mysqli_fetch_array($result)) {

            $userMail = $row['username'];
            $userName = $row['Nama'];

        ?>

        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $userMail; ?></td>
            <td><?php echo $userName; ?></td>
            <td><a href="edit.php?id=<?php echo $row['User_ID']; ?>"
                style="text-decoration: none; color:black;">
                <input type="button" value="edit" <?php echo $dis; ?>></a>
                <a href="hapus.php?id=<?php echo $row['User_ID']; ?>"
                style="text-decoration: none; color:black;">
                <input type="button" value="hapus" <?php echo $dis; ?>></a>
            </td>
        </tr>
        <?php
            $no++;
        }
        ?>
    </table>
    <br>
    <p><a href="logout.php">Log out</a></p>
</body>
</html> -->