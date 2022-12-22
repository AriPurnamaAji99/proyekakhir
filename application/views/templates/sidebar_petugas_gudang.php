<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('petugas_gudang') ?>">
        <div class="sidebar-brand-icon" style="margin-left: -30px;">
            <!-- <i class="fas fa-hand-holding-usd"></i> -->
            <!-- <i class="fab fa-accusoft"></i> -->
            <i class="fab fa-asymmetrik"></i>
        </div>
        <div class="sidebar-brand-text" style="margin-left: 10px;">Petugas <br> Gudang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('petugas_gudang') ?>">
            <i class="fas fa-fw fa-tachometer-alt text-white"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/listUser') ?>">
            <i class="fas fa-fw fa-users text-white"></i>
            <span>Data User</span></a>
    </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Data Master
    </div> -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('supplier') ?>">
            <i class="fas fa-fw fa-truck-moving text-white"></i>
            <span>Supplier</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Data_master/kategori') ?>">
            <i class="fas fa-fw fa-cube text-white"></i>
            <span>Kategori Barang</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Data_master/satuan') ?>">
            <i class="fas fa-fw fa-balance-scale text-white"></i>
            <span>Satuan Barang</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Barang
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('barang') ?>">
            <i class="fas fa-fw fa-clipboard-list text-white"></i>
            <span>Data Barang</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('barang/stok') ?>">
            <i class="fas fa-fw fa-archive text-white"></i>
            <span>Stok Barang</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
            <i class="fas fa-fw fa-folder-open text-white"></i>
            <span>Laporan Barang</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Laporan Barang BUMDes</h6>
                <a class="collapse-item" href="<?= base_url('barang/modal') ?>">Modal</a>
                <a class="collapse-item" href="<?= base_url('barang/stok') ?>">Stok Barang</a> -->
                <a class="collapse-item" href="<?= base_url('barang/barang_masuk') ?>">Barang Masuk</a>
                <a class="collapse-item" href="<?= base_url('barang/barang_keluar') ?>">Barang Keluar</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kirim" aria-expanded="true" aria-controls="kirim">
            <i class="fas fa-fw fa-paper-plane text-white"></i>
            <span>Kirim Laporan</span>
        </a>
        <div id="kirim" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                <a class="collapse-item" href="<?= base_url('kirim/barang_masuk') ?>">Barang Masuk</a>
                <a class="collapse-item" href="<?= base_url('kirim/barang_keluar') ?>">Barang Keluar</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->


    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Portal
    </div> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('portal/manage') ?>">
            <i class="fas fa-fw fa-cogs text-white"></i>
            <span>Kelola Portal</span></a>
    </li> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('portal/pesan') ?>">
            <i class="fas fa-fw fa-envelope-open-text text-white"></i>
            <span>Pesan</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('petugas_gudang/profile') ?>">
            <i class="fas fa-fw fa-user text-white"></i>
            <span>Profile</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('petugas_gudang/editProfile') ?>">
            <i class="fas fa-fw fa-user-edit text-white"></i>
            <span>Ubah Profile</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('petugas_gudang/ubahPassword') ?>">
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
                        <span class="mr-2 d-none d-lg-inline text-white-600 small" style="color: grey;"><?= $user['nama_lengkap']; ?> (Petugas Gudang)</span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image'] ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->