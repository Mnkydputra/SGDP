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
<link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.css.map">
<link rel="stylesheet" href="<?= base_url('assets/css/')?>style.css">
<link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap-grid.css.map">
<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<!-- End Chart -->
</head>
<body style="background-color:#717D7F">
<!-- CONTENT -->
          <div class="container-md-3 mt-5 ps-3 pe-3 ">
              <div class="text-center align-center"><img src="<?= base_url('assets/img/')?>login.png" alt="login" width="150" height="150"></div>
              <br>  
              <div class="container border border-dark">
                <div class="row">
                        <h4 class="text-center">LOGIN</h4>
                        <form action="<?= base_url('Login/')?>cekLogin" class="form-group" method="post">
                            <div class="col-auto">
                            <label for="npk">Nomor Pokok karyawan</label>
                             <input type="text" class="form-control" id="npk" name="npk" placeholder="Masukan Nomor NPK Anda" >
                            </div> <br>
                            <div class="col-auto">
                            <label for="pass">Password</label>
                             <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukan Nomor Password Anda" >
                            </div> <br>
                            <div class="col-auto">
                            <button style="float:right;" class="btn btn-info" type="submit"><b>LOGIN</b></button>
                            </div>
                        </form>
                </div>
                <br>
            </div>              
          </div>
<!-- END CONTENT -->
<!-- FOTTER -->
</body>
<script src="<?= base_url('assets/js/')?>bootstrap.js"></script>
<script src="<?= base_url('assets/js/')?>bootstrap.min.js"></script>
<script src="<?= base_url('assets/js/')?>bootstrap.bundle.js"></script>
<script src="<?= base_url('assets/js/')?>bootstrap.bundle.min.js"></script>
</html>
<!-- END FOTTER -->