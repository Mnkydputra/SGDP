<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="kT6HzKD1Qm2Fp0Uh24SdjRoIMmLMmM2amx8pd11VSqM" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/icon.png">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>style2.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap-grid.min.css">
  <!-- DatePicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
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
  <script src="<?= base_url('assets/js/') ?>songof.js"></script>



  <title>I - SECURITY</title>
</head>

<body style="background-color:#e3e3e1; margin:0;">
  <!-- Header -->
  <div class="container-fluid">
    <nav style="height:60px; padding-top:0; background-color: #f2f2e9;" class="navbar navbar-expand-lg navbar-light  fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img height="40px" src="<?= base_url('assets/img/') ?>Group_2.png" alt="brand"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('Sipd/') ?>Dashboard">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Sipd/') ?>Anggota">Anggota</a>
            </li>
          </ul>
          <div class="d-flex" style="display: none; list-style:none;">
            <li class="nav-item dropdown" style="list-style:none; ">
              <a class="nav-link dropdown-toggle" href="#" id="navProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($berkas->foto == null) { ?>
                  <img style="border:solid; color:#cbced1" class="img-thumbnail rounded-pill mt-2" src="<?= base_url('assets/img/icon-header.png') ?>" alt="avatar" height=55px; width=55px;>
                <?php } else { ?>
                  <img style="border:solid; color:#cbced1" class="img-thumbnail rounded-pill mt-2" src="<?= base_url('assets/berkas/Poto/') . $berkas->foto ?>" alt="avatar" height=55px; width=55px;>
                <?php } ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navProfile">
                <li>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <a class="dropdown-item" aria-current="page" href="<?= base_url('Anggota/Profile/') ?>Foto"><span>Foto Profil</span></a>
                  <?php } else if ($this->session->userdata('role_id') == 2) { ?>
                    <a class="dropdown-item" aria-current="page" href="<?= base_url('Danru/Profile/') ?>Foto"><span>Foto Profil</span></a>
                  <?php } else if ($this->session->userdata('role_id') == 3) { ?>
                    <a class="dropdown-item" aria-current="page" href="<?= base_url('Korlap/Profile/') ?>Foto"><span>Foto Profil</span></a>
                  <?php } else if ($this->session->userdata('role_id') == 4) { ?>
                    <a class="dropdown-item" aria-current="page" href="<?= base_url('Sipd/Profile/') ?>Foto"><span>Foto Profil</span></a>
                  <?php } else if ($this->session->userdata('role_id') == 5) { ?>
                    <a class="dropdown-item" aria-current="page" href="<?= base_url('PIC/Profile/') ?>Foto"><span>Foto Profil</span></a>
                  <?php } ?>
                </li>
                <li>
                  <hr class="dropdown-divider  ">
                </li>
                <li>
                  <a class="dropdown-item" aria-current="page" href="<?= base_url('LogOut') ?>"><span>Keluar</span></a>
                </li>
              </ul>
            </li>

          </div>
        </div>
      </div>
    </nav>
  </div>
  <!-- ENF OF HEADER -->