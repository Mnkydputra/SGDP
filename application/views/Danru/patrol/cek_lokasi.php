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
            <div class="card mb-5">
                <div class="card-body">
                    <div class="graph-wr">
                        <!-- <canvas id="myChart"></canvas> -->
                        <form action="<?= base_url('Danru/Patrol_v2/submit/')  ?>" onsubmit="return onCek() " id="upload" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="plan" placeholder="nama lokasi" value="<?= $plan->lokasi ?>">
                            <div class="form-group">
                                <input type="hidden" name="area_kerja" placeholder="nama plant" value="<?= $plan->id_plan ?>">
                                <input type="hidden" placeholder="id lokasi" id="idLokasi" name="idLokasi" value="<?= $plan->id ?>">
                                <input type="hidden" name="id_events" id="id_events" placeholder="id_events" value="<?= $id_events ?>">
                                <input type="hidden" placeholder="shift" name="shift" value="<?= $shift ?>">
                                <input type="hidden" placeholder="tanggal" name="tanggal_events" value="<?= $tanggal_events ?>">
                                <textarea cols="41" placeholder="Keterangan Kondisi" name="keterangan" id="keterangan"></textarea>
                            </div>
                            <?php for ($i = 1; $i <= 2; $i++) : ?>
                                <!-- <label>Documentasi</label> -->
                                <input type="file" class="mb-1" id="file<?= $i ?>" name="file<?= $i ?>" accept="image/*">
                            <?php endfor; ?>
                            <button id="submitBtn" style="width:100%;display:block" type="submit" class="mb-4 mt-3 btn btn-success">Report Kondisi </button>
                        </form>
                        <div id="infoTunggu" class="alert  alert-info mt-2" style="display:none">
                            <center>
                                <label>tunggu proses upload selesai</label>
                            </center>
                        </div>
                    </div>
                </div>
                </form>
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
        })
        // $('select[name=situasi').on('change', function() {
        //     var id = $("select[name=situasi] option:selected").val();
        //     // console.log(id);
        //     if (id == null || id == "") {
        //         document.getElementById("formTemuan").innerHTML = "";
        //     } else {
        //         $.ajax({
        //             url: "<?= base_url('Danru/Patrol_v2/formKondisi') ?>",
        //             method: "POST",
        //             data: "kondisi=" + id,
        //             cache: false,
        //             success: function(e) {
        //                 document.getElementById("formTemuan").innerHTML = e;
        //             }
        //         })
        //     }
        // });
    })
</script>