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

    $tampilAkun = mysqli_query($koneksi, "SELECT * FROM user WHERE User_ID = $sesID");
    while ($info = mysqli_fetch_array($tampilAkun)) {

        $nama = $info['Nama'];
        $nohp = $info['Nomor_HP'];
        $alamat = $info['Alamat'];
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
    <title>Profil | DiJEE Elektronik</title>
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
                    <h1 class="mt-4">Profil</h1>
                    <ol class="breadcrumb mb-4">
                        <a class="breadcrumb-item active" href="index.php"><li>Dashboard</li></a>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
                
                <div class="col mt-1 px-4">
                    <div class="card mb-3 content">
                    <div class="d-flex justify-content-between">
                        <h1 class="m-3 pt-3">About</h1>
                        <i class="fa-solid fa-circle-user fa-4x m-3 pt-3" style="font-size: 5em;"></i>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Nama Lengkap</h5>
                                </div>
                                <div class="col-md-9 text-secondary"><?php echo $nama; ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>No HP</h5>
                                </div>
                                <div class="col-md-9 text-secondary"><?php echo $nohp ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Alamat</h5>
                                </div>
                                <div class="col-md-9 text-secondary"><?php echo $alamat ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-user-group"></i>
                            Aktivitas login
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple2" class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    $tampilRiwayat = mysqli_query($koneksi, "SELECT user.User_ID, user.Nama as namaUser, DATE_FORMAT(riwayataktivitas.tanggal, '%d %M %Y') as tggl, TIME(riwayataktivitas.tanggal) as waktu, riwayataktivitas.status
                                                                                FROM riwayataktivitas
                                                                                INNER JOIN user ON riwayataktivitas.User_ID = user.User_ID
                                                                                WHERE user.User_ID = $sesID");

                                    while ($row = mysqli_fetch_array($tampilRiwayat)) {
                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $row['namaUser']; ?></td>
                                        <td><?php echo $row['tggl']; ?></td>
                                        <td><?php echo $row['waktu']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                    </tr>

                                    <?php 
                                    
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>