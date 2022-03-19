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
            <div class="card mb-5">
                <div class="card-body">

                    <form action="<?= base_url('Danru/Patrol/submit/')  ?>" onsubmit="return onCek() " id="upload" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="plan" value="<?= $plan->lokasi ?>">
                        <div class="form-group">
                            <input type="text" name="shift" value="<?= $shift ?>">
                            <input type="hidden" name="area_kerja" value="<?= $plan->id_plan ?>">
                            <input type="hidden" id="urutan" name="urutan" value="<?= $plan->urutan ?>">
                            <input type="hidden" id="idLokasi" name="idLokasi" value="<?= $plan->id ?>">
                            <textarea cols="41" placeholder="Keterangan Kondisi" name="keterangan" id="keterangan"></textarea>
                        </div>
                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                            <!-- <label>Documentasi</label> -->
                            <input type="file" class="mb-1" id="file<?= $i ?>" name="file<?= $i ?>" accept="image/*">
                        <?php endfor; ?>
                        <button id="submitBtn" style="width:100%;display:block" type="submit" class="mb-4 mt-3 btn btn-danger">Submit Patroli</button>
                    </form>
                    <div id="infoTunggu" class="alert  alert-info mt-2" style="display:none">
                        <center>
                            <label>tunggu proses upload selesai</label>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function onCek() {
        var file1 = document.getElementById("file1").value;
        var file2 = document.getElementById("file2").value;
        var ket = document.getElementById("keterangan").value;

        if (ket == null || ket == "") {
            Swal.fire({
                title: 'Attention!',
                text: 'Keterangan kosong',
                icon: 'error',
            });
            return false;
        } else if (file1 == null || file1 == "") {
            Swal.fire({
                title: 'Attention!',
                text: 'Gambar Pertama Kosong',
                icon: 'error',
            });
            return false;
        } else if (file2 == null || file2 == "") {
            Swal.fire({
                title: 'Attention!',
                text: 'Gambar Kedua Kosong',
                icon: 'error',
            });
            return false;
        }
    }

    $(function() {
        $("#upload").on('submit', function(e) {
            if ($("#keterangan").val() != "" && $("#file1").val() != "" && $("#file2").val() != "") {
                document.getElementById('infoTunggu').style.display = "block";
            }
            //     e.preventDefault();
            //     if ($("#keterangan").val() == "") {
            //         Swal.fire({
            //             title: 'Attention!',
            //             text: 'Keterangan kosong',
            //             icon: 'error',
            //         })
            //     } else if ($("#file1").val() == "") {
            //         Swal.fire({
            //             title: 'Attention!',
            //             text: 'Isi gambar Selfie',
            //             icon: 'error',
            //         })
            //     } else if ($("#file2").val() == "") {
            //         Swal.fire({
            //             title: 'Attention!',
            //             text: 'Documentasi Area Kosong',
            //             icon: 'error',
            //         })
            //     } else if ($("#file3").val() == "") {
            //         Swal.fire({
            //             title: 'Attention!',
            //             text: 'Documentasi Area Kosong',
            //             icon: 'error',
            //         })
            //     } else {

            //         $.ajax({
            //             url: "<?= base_url('Danru/Patrol/submit/') ?>",
            //             method: "POST",
            //             data: new FormData(this),
            //             processData: false,
            //             contentType: false,
            //             cache: false,
            //             beforeSend: function() {
            //                 // $("#submitBtn").attr('disabled', true);
            //                 document.getElementById('submitBtn').style.display = "none";
            //                 document.getElementById('infoTunggu').style.display = "block";
            //             },
            //             complete: function() {
            //                 $("#submitBtn").attr('disabled', false);
            //                 document.getElementById('submitBtn').style.display = "block";
            //                 document.getElementById('infoTunggu').style.display = "none";
            //             },
            //             success: function(e) {
            //                 // console.log(e);
            //                 Swal.fire({
            //                     title: 'Sukses!',
            //                     text: 'Report di Kirim',
            //                     icon: 'success',
            //                 }).then(function() {
            //                     window.location = "<?= base_url('Danru/Patrol/') ?>"
            //                 })
            //             }
            //         })
            //     }
        })
    })
</script>