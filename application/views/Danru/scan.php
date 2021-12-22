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

            <video class="img img-thumbnail" id="preview"></video>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
<script>
    // barcode
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {
        // console.log(content);
        navigator.geolocation.getCurrentPosition(function(position) {
            const long = position.coords.longitude;
            const lat = position.coords.latitude;
            console.log("longitude " + long);
            console.log("latitude" + lat);
            //lokasi pertama
            var posisi_1 = new google.maps.LatLng(-6.1456597, 106.883518);
            // var posisi_1 = new google.maps.LatLng(-6.1253566, 106.810018);
            //lokasi dari Vehicle Logistic Center
            var posisi_vlc = new google.maps.LatLng(lat, long);

            const jarak = (google.maps.geometry.spherical.computeDistanceBetween(posisi_1, posisi_vlc) / 1000).toFixed(1);
            console.log(jarak);
            if (jarak <= 0.4) {
                alert("Lanjut isi dokumentasi");
                window.location = "<?= base_url("Danru/Patrol/form_report/PLAN_1") ?>";
                // $.ajax({
                //     url: "<?= base_url('Danru/Patrol/input') ?>",
                //     method: "POST",
                //     data: "barcode=" + content + "&longitude=" + long + "&latitude=" + lat,
                //     cache: false,
                //     processData: false,
                //     success: function(e) {
                //         // console.log(e);
                //         if (e >= 1) {
                //             window.location = "<?= base_url("Danru/Patrol/form_report/") ?>" + e;
                //         } else {
                //             alert(e);
                //         }
                //     }
                // })
            } else {
                alert("titik diluar jangkauan");
            }
        });
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
</script>