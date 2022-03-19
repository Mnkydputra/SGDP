<!doctype html>
<html lang="en">

<head>
	<title>SGDP POCKET</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/icon.png">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.css.map">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap-grid.css.map">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">
	<!-- Jquery CDN -->
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		body {
			background-image: url(<?= base_url('assets/img/') ?>bckground.jpg);
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
					<img class="heading-section" src="<?php echo base_url('assets/img/') ?>Login.png" width="150" height="150" alt="brand">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center text-dark"><b>UPDATE PASSWORD</b></h3>
						<form action="<?= base_url('Login/') ?>UpdatePassword" method="post" class="signin-form" onsubmit="return valid()">
							<div class="form-group">
								<input type="text" class="form-control text-dark" id="npk" name="npk" placeholder="Masukan Nomor NPK Anda" value="<?= $akun->npk ?>">
							</div>
							<div class="form-group">
								<input id="password1" name="password1" type="password" class="form-control text-dark" placeholder="Masukan Password Baru Anda">
								<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<input id="password2" name="password2" type="password" class="form-control text-dark" placeholder="Masukan Password Baru Anda Kembali">
								<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Update</button>
							</div>
							<div class="form-group d-md-flex">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url('assets/js/') ?>bootstrap.min.js"></script>
	<script src="<?= base_url('assets/js/') ?>popper.js"></script>
	<script src="<?= base_url('assets/js/') ?>main.js"></script>
	<?php if ($this->session->flashdata('update')) { ?>
		<script type="text/javascript">
			Swal.fire({
				icon: "warning",
				title: "PASSWORD!!",
				text: "Mohon Perbarui Password Anda!!",
				dangerMode: [true, "OK"]
			})
		</script>

	<?php } ?>
</body>


<script>
	function valid() {
		var pw1 = document.getElementById("password1").value;
		var pw2 = document.getElementById("password2").value;
		if (pw1 == null || pw1 == "") {
			Swal.fire({
				icon: "warning",
				title: "Perhatian",
				text: " isi password yang pertama anda!!",
			}).then(function() {

			})
			return false;
		} else if (pw2 == null || pw2 == "") {
			Swal.fire({
				icon: "warning",
				title: "Perhatian",
				text: " isi password yang kedua anda!!",
			}).then(function() {

			})
			return false;
		}
	}
</script>

</html>