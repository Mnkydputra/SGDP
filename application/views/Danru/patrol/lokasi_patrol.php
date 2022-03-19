<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
        </div>
        <a style="position:relative;width:100%" class="fixed-top btn btn-danger btn-sm mb-2" href="#">
            <span class="bx bx-street-view"></span> I - PATROL
        </a>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
    <div class="row">
        <div class="graph-wr  mb-5">

            <br>
            <br>
            <?php if ($this->session->flashdata('info')) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('info') ?>
                    <?php $this->session->unset_userdata("info") ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <a id="infoUpdate" data-refresh="<?= base_url('Danru/Patrol') ?>" data-url="<?= base_url("Danru/Patrol/updateStatus/") ?>" href='javascript:reset()' class="btn btn-sm btn-danger">Kirim Hasil Patroli</a> -->
            <?php } ?>
            <div class="card mb-5">
                <div class="card-header text-right">
                    <span id="time_patrol"></span>
                </div>
                <div class="card-body">

                    <input type="hidden" name="id_events" id="id_events" value="<?= $id_events ?>">
                    <?php foreach ($titik->result() as $ttk) :
                        if ($ttk->status == 1) { ?>
                            <a href="#" class="mb-1 text-left btn btn-success col-lg-12 " data-toggle="dropdown" id="camera" aria-haspopup="true">
                                <?= $ttk->lokasi ?>
                            </a>

                        <?php } else if ($ttk->status == 0) { ?>
                            <a href="javascript:modal_camera('<?= $ttk->id ?>')" class="mb-1 text-left btn btn-secondary col-lg-12 btn-sm" data-modal="<?= base_url('Danru/Patrol_v2/modal_camera') ?>" id="camera" data-toggle="dropdown" aria-haspopup="true">
                                <?= $ttk->lokasi ?>
                                <i class="bx bx-send" style="position:relative;display:flex-inline"></i>
                            </a>
                        <?php }
                        ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    //


    //tampilkan  detail handheld kedalam modal jquery confirm
    function modal_camera(id) {
        var linkModal = $("#camera").attr("data-modal");
        var id_events = document.getElementById("id_events").value;
        $.confirm({
            title: 'Scan Barcode Disini!',
            content: function() {
                var self = this;
                return $.ajax({
                    url: "<?= base_url('Danru/Patrol_v2/modal_camera/') ?>" + id + "/" + id_events,
                    dataType: 'html',
                    method: 'get'
                }).done(function(response) {
                    self.setContentAppend(response);
                })
            },
            buttons: {
                close: {
                    btnClass: 'btn-blue',
                    action: function() {
                        scanner.stop();
                    }
                }
            },
            columnClass: 'col-lg-12',
        });
    }

    // timer patroli
    //jika status 1 maka artinya patroli sudah di mulai
    var shift = <?= $shift ?>;
    var skrg = "<?= strtotime(date('H:i:s')) ?>";

    //j
    var batas_shift1 = "<?= strtotime('18:00:00') ?>";
    var batas_shift2 = "<?= strtotime('06:00:00') ?>";
    if (batas_shift1 > skrg) {
        console.log("shift 2 sekarang");
    }
    if (shift == 1) {
        jamakhir = "<?= strtotime("18:00:00") ?>";
    } else if (shift == 2) {
        jamakhir = "<?= strtotime("06:00:00") ?>";
    }
    // var jamakhir = "<?= strtotime("2022-02-11 06:00:00") ?>";
    var countDownDate;
    countDownDate = parseInt(jamakhir) * 1000;
    var now = <?php echo time() ?> * 1000;
    // console.log(countDownDate);
    // console.log(shift);
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get todays date and time
        now = now + 1000;

        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);


        // Output the result in an element with id="demo"
        document.getElementById("time_patrol").innerHTML = hours + "j " +
            minutes + "m " + seconds + "s ";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            console.log("patroli selesai");
            // window.location.href = "<?= base_url("Danru/Patrol_v2/resetTime/" . $employee->area_kerja)  ?>"
        }

    }, 1000);
    // end of timer patroli
</script>