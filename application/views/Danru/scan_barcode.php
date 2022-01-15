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
        <!--<div class="container-md-3">-->
        <!--    <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">-->
        <!--        <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="graph-wr">
            <form id="formTikor" data-url="<?= base_url('Danru/Patrol/getPlan') ?>">
                <div id="dataPLAN" class="form-group" style="margin-top:45px">
                    <!-- isi plan nanti disini -->
                    <select class="form-control text-dark " name="area" id="area_kerja">
                        <option value="" data-icon="bx bx-street-view">Pilih Area </option>
                        <option value="P1" data-thumbnail="bx bx-street-view">PLAN 1 </option>
                        <option value="P2">PLAN 2</option>
                        <option value="P3">PLAN 3</option>
                        <option value="P4-ASSY1">PLAN 4 - ASSY 1</option>
                        <option value="P4-ASSY2">PLAN 4 - ASSY 2</option>
                        <option value="P5">PLAN 5</option>
                        <option value="VLC">VLC</option>
                        <option value="HO">HEAD OFFICE</option>
                        <option value="DOR">DORMITORY</option>
                        <option value="PC">PART CENTER</option>
                    </select>

                    <div class="mt-2" id="showLokasi">

                    </div>

                    <label class="text-danger small" style="display:none" id="infoScan">scanning barcode harap tunggu . . . </label>
                    <!--<label id="scanInfo" class="text-danger small scanInfo"><i>* scanning barcode . . . *</i></label>-->
                </div>
            </form>
            <div class="form-group ps-4 " style="margin-left:15%;position:relative">
                <video width="200" class="img-thumbnail" id="preview"></video>
            </div>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    function showMe(evt) {
        // console.log("evt.value ",evt.value);
    }

    function makeDd() {
        'use strict';
        let json = new Function(`return ${document.getElementById('json_data').innerHTML}`)();
        /*  new MsDropdown("#json_dropdown", {
              byJson: {
                  data: json, selectedIndex:1
              }
          })*/
        MsDropdown.make("#json_dropdown", {
            byJson: {
                data: json,
                selectedIndex: 0
            }
        });
    }


    // pilih plan dan titik barcode
    $(function() {
        // $('#mySelect').selectpicker();
        //pilih area kerja
        $('select[name=area').on('change', function() {
            var id = $("select[name=area] option:selected").val();
            // console.log(id);
            if (id == null || id == "") {
                document.getElementById("showLokasi").innerHTML = "";
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[2]);
                    } else {
                        console.error('No cameras found.');
                    }
                }).catch(function(e) {
                    console.error(e);
                });
            } else {
                $.ajax({
                    url: "<?= base_url('Danru/Patrol/getIDPLAN') ?>",
                    method: "POST",
                    data: "id_plan=" + id,
                    cache: false,
                    success: function(e) {
                        document.getElementById("showLokasi").innerHTML = e;
                        Instascan.Camera.getCameras().then(function(cameras) {
                            if (cameras.length > 0) {
                                scanner.start(cameras[1]);
                            } else {
                                console.error('No cameras found.');
                            }
                        }).catch(function(e) {
                            console.error(e);
                        });
                    }
                })
            }
        });


    })
    // end


    //tampilkan camera untuk scan barcode
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
        scanPeriod: 5,
    });

    scanner.addListener('scan', function(content) {
        //  console.log(content);
        var idLokasi = $("select[is='ms-dropdown'] option:selected").val();
        //console.log(idLokasi);
        const txt = content.split(",", 2);
        const lo = txt[0];
        const la = txt[1];
        // alert(idLokasi);
        navigator.geolocation.getCurrentPosition(function(position) {

            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            console.log("lat user" + lat);
            console.log("long user " + long);
            $.ajax({
                url: $("#formTikor").attr('data-url'),
                method: "POST",
                beforeSend: function() {
                    document.getElementById("infoScan").style.display = "block";
                },
                complete: function() {
                    document.getElementById("infoScan").style.display = "none";
                },
                data: "tikor=" + idLokasi + '&barcode=' + content,
                success: function(e) {
                    console.log(e);
                    if (e == "OK") {
                        Swal.fire({
                            title: 'Attention!',
                            text: 'Area Sudah Di Lewati',
                            icon: 'error',
                        })
                    } else if (e == 0) {
                        Swal.fire({
                            title: 'Attention!',
                            text: 'Barcode Invalid',
                            icon: 'error',
                        })
                    } else {
                        // console.log(e);
                        var result = JSON.parse(e);
                        const latitudeBarcode = result[0].latitude;
                        const longitudeBarcode = result[0].longitude;
                        const lokasi = result[0].id;
                        //   console.log("lat barcode " + latitudeBarcode);
                        //   console.log("long barcode " + longitudeBarcode);

                        //lokasi titik barcode disimpan 
                        var plan = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);

                        //lokasi perangkat user 
                        var posisi_user = new google.maps.LatLng(lat, long);
                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(plan, posisi_user) / 1000).toFixed(2);
                        console.log(jarak);
                        if (jarak <= 0.09) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Lanjut Documentasi ' + jarak,
                                icon: "success",
                            }).then(function() {
                                window.location = "<?= base_url("Danru/Patrol/input_report/") ?>" + idLokasi;
                            })
                        } else {
                            Swal.fire({
                                title: 'Attention!',
                                text: 'Anda di Luar Area ' + jarak,
                                icon: 'error',
                            })
                        }
                    }
                }
            })
        });
    });

    // reset status patroli jika sudah terlewati semua
    function reset(id) {
        const url = $("#infoUpdate").attr("data-url");
        const refresh = $("#infoUpdate").attr("data-refresh");
        console.log(id);
        console.log(url);
        Swal.fire({
            title: 'Kirim Report ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: "GET",
                    data: 'id=' + id,
                    success: function(e) {
                        Swal.fire(
                            e,
                        ).then(function() {
                            window.location.href = refresh;
                        })
                    }
                })
            }
        })
    }
    // end of reset
</script>