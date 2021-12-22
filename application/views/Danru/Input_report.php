<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
        </div>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
    <div class="row">
        <div class="container-md-3">
            <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">
                <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>
            </div>
        </div>
        <div class="graph-wr">
            <!-- <canvas id="myChart"></canvas> -->
            <form action="#" id="upload" method="post" enctype="multipart/form-data">
                <input type="hidden" name="plan" value="VLC">
                <div class="form-group">
                    <textarea placeholder="Keterangan Kondisi" name="keterangan" id="keterangan"></textarea>
                </div>

                <div class="form-group">
                    <input type="file" id="file" name="file" accept="image/*">
                </div>

                <button id="submitBtn" type="submit" class="btn btn-primary">Submit Patroli</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#upload").on('submit', function(e) {
            e.preventDefault();
            if ($("#keterangan").val() == "") {
                alert("keterangan kosong");
            } else if ($("#file").val() == "") {
                alert('documentasi masih kosong')
            } else {

                $.ajax({
                    url: "<?= base_url('Danru/Patrol/submit/') ?>",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        $("#submitBtn").attr('disabled', true);
                    },
                    complete: function() {
                        $("#submitBtn").attr('disabled', false);
                    },
                    success: function(e) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Report di Kirim',
                            icon: 'success',
                        }).then(function() {
                            window.location = "<?= base_url('Danru/Patrol') ?>"
                        })
                    }
                })
            }
        })
    })
</script>