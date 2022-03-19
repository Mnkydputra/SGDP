<!DOCTYPE html>
<html lang="en">

<head>
    <title>I - SECURITY</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="kT6HzKD1Qm2Fp0Uh24SdjRoIMmLMmM2amx8pd11VSqM" />
    <link rel="icon" type="image/png" href="../assets/img/icons/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>



    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/icon.png">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>style2.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">

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
    <!-- DATATABLES -->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">-->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <!-- IMASK CDN -->
    <script src="https://unpkg.com/imask@6.2.2/dist/imask.js"></script>
    <script src="<?= base_url('assets/dist/') ?>jquery-qrcode.js"></script>
    <!-- API LOCATION -->
    <script src="<?= base_url('assets/js/') ?>songof.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/') ?>instascan.min.js"></script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>

    <script src=" <?= base_url('assets/js/') ?>geo-min.js" type="text/javascript" charset="utf-8">
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>dd.css?v=4.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/') ?>flags.css?v=1.0" />

    <!-- scan barcode  -->
    <!-- <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script> -->
    <script type="text/javascript" src="<?= base_url('assets/js/') ?>Zxing.min.js"></script>
    <!--  end -->

    <!-- jquery confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- end jquery confirm -->
    <style>
        /* #rfidcard {
            position: absolute;
            width: 0;
            opacity: 0;
        } */
    </style>
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
                    <?php if ($berkas->foto == null) { ?>
                        <img style="border:solid; color:#cbced1;" class="rounded-circle float-end" src="<?= base_url('assets/img/icon-header.png') ?>" alt="avatar" width=76; height=76;>
                    <?php } else { ?>
                        <img style="border:solid; color:#cbced1;" class="rounded-circle float-end" src="<?= base_url('assets/berkas/Poto/') . $berkas->foto ?>" alt="avatar" width=76; height=76;>
                    <?php } ?>

                </a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul style="float:right;" class="navbar-nav px-1 mx-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('Profile/') ?>Foto"><span>Foto Profil</span></a>
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