<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/materialize.min.css') ?>" media="screen,projection" />

    <title><?= $title; ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/portal/logo.png') ?>">

    <!-- my css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style3.css') ?>">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body id="home" class="scrollspy">

    <!-- navbar -->
    <div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#home" class="brand-logo">Karya Mandiri</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#about">Tentang</a></li>
                        <!-- <li><a href="#clients">Lembaga</a></li> -->
                        <li><a href="#services">Melayani</a></li>
                        <!-- <li><a href="#portfolio">Mitra</a></li> -->
                        <li><a href="#contact">Kontak</a></li>
                        <li><a class='dropdown-trigger btn' href='<?= base_url('auth') ?>'>Login</a>
                            <!-- Dropdown Structure -->
                            <!-- <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="<?= base_url('admin') ?>">Admin</a></li>
                                <li><a href="<?= base_url('petugas') ?>">Petugas</a></li>
                                <li><a href="<?= base_url('pengawas') ?>">Pengawas</a></li>
                            </ul> -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- sidenav -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="">Tentang</a></li>
        <li><a href="">Lembaga</a></li>
        <li><a href="">Melayani</a></li>
        <li><a href="">Mitra</a></li>
        <li><a href="">Kontak</a></li>
        <li><a class='dropdown-trigger btn' href='<?= base_url('auth') ?>' data-target='dropdown2'>Login</a>
            <!-- Dropdown Structure -->
            <!-- <ul id='dropdown2' class='dropdown-content'>
                <li><a href="<?= base_url('admin') ?>">Admin</a></li>
                <li><a href="<?= base_url('petugas') ?>">Petugas</a></li>
                <li><a href="<?= base_url('pengawas') ?>">Pengawas</a></li>
            </ul> -->
        </li>
    </ul>

    <!-- slider -->
    <div class="slider">
        <ul class="slides">
            <li>
                <img src="<?= base_url('assets/img/slider/') . $data_portal->gambar_1; ?>"> <!-- random image -->
                <div class="caption center-align">
                    <h3><?= $data_portal->judul_1; ?></h3>
                    <!-- <h5 class="light grey-text text-lighten-3">Desa Ciangir</h5> -->
                </div>
            </li>
            <li>
                <img src="<?= base_url('assets/img/slider/') . $data_portal->gambar_2; ?> ?>"> <!-- random image -->
                <div class="caption right-align">
                    <h3><?= $data_portal->judul_2; ?></h3>
                    <!-- <h5 class="light grey-text text-lighten-3">Desa Ciangir</h5> -->
                </div>
            </li>
            <li>
                <img src="<?= base_url('assets/img/slider/') . $data_portal->gambar_3; ?> ?>"> <!-- random image -->
                <div class="caption left-align">
                    <h3><?= $data_portal->judul_3; ?></h3>
                    <!-- <h5 class="light grey-text text-lighten-3">Desa Ciangir</h5> -->
                </div>
            </li>
        </ul>
    </div>

    <!-- about us -->
    <section id="about" class="about scrollspy">
        <div class="container">
            <div class="row">
                <h3 class="center light grey-text text-darken-3">Tentang</h3>
                <div class="col m6 light">
                    <h5>BUMDes Karya Mandiri</h5>
                    <p><?= $data_portal->deskripsi; ?></p>
                </div>
                <!-- <div class="col m6">
                    <img src="<?= base_url('assets/img/portal/orang.svg') ?>" alt="" width="600" height="250">
                </div> -->
            </div>
            <div class="row center">
                <div class="col s12 m2 center">
                </div>
                <div class="col s12 m8 center">
                    <div class="card center">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator center" src="<?= base_url('assets/img/portal/') . $data_portal->struktur_organisasi; ?>">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Struktur Organisasi<i class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Informasi Kontak<i class="material-icons right">close</i></span>
                            <p>Kepala Desa : <?= $data_portal->info_kepdes; ?></p>
                            <p>Ketua : <?= $data_portal->info_ketua; ?></p>
                            <p>Pengawas : <?= $data_portal->info_pengawas; ?></p>
                            <p>Bendahara : <?= $data_portal->info_bendahara; ?></p>
                            <p>Sekretaris : <?= $data_portal->info_sekretaris; ?></p>
                            <p>Kepala Unit : <?= $data_portal->info_kepunit; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m2 center">

                </div>
            </div>
        </div>
    </section>

    <!-- clients -->

    <!-- services -->
    <section id="services" class="services grey lighten-3 scrollspy">
        <div class="container">
            <div class="row">
                <h3 class="light center grey-text text-darken-3">Melayani</h3>
                <div class="col m4 s12">
                    <div class="card-panel center">
                        <i class="material-icons medium">local_grocery_store</i>
                        <h5>Sembako</h5>
                        <p>Menyediakan aneka macam sembako, seperti minuman, indomie, bahan masakan, gas, dll.</p>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card-panel center">
                        <i class="material-icons medium">account_balance_wallet</i>
                        <h5>Pembayaran</h5>
                        <p>Melayani pembayaran seperti shopeepay, ovo, dana, bpjs, tagihan listrik, dll.</p>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card-panel center">
                        <i class="material-icons medium">local_printshop</i>
                        <h5>Foto Copy</h5>
                        <p>Melayani print file, foto copy, laminating, dan menjual alat tulis. <br><br></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- portfolio -->

    <!-- contact us -->
    <section id="contact" class="contact grey lighten-3 scrollspy">
        <div class="container">
            <h3 class="light grey-text text-darken-3 center">Kontak</h3>
            <div class="row center">
                <div class="col s12 m2 center">
                </div>
                <div class="col s12 m8 center">
                    <div class="card center">
                        <div class="col m12">
                            <div class="card-panel teal lighten-1 white-text center">
                                <i class="material-icons">email</i>
                                <h5>Kontak</h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, illo!</p>
                            </div>
                            <ul class="collection with-header">
                                <li class="collection-header center">
                                    <h5>Alamat Kantor</h5>
                                </li>
                                <li class="collection-item center">BUMDes Karya Mandiri</li>
                                <li class="collection-item center">Dusun 1 Rt 01 Rw 01</li>
                                <li class="collection-item center">Kuningan Jawa Barat</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col s12 m2 center">

                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="teal lighten-2 white-text center">
        <h2 class="flow-text">BUMDes Karya Mandiri. Copyright 2021.</h2>
    </footer>


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="<?= base_url('assets/js/materialize.min.js') ?>"></script>
    <script>
        const sideNav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sideNav);

        const slider = document.querySelectorAll('.slider');
        M.Slider.init(slider, {
            indicators: false,
            height: 500,
            transition: 600,
            interval: 3000
        });

        const parallax = document.querySelectorAll('.parallax');
        M.Parallax.init(parallax);

        const materialboxed = document.querySelectorAll('.materialboxed');
        M.Materialbox.init(materialboxed);

        const scroll = document.querySelectorAll('.scrollspy');
        M.ScrollSpy.init(scroll, {
            scrollOffset: 50
        });

        const drop = document.querySelectorAll('.dropdown-trigger');
        M.Dropdown.init(drop);
    </script>
</body>

</html>