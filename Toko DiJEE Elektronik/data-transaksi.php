<?php

    require ("koneksi.php");
    // $email = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : "";

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }
    $sesID = $_SESSION ['id'];
    $sesName = $_SESSION ['name'];
    $sesLvl = $_SESSION ['level'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Transaksi | DiJEE Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home.php">Welcome</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Utama</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Data Barang
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="stok-barang.php">Stok Barang</a>
                                <a class="nav-link" href="data-supplier.php">Data Supplier</a>
                                <a class="nav-link" href="data-retur-barang.php">Data Barang</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="keuangan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                            Keuangan
                        </a>
                        <a class="nav-link" href="data-karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link" href="data-customer.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Data Customer
                        </a>
                        <a class="nav-link" href="data-transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            Data Transaksi
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Transaksi</h1>
                    <ol class="breadcrumb mb-4">
                        <a class="breadcrumb-item active" href="home.php">
                            <li>Dashboard</li>
                        </a>
                        <li class="breadcrumb-item active">Data Transaksi</li>
                    </ol>
                </div>
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Data Transaksi
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Nama Barang</th>
                                        <th>Total Pembayaran</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php

                                    $query = "SELECT penjualan.Tgl_Penjualan, detailpenjualan.nama_Barang, penjualan.totalPembayaran
                                    FROM penjualan
                                    INNER JOIN detailpenjualan ON penjualan.ID_Penjualan = detailpenjualan.ID_Penjualan;";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    if ($sesLvl == 1) {

                                        $dis = "";
                                    } else {

                                        $dis = "disabled";
                                    }
                                    
                                    while ($row = mysqli_fetch_array($result)) {
                                            
                                    echo "<tr>";
                                    echo     "<td>" . $no . "</td>";
                                    echo     "<td>" . $row['Tgl_Penjualan'] . "</td>";
                                    echo     "<td>" . $row['nama_Barang'] . "</td>";
                                    echo     "<td>" . $row['totalPembayaran'] . "</td>";
                                    echo "</tr>";

                                        $no++; }
                                    ?>
                                    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>


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
            <td><a href="edit.php?id=<?php echo $row['User_ID'];?>"
                style="text-decoration: none; color:black;">
                <input type="button" value="edit" <?php echo $dis; ?>></a>
                <a href="hapus.php?id=<?php echo $row['User_ID'];?>"
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