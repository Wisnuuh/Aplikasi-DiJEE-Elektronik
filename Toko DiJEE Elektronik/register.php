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
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="maincol">
    <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container form justify-content-center">
            <div class="row justify-content-center d-flex align-items-center custommarginreg">
                <div class="col-xl-5 mx-auto">
                    <img src="assets/img/Group_of_people_discuss_the_idea-removebg-preview.png" alt="group of people" style="height: 400px;">
                </div>
                <div class="col-xl-5 mx-auto text-center">
                    <img src="assets/img/Pensando__mas_mulher_feliz_com_pontos_de_interrogação___Vetor_Premium-removebg-preview.png" alt="" style="height: 90px;">
                    <div class="h4 customjudul text-center">Buat Akun</div>
                    <form action="register.php" method="post">
                        <div class="row mb-1">
                            <div class="col">
                                <div class="form-floating mb-0 mb-md-0">
                                    <input class="form-control rounded-5" type="text" placeholder="Nama" name="txt_nama" />
                                    <label for="inputFirstName">Nama</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-1">
                            <input class="form-control rounded-5" type="text" placeholder="Jln. Xxxxx" name="txt_alamat" />
                            <label for="inputEmail">Alamat</label>
                        </div>
                        <div class="form-floating mb-1">
                            <input class="form-control rounded-5" type="text" placeholder="081234567890" name="txt_hp" />
                            <label for="inputEmail">Nomor HP</label>
                        </div>
                        <div class="form-floating mb-1">
                            <input class="form-control rounded-5" type="text" placeholder="081234567890" name="txt_username" />
                            <label for="inputEmail">Username</label>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control rounded-5" type="password" placeholder="Create a password" name="txt_pass" />
                                    <label for="inputPassword">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-flex justify-content-end">
                                <button class="btn maincol btn-block rounded-5" type="submit" name="register">Create Account</button>
                            </div>
                            
                        </div>
                        <div class="mt-3"><a href="login.php">Sudah punya akun, pergi ke login</a></div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>