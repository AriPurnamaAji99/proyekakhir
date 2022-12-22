<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        section {
            min-height: 150px;
        }
    </style>

    <title><?= $title ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/portal/logo.png') ?>">
</head>

<body class="">
    <nav class="navbar  navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets/img/portal/logo.png') ?>" width="70" class="rounded-circle" height="60" alt="">
            </a>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('portal') ?>">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('portal') ?>#mitra">Mitra</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('portal') ?>#about">About</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('auth') ?>">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </nav>


    <div class="jumbotron">
        <div class="container text-center">
            <h2 class="display-5">Struktur Organisasi</h2>
            <hr class="my-4">
            <p><img src="<?= base_url('assets/img/portal/struktur.jpg') ?>" width="1000" height="300" alt=""></p>
        </div>
    </div>

    <section class="visi" id="visi">
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2>Visi</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 text-center">
                    <p>
                        Menjadi pendorong tumbuhnya usaha ekonomi dan kesejahteraan masyarakat Desa Malausma yang berkelanjutan dengan menjadikan Desa Malausma sebagai sentra perdagangan ,jasa ,
                        pertanian dan industri kerakyatan yang kuat menuju masyarakat sejahtera , cerdas, sehat, dan terampil melalui pengembangan usaha ekonomi,
                        peningkatan kapasitas dan kompetensi sumberdaya dan kelembagaan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="misi" id="misi">
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2>Misi</h2>
                </div>
            </div>
            <div class="row mb-10 justify-content-center">
                <div class="col-md-5 text-center">
                    <p>
                        Memanfaatkan potensi sumber daya manusia yang ada di desa sebagai aset penggerak ekonomi lokal; <br>
                        Mendorong Tumbuhnya Inisiatif Dan Inovasi Produk Lokal, Sehingga Memiliki Daya Saing Yang Tinggi Baik Pada Tingkat Nasional, Regional Maupun lokal; <br>
                        Meningkatkan Kompetensi Dan Daya Saing Usaha Pedesaan Secara Mandiri Dan Profesional; <br>
                        Mewujudkan Sinergi Dan Jejaring Antar BUMDES Dan Usaha Lain Dalam Meningkatkan Hubungan Yang Saling Menguntungkan; <br>
                        Meningkatkan ketahanan ekonomi dengan menggalakkan usaha ekonomi kerakyatan melalui program setrategis di bidang produksi pertanian, pemasaran, usaha kecil dan menengah <br>
                        Meningkatkan partisipasi masyarakat dalam pembangunan sehingga dapat menumbuh kembangkan kesadaran dan kemandirian dalam pembangunan desa yang berkelanjutan; <br>
                        Menciptakan suasana yang aman dan tertib dalam kehidupan bermasyarakat; <br>
                        Menciptakan masyarakat desa yang dinamis, sejahtera dan berbudaya; <br>
                        Menciptakan lapangan kerja bagi masyarakat kurang mampu yang ada didesa; <br>
                        Pengembangan usaha ekonomi melalui usaha simpan pinjam dan usaha sektor riil;
                    </p>
                </div>
            </div>
        </div>
    </section>





    <footer class="bg-primary text-white">
        <div class="container">
            <div class="row pt-3">
                <div class="col text-center">
                    <p>Copyright &copy; BUMDes Karya Mandiri <?= date('Y') ?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>