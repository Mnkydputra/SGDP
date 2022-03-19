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
                    <h4 class="my-0 font-weight-normal">Edit Presensi</h4>
                </div>

                <form action="" method="post" id="searchAbsensi">
                    <input type="text" id="datepicker" placeholder="tanggal" class="form-control">
                    <input type='text' class="form-control" id='datetimepicker1' />
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <select name="npk" id="npk" class="select2 form-control">
                                <option value="">Pilih SG</option>
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="Wilayah">Wilayah</label>
                            <input type="text" name="wilayah" placeholder="Wilayah" class="form-control" readonly id="wilayah">
                        </div>

                        <div class="form-group mb-1">
                            <label for="Area">Area</label>
                            <input type="text" name="area" placeholder="Area Kerja" class="form-control" readonly id="area">
                        </div>

                        <div class="form-group mb-1">
                            <label for="Wilayah">Bulan</label>
                            <select name="bulan" class="form-control" id="bulan">
                                <option value="">Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Maret</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <button style="display: none;" id="showBTN" class="btn btn-primary">Cari Presensi</button>
                        <label for="" style="display: none;" id="loadpresensi" class="text-danger small">sedang mengambil data . . . </label>
                        <hr>
                        <div id="showHasil">
                            <!-- tampilkan data absen disini -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal untuk update absen anggota -->
    <!-- Modal -->
    <div class="modal fade" id="editAbsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="edit_Absen">
                        <div class="form-group">
                            <label for="">IN</label>
                            <input type="text" class="form-control" id="in" name="in">
                        </div>
                        <div class="form-group">
                            <label for="">OUT</label>
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="tabel" name="tabel">
                            <input type="text" class="form-control" id="out" name="out">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                <option>HADIR</option>
                                <option>MANGKIR</option>
                                <option>IJIN</option>
                                <option>SAKIT</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submitAbsen" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- form edit data absensi -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            //munculkan nama dan npk anggota kedalam select option
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
                        }
                    })
                }
            });

            // show tombol cari jika bulan di pilih
            $('select[name=bulan]').on('change', function() {
                var bulan = $(this).children("option:selected").val();
                if (bulan == null || bulan == "") {
                    document.getElementById("showBTN").style.display = "none";
                } else {
                    document.getElementById("showBTN").style.display = "block";
                }
            });

            // tampilkan data absensi ketika tombol submit di tekan
            $("#searchAbsensi").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('Superadmin/Presensi/showAbsensi') ?>",
                    data: new FormData(this),
                    method: "POST",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        document.getElementById("loadpresensi").style.display = "block";
                    },
                    complete: function() {
                        document.getElementById("loadpresensi").style.display = "none";
                    },
                    success: function(e) {
                        document.getElementById("showHasil").innerHTML = e;
                    }
                })

            })

            // tampilkan data modal 
            $("#editAbsen").on("show.bs.modal", function(event) {
                var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
                var modal = $(this);
                // Isi nilai pada field
                modal.find("#id").attr("value", div.data("id"));
                if (div.data("in_date") == "") {
                    modal.find("#in").attr("value", "");
                } else {
                    modal.find("#in").attr("value", div.data("in_date") + " " + div.data("in_time"));
                }
                if (div.data("out_date") == "") {
                    modal.find("#out").attr("value", "");
                } else {
                    modal.find("#out").attr("value", div.data("out_date") + " " + div.data("out_time"));
                }
                modal.find("#tabel").attr("value", div.data("tabel"));
            });

            //update data absensi 
            $("#edit_Absen").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('Superadmin/Presensi/update_absensi') ?>",
                    method: "POST",
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(e) {
                        alert(e);
                        // if (e == "berhasil") {
                        //     alert("presensi di perbaharui , klik button cari presensi untuk lihat perubahan");
                        // } else {
                        //     alert("Tidak ada perubahan");
                        // }
                    }
                })

            })
        });
    </script>
</body>

</html>