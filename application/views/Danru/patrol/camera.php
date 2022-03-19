<form action="" data-url="<?= base_url('Danru/Patrol/getPlan') ?>" id="formTikor">
    <input type="hidden" id="id_area" value="<?= $id ?>">
    <input type="hidden" id="id_events" value="<?= $id_events ?>">
    <input type="hidden" id="area_kerja" value="<?= $employee->area_kerja ?>">
    <video width="100%" class="img-thumbnail" id="preview"></video>
    <label class="text-danger small" style="display:none" id="infoScan">scanning barcode harap tunggu . . . </label>
</form>

<script>
    Instascan.Camera.getCameras().then(function(cameras) {
        // console.log(cameras);
        var totalCamera = cameras.length;
        if (totalCamera <= 2) {
            scanner.start(cameras[0]);
        } else if (totalCamera <= 3) {
            scanner.start(cameras[2]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });

    //tampilkan camera untuk scan barcode
    var scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
        scanPeriod: 5,
    });

    scanner.addListener('scan', function(content) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var idLokasi = $("#id_area").val();
            const areaPATROLI = $("#area_kerja").val();
            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            // console.log("lat user" + lat);
            // console.log("long user " + long);
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
                    // console.log(e);
                    if (e == "OK") {
                        Swal.fire({
                            title: 'Attention!',
                            text: 'Area Sudah Di Lewati',
                            icon: 'error',
                        })
                    } else if (e == 0) {
                        alert("barcode invalid")
                        // Swal.fire({
                        //     title: 'Attention!',
                        //     text: 'Barcode Invalid',
                        //     icon: 'error',
                        // })
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

                        //id events
                        var id_events = document.getElementById("id_events").value;
                        //lokasi perangkat user 
                        var posisi_user = new google.maps.LatLng(lat, long);
                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(plan, posisi_user) / 1000).toFixed(2);
                        // console.log(jarak);

                        var jarakRadius = "";
                        switch (areaPATROLI) {
                            case 'VLC':
                                if (jarak <= 0.25) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("VLC < 09 " + jarakRadius);
                                break;
                            case 'HO':
                                if (jarak <= 0.09) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("HO <= 10 " + jarakRadius);
                                break;
                            case 'DOR':
                                if (jarak <= 0.09) {
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
                                if (jarak <= 0.10) {
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
                                if (jarak <= 0.11) {
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
                            alert("Berhasil");
                            window.location = "<?= base_url("Danru/Patrol_v2/kondisi/") ?>" + idLokasi + "/" + id_events;
                            // Swal.fire({
                            //     title: 'Sukses!',
                            //     text: 'Lanjut Documentasi ',
                            //     icon: "success",
                            // }).then(function() {
                            //     window.location = "<?= base_url("Danru/Patrol_v2/kondisi/") ?>" + idLokasi;
                            // })
                        } else {
                            // Swal.fire({
                            //     title: 'Attention!',
                            //     text: 'Anda di Luar Area ' + jarak,
                            //     icon: 'error',
                            // })
                            alert('Anda di Luar Area ' + jarak);
                        }
                        //end of cek titik dan lokasi barcode
                    }
                }
            })
        });
    })
</script>