<!doctype html>
<html lang="en">
  <head>
  	<title>I-SECURITY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/icon.png">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.css.map">
    <link rel="stylesheet" href="<?= base_url('assets/css/')?>style.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap-grid.css.map"> -->
	<link rel="stylesheet" href="<?= base_url('assets/css/')?>style.css">
    <!-- Jquery CDN --> 
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		body{
		background-image: url(<?= base_url('assets/img/')?>bckground.jpg);
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		width: 100%;
		height: 100%;
		}
	</style>
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				
                <div class="col-md-6 text-center mb-5">
					<img class="heading-section" width="125" height="125" src="<?php echo base_url('assets/img/')?>Login.png" alt="brand">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">LOGIN</h3>
		      	<form action="<?=  base_url('Login/')?>cekLogin" method="post"  class="signin-form">
		      		<div class="form-group">
					  <input type="text" class="form-control" id="npk" name="npk" placeholder="Masukan Nomor NPK Anda" >
		      		</div>
	           		 <div class="form-group">
						<input id="password" name="password" type="password" class="form-control" placeholder="Masukan Password Anda" >
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	           		 </div>
	           		 <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
							
                    </div>
                </form>
                </div>
                    </div>
			</div>
		</div>
	</section>

   <script src="<?= base_url('assets/js/')?>bootstrap.min.js"></script>
   <script src="<?= base_url('assets/js/')?>popper.js"></script>
   <script src="<?= base_url('assets/js/')?>main.js"></script>

    <?php if($this->session->flashdata('nonuser')){ ?>
	<script type="text/javascript">
		Swal.fire({
			icon : "warning",
			title : "Perhatian",
			text : "Akun Anda Belum Terdaftar",
			dangerMode : [true , "Ok"]
		})
	</script>
<?php }else if($this->session->flashdata('pass')) {?>
	<script type="text/javascript">
		Swal.fire({
			icon : "error",
			title : "Perhatian",
			text : "Password Salah",
			dangerMode : [true , "Ok"]
		})
	</script>
<?php }else if($this->session->flashdata('empty')) { ?>
	<script type="text/javascript">
		Swal.fire({
			icon : "error",
			title : "Perhatian",
			text : "akun tidak ada",
			dangerMode : [true , "Ok"]
		})
	</script>
<?php } ?>

<?php if($this->session->flashdata('salahPass')){?>
	<script type="text/javascript">
		Swal.fire({
			icon : "error",
			title : "Perhatian",
			text : "Password Salah",
			dangerMode :[true,"OK"]
		})
	</script>

<?php }?>


<?php if($this->session->flashdata('berhasil')){?>
	<script type="text/javascript">
		Swal.fire({
			icon : "success",
			title : "BERHASIL",
			text : "Password Anda Berhasil Di Ubah Silahkan Login",
			dangerMode :[true,"OK"]
		})
	</script>

<?php }?>
	</body>
</html>

