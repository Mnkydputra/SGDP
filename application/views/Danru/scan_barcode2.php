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
                    <input type="text" id="areaKERJAPATROLI" value="<?= $employee->area_kerja ?>">
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

                    <label class="text-danger small" style="display:none" id="infoScan">scanning barcode harap tunggu . . . </label>
                </div>
            </form>
            <!-- <select id="pilihKamera" style="max-width: 400px"></select>
            <br />
            <input type="text" id="hasilscan" />
            <br /> -->
            <video id="previewKamera" style="width: 300px; height: 300px"></video>
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
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[0]);
                        } else {
                            console.error('No cameras found.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                    });
                }
            })
        })
    })


    //scan barcode
    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const sourceSelect = $("#pilihKamera");

    $(document).on("change", "#pilihKamera", function() {
        selectedDeviceId = $(this).val();
        if (codeReader) {
            // codeReader.reset();
            initScanner();
        }
    });

    function initScanner() {
        codeReader
            .listVideoInputDevices()
            .then((videoInputDevices) => {
                videoInputDevices.forEach((device) =>
                    console.log(`${device.label}, ${device.deviceId}`)
                );

                if (videoInputDevices.length > 0) {
                    // if (selectedDeviceId == null) {
                    //     if (videoInputDevices.length > 1) {
                    //         selectedDeviceId = videoInputDevices[1].deviceId;
                    //     } else {
                    //         selectedDeviceId = videoInputDevices[0].deviceId;
                    //     }
                    // }
                    selectedDeviceId = videoInputDevices[0].deviceId;

                    // if (videoInputDevices.length >= 1) {
                    //     sourceSelect.html("");
                    //     videoInputDevices.forEach((element) => {
                    //         const sourceOption = document.createElement("option");
                    //         sourceOption.text = element.label;
                    //         sourceOption.value = element.deviceId;
                    //         if (element.deviceId == selectedDeviceId) {
                    //             sourceOption.selected = "selected";
                    //         }
                    //         sourceSelect.append(sourceOption);
                    //     });
                    // }

                    codeReader
                        .decodeOnceFromVideoDevice(selectedDeviceId, "previewKamera")
                        .then((result) => {
                            //hasil scan
                            console.log(result.text);
                            const barcode = result.text;
                            navigator.geolocation.getCurrentPosition(function(position) {
                                const long = position.coords.lotitude;
                                const lat = position.coords.latitude;

                                //cek barcode apakah terdaftar apa tidak di sistem
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

                                    }
                                })

                            })

                            if (codeReader) {
                                codeReader.reset();
                            }
                        })
                        .catch((err) => console.error(err));
                } else {
                    alert("Camera not found!");
                }
            })
            .catch((err) => console.error(err));
    }

    if (navigator.mediaDevices) {
        initScanner();
    } else {
        alert("Cannot access camera.");
    }


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