<?php

    require ("koneksi.php");
    require_once "functions.php";
    // $email = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : "";

    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }
    $sesID = $_SESSION ['id'];
    $sesName = $_SESSION ['name'];
    $sesLvl = $_SESSION ['level'];

    $barangs = tampil_barang("SELECT * FROM barang");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Retur Barang | DiJEE Elektronik</title>
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
                    <h1 class="mt-4">Data Retur Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <a class="breadcrumb-item active" href="home.php"><li>Dashboard</li></a>
                        <li class="breadcrumb-item active">Data Retur Barang</li>
                    </ol>
                </div>
                <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        Data Retur Barang
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                                Tambah Data Retur
                            </button>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID Retur</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $query = "SELECT incomingclaim.Klaim_ID, incomingclaim.Jumlah, incomingclaim.Tgl_Pengembalian, incomingclaim.Keterangan, barang.Nama FROM incomingclaim JOIN barang ON incomingclaim.Barang_ID = barang.Barang_ID;";
                                $result = mysqli_query($koneksi, $query);
                                
                                while ($row = mysqli_fetch_array($result)) {
                                        
                                echo "<tr>";
                                echo     "<td>" . $row['Klaim_ID'] . "</td>";
                                echo     "<td>" . $row['Tgl_Pengembalian'] . "</td>";
                                echo     "<td>" . $row['Nama'] . "</td>";
                                echo     "<td>" . $row['Jumlah'] . "</td>";
                                echo     "<td>" . $row['Keterangan'] . "</td>";
                                echo "</tr>";
                                }
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
    <!-- modal tambah barang -->
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pilihBarang">Pilih Barang:</label>
                            <select name="pilihBarang" class="form-select" id="pilihBarang" required>
                                <option selected disabled>Pilih Barang</option>
                                <?php foreach ($barangs as $barang) : ?>
                                    <option value="<?= $barang["Barang_ID"] ?>"><?= $barang["Nama"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah:</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="akhirGaransi" class="form-label">Akhir Garansi:</label>
                            <input type="date" name="akhirGaransi" class="form-control" id="akhirGaransi">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Mendapatkan elemen input berdasarkan ID
        var inputTanggal = document.getElementById('akhirGaransi');

        // Mendapatkan tanggal saat ini dalam format YYYY-MM-DD
        var tanggalSekarang = new Date().toISOString().split('T')[0];

        // Mengatur nilai input tanggal ke tanggal saat ini
        inputTanggal.value = tanggalSekarang;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>

<?php 

// tambah barang
if (isset($_POST["submit"])) {
    if (tambahRetur($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan'
                }).then(function () {
                    document.location.href = 'stok-barang.php';
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
            }).then(function () {
                document.location.href = 'stok-barang.php';
            });
            </script>
        ";
    }
}

?>