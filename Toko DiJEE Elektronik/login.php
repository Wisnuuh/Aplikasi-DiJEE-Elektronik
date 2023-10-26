<?php

    require ('koneksi.php');

    session_start();
    
    if(isset($_POST['submit'])){

        $email = $_POST['txt_username'];
        $pass = $_POST['txt_pass'];

        $emailCheck = mysqli_real_escape_string($koneksi, $email);
        $passCheck = mysqli_real_escape_string($koneksi, $pass);

        if(!empty (trim($email)) && !empty(trim($pass))) {

            $query = "SELECT * FROM user WHERE username = '$email'";
            $result = mysqli_query($koneksi, $query);
            $num = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
                $id = $row['User_ID'];
                $userVal = $row['username'];
                $passVal = $row['password'];
                $userName = $row['Nama'];
                $level = $row['JenisUser_ID'];
            }

            if($num != 0 ) {
                if($userVal == $email && $passVal == $pass) {

                    // header('Location: home.php');
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $userName;
                    $_SESSION['level'] = $level;
                    header('Location: home.php');
                } else {

                    $error = 'user atau password salah!!';
                }
            }
        } else {

            $error = 'Data tidak boleh kosong !!';
        }
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
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-success">
                <main class="d-flex justify-content-center align-items-center" style="height: 100vh;" >
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="username" name="txt_username"/>
                                                <label for="inputEmail">Username</label>
                                                <div class=""><?php global $error; echo $error ?></div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="password" placeholder="password" name="txt_pass"/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Lupa Password?</a>
                                                <button class="btn btn-success fs-5" type="submit" name="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a class="btn btn-success fs-5" href="register.php">Buat akun</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>