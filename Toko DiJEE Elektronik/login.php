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
    <title>Login | DiJEE Elektronik</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="maincol">
    <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container form justify-content-center">
            <div class="row justify-content-center d-flex align-items-center custommargin">
                <div class="col-xl-5 mx-auto">
                    <img src="assets/img/Group_of_people_discuss_the_idea-removebg-preview.png" alt="group of people" style="height: 400px;">
                </div>
                <div class="col-xl-5 mx-auto text-center">
                    <img src="assets/img/Gambar_Baki_Kerugian_Keuntungan_Undang_Undang_Warna_Rata_Ikon_Vektor_Ikon_Banner__Perakaunan_.png" alt="" style="height: 120px;">
                    <div class="h4 customjudul text-center">Kasir DiJEE Elektronik</div>
                    <form action="login.php" method="post">
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-5" type="text" placeholder="username" name="txt_username" />
                            <label for="inputEmail">Username</label>
                            <div class=""><?php global $error; echo $error ?></div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-5" type="password" placeholder="password" name="txt_pass" />
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="password.html">Lupa Password?</a>
                            <button class="btn maincol rounded-5" type="submit" name="submit">Login</button>
                        </div>
                        <a class="btn maincol mt-2 rounded-5" href="register.php">Buat akun</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>