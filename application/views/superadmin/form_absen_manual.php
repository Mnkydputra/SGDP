<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Superadmin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/su/') ?>dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- select 2 css js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- end of select 2 css js -->
    <!-- font aweseom -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- font aweseom -->
    <!-- bootstrap date picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- end datepicker -->

    <!-- datetimepicker  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/css/su/') ?>bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/su/') ?>bootstrap-datetimepicker.min.css" />
    <!-- datetimepicker  -->
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 mr-4 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">I-SECURITY</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Home</a>
            <a class="p-2 text-dark" href="#">Presensi</a>
            <a class="p-2 text-dark" href="#">I-Patrol</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Logout</a>
    </div>
    <div class="container">
        <div class="card-deck mb-3">
            <?php if ($this->session->flashdata('ok')) {  ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('ok') ?>
                    <a data-dismiss="alert"><span aria-hidden="true">&times;</span></a>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
                </div>
            <?php } else if ($this->session->flashdata('fail')) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('fail') ?>
                    <a data-dismiss="alert" class="close"><span aria-hidden="true">&times;</span></a>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
                </div>
            <?php } ?>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Input Presensi</h4>
                </div>
                <form onsubmit="return validasi()" action="<?= base_url('Superadmin/Presensi/input_absensi_manual') ?>" method="post" id="searchAbsensi">
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <select name="npk" id="npk" class="select2 form-control">
                                <option value="">Pilih SG</option>
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="Wilayah">Wilayah</label>
                            <input type="text" name="wilayah" placeholder="Wilayah" class="form-control" readonly id="wilayah">
                            <input type="hidden" name="id_absen" placeholder="id absen" class="form-control" readonly id="id_absen">
                        </div>

                        <div class="form-group mb-1">
                            <label for="Area">Area</label>
                            <input type="text" name="area" placeholder="Area Kerja" class="form-control" readonly id="area">
                        </div>
                        <div class="form-group mb-1">
                            <label for="Wilayah">Jam Masuk</label>
                            <input type="hidden" name="tabel" id="tabel">
                            <input type="text" name="in" placeholder="<?= date('Y-m-d H:i:s') ?>" class="form-control" id="in">
                        </div>
                        <button id="showBTN" class="btn btn-primary btn-sm">Input Absensi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#in').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
            });

            $('.select2').select2({
                ajax: {
                    url: '<?= base_url('Superadmin/Presensi/listAnggota') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            nama: params.term
                        }
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.npk,
                                text: item.nama + "-" + item.npk
                            })
                        })
                        return {
                            results: results
                        };
                    },
                    cache: true
                }
            });


            // get data wilayah dan area kerja anggota
            $('select[name=npk]').on('change', function() {
                var npk = $(this).children("option:selected").val();
                if (npk == null || npk == "") {
                    alert("error");
                } else {
                    $.ajax({
                        url: "<?= base_url('Superadmin/Presensi/listWilayahAnggota') ?>",
                        method: "POST",
                        data: "npk=" + npk,
                        success: function(e) {
                            const result = JSON.parse(e);
                            document.getElementById("wilayah").value = result[0].wilayah;
                            document.getElementById("area").value = result[0].area_kerja;
                            document.getElementById("id_absen").value = result[0].id_employee;
                        }
                    })
                }
            });


        });

        function validasi() {
            var wil = document.getElementById('wilayah').value;
            var jam = document.getElementById('in').value;
            if (wil == null || wil == "") {
                alert("field kosong");
            } else if (jam == null || jam == "") {
                alert("field kosong")
            };

            return;
        }
    </script>
</body>

</html>