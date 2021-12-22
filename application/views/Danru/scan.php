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
        video: document.getElementById('preview'),
        mirror: false,
        scanPeriod: 5
    });
    scanner.addListener('scan', function(content) {
        // console.log(content);
        navigator.geolocation.getCurrentPosition(function(position) {
            const long = position.coords.longitude;
            const lat = position.coords.latitude;
            const acc = position.coords.accuracy;
            console.log("longitude " + long);
            console.log("latitude" + lat);
            // console.log(position);

            //lokasi plan jaga 
            var plan = new google.maps.LatLng(<?= $plan->latitude ?>, <?= $plan->longitude ?>);

            //lokasi user scan barcode
            var posisi_user = new google.maps.LatLng(lat, long);

            const jarak = (google.maps.geometry.spherical.computeDistanceBetween(plan, posisi_user) / 1000).toFixed(1);
            console.log(jarak);
            // if (jarak <= 0.4) {
            //     alert("Lanjut isi dokumentasi");
            //     window.location = "<?= base_url("Danru/Patrol/form_report/PLAN_1") ?>";
            // } else {
            //     alert("titik diluar jangkauan");
            // }
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