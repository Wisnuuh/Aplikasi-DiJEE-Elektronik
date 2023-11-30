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
                        <a class="breadcrumb-item active" href="home.php"><li>Dashboard</li></a>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
                <img src="assets/img/1.jpeg" alt="" style="width: 600px;">
                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content">
                        <h1 class="m-3pt-3">About</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>full name</h5>
                                </div>
                                <div class="col-md-9 text-secondary">Ayu Dewi</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>email</h5>
                                </div>
                                <div class="col-md-9 text-secondary">ayudewi@gmail.com</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>phone</h5>
                                </div>
                                <div class="col-md-9 text-secondary">085335887665</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>address</h5>
                                </div>
                                <div class="col-md-9 text-secondary">Jln.Prajurit,Jember</div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
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