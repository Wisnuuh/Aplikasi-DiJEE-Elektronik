<?php

    require ('koneksi.php');

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }

    if (isset($_POST['update'])) {

        $userId = $_POST['txt_id'];
        $userMail = $_POST['txt_email'];
        $userPass = $_POST['txt_pass'];
        $userName = $_POST['txt_nama'];

        $query = "UPDATE user_detail SET user_password = '$userPass',
        user_fullname = '$userName' WHERE id='$userId'";
        echo $query;
        $result = mysqli_query($koneksi, $query);
        header('location: home.php');
    }

    $id = $_GET['id'];
    $query = "SELECT * FROM user_detail WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));

    while ($row = mysqli_fetch_array($result)) {

        $id = $row['id'];
        $userMail = $row['user_email'];
        $userPass = $row['user_password'];
        $userName = $row['user_fullname'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="edit.php" method="POST">
        <p><input type="hidden" name="txt_id" value="<?php echo $id; ?>"></p>
        <p>email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            <input type="text" name="txt_email" value="<?php echo $userMail; ?>" readonly></p>
        <p>password : <input type="password" name ="txt_pass" value="<?php echo $userPass; ?>"></p>
        <p>name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            <input type="text" name="txt_nama" value="<?php echo $userName; ?>"></p>
        <button type="submit" name="update">Update</button>
        <button><a href="home.php" style="text-decoration: none; color:black;">Kembali</a></button>
    </form>
</body>
</html>