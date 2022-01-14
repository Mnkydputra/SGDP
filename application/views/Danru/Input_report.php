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
                <input type="hidden" name="plan" value="<?= $plan->lokasi ?>">
                <div class="form-group">
                    <input type="hidden" name="area_kerja" value="<?= $plan->id_plan ?>">
                    <input type="hidden" id="urutan" name="urutan" value="<?= $plan->urutan ?>">
                    <input type="hidden" id="idLokasi" name="idLokasi" value="<?= $plan->id ?>">
                    <textarea cols="42" placeholder="Keterangan Kondisi" name="keterangan" id="keterangan"></textarea>
                </div>
                <?php for ($i = 1; $i <= 2; $i++) : ?>
                    <!-- <label>Documentasi</label> -->
                    <input type="file" id="file<?= $i ?>" name="file<?= $i ?>" accept="image/*">
                <?php endfor; ?>
                <button id="submitBtn" style="width:100%" type="submit" class="mb-4 mt-3 btn btn-danger">Submit Patroli</button>
            </form>
            <div id="infoTunggu" class="alert  alert-info mt-2" style="display:none">
                <center>
                    <label>tunggu proses upload selesai</label>
                </center>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#upload").on('submit', function(e) {
            e.preventDefault();
            if ($("#keterangan").val() == "") {
                Swal.fire({
                    title: 'Attention!',
                    text: 'Keterangan kosong',
                    icon: 'error',
                })
            } else if ($("#file1").val() == "") {
                Swal.fire({
                    title: 'Attention!',
                    text: 'Isi gambar Selfie',
                    icon: 'error',
                })
            } else if ($("#file2").val() == "") {
                Swal.fire({
                    title: 'Attention!',
                    text: 'Documentasi Area Kosong',
                    icon: 'error',
                })
            } else if ($("#file3").val() == "") {
                Swal.fire({
                    title: 'Attention!',
                    text: 'Documentasi Area Kosong',
                    icon: 'error',
                })
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
                        document.getElementById('infoTunggu').style.display = "block";
                    },
                    complete: function() {
                        $("#submitBtn").attr('disabled', false);
                        document.getElementById('infoTunggu').style.display = "none";
                    },
                    success: function(e) {
                        // console.log(e);
                        const urut = document.getElementById('urutan').value;
                        const hasil = parseInt(urut) + 1;
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Report di Kirim',
                            icon: 'success',
                        }).then(function() {
                            window.location = "<?= base_url('Danru/Patrol/') ?>"
                        })
                    }
                })
            }
        })
    })
</script>