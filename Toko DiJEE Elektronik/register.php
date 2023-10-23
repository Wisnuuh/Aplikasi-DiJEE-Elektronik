<?php

    require ('koneksi.php');

    if(isset($_POST['register'])) {

        $userMail = $_POST['txt_email'];
        $userPass= $_POST['txt_pass'];
        $userName = $_POST['txt_nama'];

        $query = "INSERT INTO user_detail VALUES ('', '$userMail', '$userPass', '$userName', 1)";
        $result = mysqli_query($koneksi, $query);
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
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
</html>