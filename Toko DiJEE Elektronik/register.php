<?php

    require ('koneksi.php');

    if(isset($_POST['register'])) {

        $Nama = $_POST['txt_nama'];
        $Alamat= $_POST['txt_alamat'];
        $Nomer_HP = $_POST['txt_hp'];
        $username = $_POST['txt_username'];
        $password = $_POST['txt_pass'];

        $query = "INSERT INTO user VALUES ('', '$Nama', '$Alamat', '$Nomer_HP', 2, '$username', '$password')";
        $result = mysqli_query($koneksi, $query);
        header('Location: login.php');
    } 

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <p>email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="txt_email"></p>
        <p>password : <input type="password" name="txt_pass"></p>
        <p>nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="txt_nama"></p>
        <button type="submit" name="register">Register</button>
        <button><a href="login.php" style="text-decoration: none; color:black;">Sign up</a></button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register | DiJEE Elektronik</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-success">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main class="d-flex justify-content-center align-items-center" style="height: 90vh;">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Buat Akun</h3></div>
                                    <div class="card-body">
                                        <form action="register.php" method="post">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" placeholder="Nama" name="txt_nama" />
                                                        <label for="inputFirstName">Nama</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Jln. Xxxxx" name="txt_alamat" />
                                                <label for="inputEmail">Alamat</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="081234567890" name="txt_hp" />
                                                <label for="inputEmail">Nomor HP</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="081234567890" name="txt_username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="password" placeholder="Create a password" name="txt_pass" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-success btn-block d-grid" type="submit" name="register">Create Account</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Sudah punya akun, pergi ke login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- <div id="layoutAuthentication_footer">
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
            </div> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>