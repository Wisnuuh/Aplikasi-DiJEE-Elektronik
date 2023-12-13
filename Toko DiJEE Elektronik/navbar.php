<?php 
$akses = ($sesLvl != 1) ? 'style=""' : 'style="display: none;"';
$akses2 = ($sesLvl != 2) ? 'style=""' : 'style="display: none;"';
?>

    <nav class="sb-topnav navbar navbar-expand maincol">
        <!-- Navbar Brand-->
        <img class="ms-3" src="assets/img/logo dijee.png" alt="" style="width: 40px;">
        <a class="h4 namatoko" href="home.php">Toko DiJEE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 p" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="row">
                <div class="col">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="akun-karyawan.php">Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
        
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion maincol" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav grid gap-3">
                        <div class="sb-sidenav-menu-heading textcolor">Utama</div>
                        <a class="nav-link textcolor" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house fa-lg iconcolor"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed textcolor" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns fa-lg iconcolor"></i></div>
                            Data Barang
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg iconcolor"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link textcolor" href="kategori-barang.php">Kategori Barang</a>
                                <a class="nav-link textcolor" href="stok-barang.php">Stok Barang</a>
                                <a class="nav-link textcolor" href="data-supplier.php">Data Supplier</a>
                                <a class="nav-link textcolor" href="data-retur-barang.php" id="dataretur"></a>
                            </nav>
                        </div>
                        <a class="nav-link textcolor" href="data-karyawan.php" <?php echo $akses2; ?>>
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group fa-lg iconcolor"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link textcolor" href="laporan-penjualan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wave fa-lg iconcolor"></i></div>
                            Laporan Penjualan
                        </a>
                        <a class="nav-link textcolor" href="laporan-pembelian.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping fa-lg iconcolor"></i></div>
                            Laporan Pembelian
                        </a>
                        <div class="d-flex align-items-end">
                            <a class="nav-link textcolor" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket fa-lg iconcolor"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>