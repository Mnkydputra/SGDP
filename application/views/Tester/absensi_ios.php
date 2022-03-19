<div style="margin-top:120px; background-color:#F9FAFA;" class="container fixed-top">
    <div class="container-md-3">

        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>

<div style="margin-top:100px; padding-top:30mm; background-color:#F9FAFA;" class="container-md mt-5 ">
    <div class="card">
        <form action="#" method="post" name="" id="absen_ios">

            <div class="card-body">
                <input type="hidden" class="form-control text-dark" value="<?= $employe->wilayah ?>" id="wilayah">
                <input type="hidden" class="form-control text-dark" value="<?= $employe->npk ?>" id="npk">
                <input type="hidden" class="form-control text-dark" value="<?= $employe->id_employee ?>" id="id_absen">
                <input type="hidden" class="form-control text-dark" value="<?= $employe->area_kerja ?>" id="area_kerja">
                <br>
                <center>
                    <div id="showInfo">
                        <img class="img img-thumbnail" src="<?= base_url("assets/img/absen.png") ?>">
                        <legend>
                            <button type="submit" id="masuk" class="mt-2 btn btn-success">KLIK DISINI UNTUK ABSEN</button>
                        </legend>
                    </div>
                </center>
        </form>
        <label id="procesScanning" style="display:none" class="text-danger small">processing presensi harap tunggu . . . </label>
    </div>
</div>
</div>


<script type="text/javascript">
    navigator.geolocation.getCurrentPosition(function(position) {
        //lokasi perangkat user 
        const latiUser = position.coords.latitude;
        const longiUser = position.coords.longitude;
        var la = "<?= $titik->latitude ?>";
        var lo = "<?= $titik->longtitude ?>";
        //lokasi barcode di tempel
        var lokasiBarcode = new google.maps.LatLng(la, lo);
        // lokasi handphone
        var posisi_user = new google.maps.LatLng(latiUser, longiUser);
        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(lokasiBarcode, posisi_user) / 1000).toFixed(2);

        console.log(jarak);
        if (jarak >= 0.06) {
            var info = '<img class="img img-thumbnail" src="<?= base_url("assets/img/failed.png") ?>">' + '<legend>Lokasi di luar area <a href="<?= base_url("Tester/Absensi/absen_ios/") ?>"> Refresh</a></legend>';
            document.getElementById("showInfo").innerHTML = info;
        }
    })

    $(function() {
        $("#absen_ios").on('submit', function(e) {
            e.preventDefault();
            // input presensi
            var id_absen = document.getElementById('id_absen').value;
            var wilayah = document.getElementById('wilayah').value;
            var area_kerja = document.getElementById('area_kerja').value;
            var npk = document.getElementById('npk').value;
            $.ajax({
                url: "<?= base_url("Tester/Absensi/input_absen/") ?>",
                method: "POST",
                data: "wilayah=" + wilayah + "&npk=" + npk + "&id_absen=" + id_absen + "&area_kerja=" + area_kerja,
                processData: false,
                cache: false,
                success: function(e) {
                    console.log(e);
                    if (e == "Belum Waktunya Pulang") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: "Belum Waktunya Pulang"
                        })
                    } else if (e == "pulang") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih',
                            text: "Absen Pulang Berhasil"
                        })
                    } else if (e == "masuk lagi nanti") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: "Silahkan Absen di Jam Berikutnya"
                        })
                    } else if (e == "masuk") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih',
                            text: "Absen Masuk Berhasil"
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: e
                        })
                    }
                }
            });
        })
    })
</script>