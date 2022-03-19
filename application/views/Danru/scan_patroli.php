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
            <div class="card">
                <div class="card-body">
                    <form id="formTikor" data-url="<?= base_url('Danru/Patrol/getPlan') ?>">
                        <video class="img img-thumbnail" id="previewKamera"></video>
                        <label class="text-danger small" style="display:none" id="infoScan">scanning barcode harap tunggu . . . </label>
                        <div id="dataPLAN" class="form-group">
                            <!-- isi plan nanti disini -->
                            <input type="hidden" id="areaKERJAPATROLI" value="<?= $employee->area_kerja ?>">
                            <select class="form-control text-dark " name="area" id="area_kerja">
                                <option value="" data-icon="bx bx-street-view">Pilih Area Kerja </option>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // $('#mySelect').selectpicker();
        //pilih area kerja
        $('select[name=area').on('change', function() {
            var id = $("select[name=area] option:selected").val();
            $.ajax({
                url: "<?= base_url('Danru/Patrol/getIDPLAN') ?>",
                method: "POST",
                data: "id_plan=" + id,
                cache: false,
                success: function(e) {
                    document.getElementById("showLokasi").innerHTML = e;
                }
            })
        })
    })

    // proses scanner barcode 
    const codeReader = new ZXing.BrowserQRCodeReader();

    codeReader.decodeFromVideoDevice(null, 'previewKamera', (result, err) => {
        if (result) {
            //hasil scan dari barcode ;
            const barcode = result.text;
            // console.log(barcode);
            var idLokasi = $("select[is='ms-dropdown'] option:selected").val();
            const areaPATROLI = document.getElementById("areaKERJAPATROLI").value;

            // console.log(idLokasi);
            // alert(idLokasi + " " + barcode);
            const d = barcode.split(",", 2);
            console.log(d[1]);
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
                    data: "tikor=" + idLokasi + '&barcode=' + barcode,
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

                            //ambil data titik koordinat dari db
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
                            // console.log(jarak);

                            var jarakRadius = "";
                            switch (areaPATROLI) {
                                case 'VLC':
                                    if (jarak <= 0.10) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("VLC < 09 " + jarakRadius);
                                    break;
                                case 'HO':
                                    if (jarak <= 0.10) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("HO <= 10 " + jarakRadius);
                                    break;
                                case 'DOR':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("DOR < 11 " + jarakRadius);
                                    break;
                                case 'PC':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("PC < 11 " + jarakRadius);
                                    break;
                                case 'P1':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("P1 < 11 " + jarakRadius);
                                    break;
                                case 'P2':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("P2 < 11 " + jarakRadius);
                                    break;
                                case 'P3':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("P3 < 11 " + jarakRadius);
                                    break;
                                case 'P4':
                                    if (jarak <= 0.11) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("P4 < 11 " + jarakRadius);
                                    break;
                                case 'P5':
                                    if (jarak <= 1.5) {
                                        jarakRadius = "ok";
                                    } else {
                                        jarakRadius = "nok";
                                    }
                                    console.log("P5 < 10 " + jarakRadius);
                                    break;
                            }
                            //cek jarak titik dan lokasi
                            // if (jarak <= 0.09) {
                            if (jarakRadius == "ok") {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Lanjut Documentasi ',
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
                            //end of cek titik dan lokasi barcode
                        }
                    }
                })
            });
        }

        if (err) {
            if (err instanceof ZXing.NotFoundException) {
                //console.log('No QR code found.')
            }
            if (err instanceof ZXing.ChecksumException) {
                console.log('A code was found, but it\'s read value was not valid.')
            }
            if (err instanceof ZXing.FormatException) {
                console.log('A code was found, but it was in a invalid format.')
            }
        }
    })
    // end of prosess scanner barcode



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