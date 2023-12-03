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

$akses = ($sesLvl != 1) ? 'style=""' : 'style="display: none;"';
$akses2 = ($sesLvl != 2) ? 'style=""' : 'style="display: none;"';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | DiJEE Elektronik</title>
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <!-- Hak akses pemilik dan karyawan -->
                <div <?php  echo $akses2; ?>>
                <div class="container-fluid px-4">
                    <iframe title="aplikasidijee" width="1030" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiNmRjYjFhNTktZTgyYS00NWY2LWFmNDgtMzk3OTNhNmM2NDU4IiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
                </div>
                </div>
                <div <?php  echo $akses; ?>>
                    <div class="row px-4">
                        <div class="col-sm-4">
                            <div class="card card-primary mb-3">
                                <div class="card-header text-white maincol">
                                    <h5><i class="fa fa-search"></i> Cari Barang</h5>
                                </div>
                                <div class="card-body">
                                    <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukkan: Kode / Nama Barang" onkeyup="cariBarang(event)" autofocus>
                                </div>
                            </div>
                        </div>

                        <!--Pencarian-->
                        <div class="col-sm-8 px-4">
                            <div class="card card-primary mb-3">
                                <div class="card-header text-white maincol">
                                    <h5><i class="fa fa-search"></i> Hasil Barang</h5>
                                </div>
                                <div class="card-body" id="hasil_barang">
                                    <!-- Hasil pencarian akan ditampilkan di sini -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Keranjang-->
                    <div class="col-sm-12 px-4">
                        <div class="card card-primary">
                            <div class="card-header text-white maincol">
                                <div class="row">
                                    <div class="col"><h5><i class="fa fa-shopping-cart"></i>KASIR</h5></div>
                                    <div class="col text-end">
                                        <button class="btn btn-danger" onclick="hapusSemuaBarang()">
                                            <b>RESET KERANJANG</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <form action="proses.php" method="post">
                                <div class="card-body">
                                    <div id="keranjang" class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b>Tanggal</b></td>
                                                <td>
                                                    <input type="hidden" readonly="readonly" class="form-control bg-secondary bg-opacity-25" value="<?php echo date("Y-m-d");?>" name="tgl">
                                                    <?php echo date("j F Y");?>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered w-100" id="example1">
                                            <thead>
                                                <tr>
                                                    <td> ID</td>
                                                    <td> Nama Barang</td>
                                                    <td> Harga</td>
                                                    <td style="width:10%;"> Jumlah</td>
                                                    <td style="width:20%;"> SubTotal</td>
                                                    <td> Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="justify-content-end">
                                        <table class="row table table-bordered">
                                            <tr>
                                                <td><b>Kasir</b></td>
                                                <td class="col-8">
                                                    <?php echo $sesName; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Total</b></td>
                                                
                                                <td class="col-8" id="total-keseluruhan-text">
                                                    <!-- Rp0 -->
                                                    <input type="hidden" id="total-keseluruhan-input" name="totalKeseluruhan" value="">
                                                    <span id="total-keseluruhan-text"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Bayar</b></td>
                                                <td ><input id="inputPembayaran" name="bayar" type="number" min='1' value='' onchange="hitungKembalian()"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Kembalian</b></td>
                                                <td class="col-8" id="uang-kembalian">
                                                    <input type="hidden" id="inputKembalian" name="kembalian" value="">
                                                    <span id="kembalianText">Rp0</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <button class="btn btn-primary mb-3 float-end" onclick="kirimData()" style="width: 8rem;"><b>Proses</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!--Buat Cari Script-->
    <script>
        var selectedBarangID = "";
        function cariBarang(event) {
            var input = document.getElementById("cari").value;
            if (input.trim() !== "") {
                // Menggunakan AJAX untuk mengirim permintaan pencarian ke server
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Menampilkan hasil pencarian di div "hasil_barang"
                        document.getElementById("hasil_barang").innerHTML = this.responseText;
                    }
                };
                // Ganti "proses_pencarian.php" dengan nama file PHP yang melakukan pencarian di database
                xmlhttp.open("GET", "proses_pencarian.php?cari=" + input, true);
                xmlhttp.send();
            } else {
                // Jika input kosong, hapus hasil pencarian
                document.getElementById("hasil_barang").innerHTML = "";
            }
        }

        // Menambahkan event listener untuk memicu pencarian saat nilai input berubah
        document.getElementById("cari").addEventListener("input", cariBarang);

        function ambilJumlahBarang() {
            var jumlahInputs = document.querySelectorAll('.jumlah-barang');
            var jumlahBarang = [];

            jumlahInputs.forEach(function(input) {
                jumlahBarang.push({
                    id: input.getAttribute('data-id'),
                    jumlah: input.value
                });
            });

            return jumlahBarang;
        }
        function kirimDataKePHP(ids) {
            // Mendapatkan nilai Total, Pembayaran, dan Kembalian
            var totalKeseluruhan = parseFloat(document.getElementById('total-keseluruhan-text').innerText.replace('Rp', ''));
            var pembayaran = parseFloat(document.getElementById('inputPembayaran').value);
            var kembalian = parseFloat(document.getElementById('inputKembalian').value);

            // Menggunakan AJAX untuk mengirim nilai ke server PHP
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "proses.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Response dari server (jika diperlukan)
                    console.log(xhr.responseText);
                }
            };

            // Menyiapkan data untuk dikirim ke server
            var data = "ids=" + encodeURIComponent(ids.join(',')) + "&total=" + totalKeseluruhan + "&pembayaran=" + pembayaran + "&kembalian=" + kembalian;

            // Kirim data ke server
            xhr.send(data);
        }

        function pilihBarang(id, nama, harga, subtotal) {

            // Menyimpan ID barang yang dipilih ke variabel global
            selectedBarangID = id;

            // Menggunakan AJAX untuk mengirim nilai ID ke server PHP
            kirimDataKePHP([id]);

            // Di sini Anda dapat menangani logika penambahan barang ke dalam keranjang

            // Misalnya, kita akan menambahkan baris baru ke dalam tabel "example1"
            var table = document.getElementById("example1").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);

            // Di sini Anda dapat menambahkan data ke dalam sel-sel baris baru
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            // Contoh penambahan data ke dalam sel-sel
            cell1.innerHTML = '<input type="hidden" name="ids[id][]" value="'+id+'"><label name="id">'+id+'</label>';  // Nomor urut
            cell2.innerHTML = nama;  // Nama Barang
            cell3.innerHTML = harga;  // Anda perlu menggantinya dengan harga barang yang sesuai
            cell4.innerHTML = "<input type='number' min='1' value='1' class='form-control jumlah-barang' name='jumlahBarang[]' onchange='hitungSubtotal(this); updateTotalKeseluruhan();'>";  // Input jumlah
            cell5.innerHTML = subtotal;  // Anda perlu menggantinya dengan logika perhitungan subtotal yang sesuai
            cell6.innerHTML = "<button class='btn btn-danger btn-sm' onclick='hapusBaris(this); updateTotalKeseluruhan();'>Hapus</button>";  // Tombol hapus

            updateTotalKeseluruhan();
        }
        function hapusBaris(button) {
            // Mendapatkan baris tempat tombol "Hapus" ditekan
            var row = button.parentNode.parentNode;

            // Menghapus baris dari tabel
            row.parentNode.removeChild(row);

            // Di sini Anda dapat menambahkan logika tambahan, seperti memperbarui subtotal atau total keseluruhan
            // ...

            // Contoh: Menampilkan pesan setelah menghapus barang
            alert("Barang dihapus dari keranjang");
        }
        function hapusSemuaBarang() {

            // Dapatkan referensi ke tabel
            var table = document.getElementById("example1").getElementsByTagName('tbody')[0];

            // Menyimpan pilihan konfirmasi
            var konfirmasi = confirm("Hapus semua barang dari keranjang?");

            // Jika iya maka data akan dihapus, jika tidak maka akan dilewati
            if (konfirmasi) {

                // Hapus semua baris dari tabel
                while (table.rows.length > 0) {
                    table.deleteRow(0);
                }
            }
        }
        function hitungTotalKeseluruhan() {
            var table = document.getElementById("example1").getElementsByTagName('tbody')[0];
            var total = 0;

            // Iterasi melalui setiap baris dan tambahkan subtotal ke total keseluruhan
            for (var i = 0; i < table.rows.length; i++) {
                var subtotal = parseFloat(table.rows[i].cells[4].innerHTML);
                total += subtotal;
            }

            return total;
        }

        function updateTotalKeseluruhan() {
            // Hitung total keseluruhan
            var totalKeseluruhan = hitungTotalKeseluruhan();

            // Tampilkan total keseluruhan pada span
            var totalText = document.getElementById("total-keseluruhan-text");
            totalText.textContent = "Rp" + totalKeseluruhan.toLocaleString();

            // Update value of hidden input
            var totalInput = document.getElementById("total-keseluruhan-input");
            totalInput.value = totalKeseluruhan;
        }

        function hitungSubtotal(input) {
            // Dapatkan baris tempat input jumlah berada
            var row = input.parentNode.parentNode;

            // Dapatkan harga dan jumlah barang dari sel-sel terkait
            var harga = parseFloat(row.cells[2].innerHTML);
            var jumlah = parseFloat(input.value);

            // Hitung subtotal
            var subtotal = harga * jumlah;

            // Tampilkan subtotal pada sel subtotal
            row.cells[4].innerHTML = subtotal;

            // Update total keseluruhan setelah menghitung subtotal
            updateTotalKeseluruhan();
        }

        // Mendengarkan perubahan pada input pembayaran
        document.getElementById('inputPembayaran').addEventListener('input', function() {
            hitungKembalian();
        });

        updateTotalKeseluruhan();

        function hitungKembalian() {
            // Mendapatkan nilai total keseluruhan
            var totalKeseluruhan = parseFloat(document.getElementById('total-keseluruhan-text').innerText.replace('Rp', '').replace(',', ''));

            // Mendapatkan nilai pembayaran
            var pembayaran = parseFloat(document.getElementById('inputPembayaran').value);

            // Hitung kembalian
            var kembalian = pembayaran - totalKeseluruhan;

            // Tampilkan kembalian pada elemen dengan ID 'kembalianText'
            document.getElementById('kembalianText').innerText = "Rp" + kembalian.toLocaleString();

            // Set nilai input kembalian (yang tersembunyi)
            document.getElementById('inputKembalian').value = kembalian;

            // Update total keseluruhan setelah menghitung kembalian
            updateTotalKeseluruhan();
        }

        function kirimData() {
            // Mengambil nilai dari semua input di dalam form
            var ids = [];
            var jumlahBarang = [];

            $("#myForm input[name='ids[id][]']").each(function() {
                ids.push($(this).val());
            });

            // Mengambil nilai dari semua input jumlah-barang di dalam form
            $("#myForm input[name='jumlahBarang']").each(function() {
                jumlahBarang.push($(this).val());
            });

            // Kirim data ke server menggunakan jQuery
            $.ajax({
                type: "POST",
                url: "proses.php",
                data: {
                    ids: ids,
                    jumlahBarang: jumlahBarang
                },
                success: function (response) {
                    // Tampilkan respons dari server jika diperlukan
                    console.log(response);
                }
            });
        }
    </script>
    <!--End Buat Cari Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>