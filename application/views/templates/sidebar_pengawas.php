<!-- Sidebar -->
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('pengawas') ?>">
        <div class="sidebar-brand-icon" style="margin-left: -30px;">
            <!-- <i class="fas fa-hand-holding-usd"></i> -->
            <!-- <i class="fab fa-accusoft"></i> -->
            <i class="fab fa-asymmetrik"></i>
        </div>
        <div class="sidebar-brand-text" style="margin-left: 10px;">PENGAWAS <br> BUMDES</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengawas') ?>">
            <i class="fas fa-fw fa-tachometer-alt text-white"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-folder-open text-white"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan BUMDes:</h6>
                <a class="collapse-item" href="<?= base_url('pengawas/penjualan') ?>">Penjualan</a>
                <a class="collapse-item" href="<?= base_url('pengawas/laba_rugi') ?>">Laba Rugi</a>
                <a class="collapse-item" href="<?= base_url('pengawas/neraca') ?>">Neraca</a>
                <a class="collapse-item" href="<?= base_url('pengawas/barang_masuk') ?>">Barang Masuk</a>
                <a class="collapse-item" href="<?= base_url('pengawas/barang_keluar') ?>">Barang Keluar</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penjualan" aria-expanded="true" aria-controls="Barang">
            <i class="fas fa-fw fa-list text-white"></i>
            <span>Data Laporan</span>
        </a>
        <div id="penjualan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                <a class="collapse-item" href="<?= base_url('pengawas/laporan_barang_masuk') ?>">Barang Masuk</a>
                <a class="collapse-item" href="<?= base_url('pengawas/laporan_barang_keluar') ?>">Barang Keluar</a>
                <!-- <a class="collapse-item" href="<?= base_url('pengawas/data_laporan') ?>">Penjualan</a>
                <a class="collapse-item" href="<?= base_url('pengawas/laporan_laba_rugi') ?>">Laba Rugi</a>
                <a class="collapse-item" href="<?= base_url('pengawas/laporan_neraca') ?>">Neraca</a> -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengawas/listUser') ?>">
            <i class="fas fa-fw fa-users text-white"></i>
            <span>Data User</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengawas/profile') ?>">
            <i class="fas fa-fw fa-user text-white"></i>
            <span>Profile</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengawas/editProfile') ?>">
            <i class="fas fa-fw fa-user-edit text-white"></i>
            <span>Ubah Profile</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengawas/ubahPassword') ?>">
            <i class="fas fa-fw fa-key text-white"></i>
            <span>Ubah Password</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt text-white"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white-600 small" style="color: grey;"><?= $user['nama_lengkap']; ?> (Pengawas)</span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image'] ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->