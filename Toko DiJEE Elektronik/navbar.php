    <nav class="sb-topnav navbar navbar-expand maincol">
        <!-- Navbar Brand-->
        <img class="ms-3" src="assets/img/logo dijee.png" alt="" style="width: 40px;">
        <a class="h4 namatoko" href="home.php">Toko DiJEE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 p" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="akun-karyawan.php">Profil</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion maincol" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav grid gap-3">
                        <div class="sb-sidenav-menu-heading textcolor">Utama</div>
                        <a class="nav-link textcolor" href="home.php">
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
                        <a class="nav-link textcolor" href="keuangan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar fa-lg iconcolor"></i></div>
                            Keuangan
                        </a>
                        <a class="nav-link textcolor" href="data-karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group fa-lg iconcolor"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link textcolor" href="data-customer.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users fa-lg iconcolor"></i></div>
                            Data Customer
                        </a>
                        <a class="nav-link textcolor" href="laporan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer fa-lg iconcolor"></i></div>
                            Laporan 
                        </a>
                    </div>
                </div>
            </nav>
        </div>