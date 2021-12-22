<!DOCTYPE html>
<html lang="en">

<head>
    <title>SGDP | POCKET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../assets/img/icons/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/icon.png">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.css.map">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap-grid.css.map">
    <!-- DatePicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <!-- End Chart -->
    <!-- Datepicker CDN -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- CDN Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END CDN Bootstrap -->
    <!-- SWEET ALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- IMASK CDN -->
    <script src="https://unpkg.com/imask"></script>
    <script src="<?= base_url('assets/dist/')?>jquery-qrcode.js"></script>
    <!-- API LOCATION -->
    <script src="<?= base_url('assets/js/') ?>songof.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/') ?>instascan.min.js"></script>
</head>

<body style="background-color:#F9FAFA">
    <!-- HEADER -->
    <div class="container-md-3 fixed-top">
        <nav style="background-color:#F9FAFA; border-style:none;" class="navbar navbar-expand-lg roundedmurry1 navbar-light  ">
            <div class="container-fluid">
                <a id="brand" class="navbar-brand" href="#">
                    <img style="background-color:#F9FAFA;  border-style:none;" class="img-thumbnail" src="<?= base_url('assets/img/') ?>Group_2.png" alt="brand" width=156; height=67;>
                </a>
                <a style="border-style:none" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <img style="border:solid; color:#cbced1" class="img-thumbnail rounded-pill mt-2" src="<?= base_url('assets/berkas/Poto/') . $berkas->foto ?>" alt="avatar" height=67px; width=67px;>
                </a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul style="float:right;" class="navbar-nav px-1 mx-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('Anggota/Profile/') ?>Foto"><span>Foto Profil</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('LogOut') ?>"><span>Keluar</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- END HEADER -->