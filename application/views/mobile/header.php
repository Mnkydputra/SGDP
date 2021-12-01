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
<!-- Jquery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<!-- End Chart -->
<script type="text/javascript">
    $(function()
    {
        setTimeout("displaytime()",1000);
    })
    function displaytime()
    {
        var dt = new Date();
        $('#time').html(dt.toLocaleTimeString('en-GB'));
        setTimeout("displaytime()",1000);       
    }
</script>
</head>
<body style="background-color:#F9FAFA">
<!-- HEADER -->
            <div class="container-md-3 fixed-top">
                <nav style="background-color:#F9FAFA; border-style:none;" class="navbar navbar-expand-lg roundedmurry1 navbar-light  ">
                    <div class="container-fluid">
                    <a id="brand" class="navbar-brand" href="#">
                        <img style="background-color:#F9FAFA;  border-style:none;" class="img-thumbnail"  src="<?= base_url('assets/img/')?>Group_2.png" alt="brand" width=156; height=67;>
                        </a>
                    <a href="#" > <img style="border:solid; color:#cbced1" class="img-thumbnail rounded-pill mt-3" src="<?= base_url('assets/') ?>img/anton.png" alt="avatar" height=67px; width=67px; >
                    </a>
                    </div>
                </nav>
            </div>
<!-- END HEADER -->
