<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('assets/') ?>js/qrcodelib.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/') ?>js/webcodecamjs.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/') ?>js/webcodecamjquery.js"></script>
</head>

<body>
    <h1>Hello, world!</h1>

    <div class="card">
        <div class="card-body">
            <input type="text" value="WIL1" id="wilayah">
            <input type="text" value="228572" id="npk">
            <input type="text" value="AGT-228572" id="id_absen">
            <input type="text" value="P4" id="area_kerja">
            <input type="text" value="Korlap" id="jabatan"><br>
            <canvas width="450" height="350" id="webcodecam-canvas"></canvas>
            <hr>
            <select class="form-control"></select>
        </div>
    </div>
    <hr>
    <ul></ul>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>


    <script type="text/javascript">
        var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
        var arg = {
            resultFunction: function(result) {
                // var aChild = document.createElement('li');
                // aChild[txt] = result.format + ': ' + result.code;
                // document.querySelector('body').appendChild(aChild);
                const barcode = result.code;
                const brc = barcode.split(',', 2);
                const la = brc[0];
                const lo = brc[1];
                var jabatan = document.getElementById("jabatan").value;
                var wilayah = document.getElementById("wilayah").value;
                var area_kerja = document.getElementById("area_kerja").value;
                var id_absen = document.getElementById("id_absen").value;
                var npk = document.getElementById("npk").value;

                //jika status korlap jarak absen tidak di atur hanya jarak 
                if (jabatan == "Korlap") {
                    $.ajax({
                        url: "<?= base_url('Tester/Absensi/cekBarcodeKorlap') ?>",
                        data: 'wilayah=' + wilayah + "&latitude=" + la,
                        method: "POST",
                        success: function(e) {
                            if (e == 1) {
                                $.ajax({
                                    url: "<?= base_url('Tester/Absensi/input_absen') ?>",
                                    method: "POST",
                                    data: "wilayah=" + wilayah + "&npk=" + npk + "&id_absen=" + id_absen + "&area_kerja=" + area_kerja,
                                    success: function(e) {
                                        alert(e);
                                    }
                                })
                            } else {
                                alert("absen lintas wilayah di tolak");
                            }
                        }
                    })
                } else {
                    //jika absen anggota danru gunakan metode ukur jarak dari area kerja
                    navigator.geolocation.getCurrentPosition(function(position) {

                        //lokasi perangkat user 
                        const latiUser = position.coords.latitude;
                        const longiUser = position.coords.longitude;
                        //lokasi barcode di tempel
                        var lokasiBarcode = new google.maps.LatLng(la, lo);
                        // lokasi handphone
                        var posisi_user = new google.maps.LatLng(latiUser, longiUser);
                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(lokasiBarcode, posisi_user) / 1000).toFixed(2);
                        $.ajax({
                            url: "<?= base_url('Tester/Absensi/cekBarcodeAnggota') ?>",
                            method: "POST",
                            data: 'area_kerja=' + area_kerja + "&latitude=" + la,
                            success: function(e) {
                                if (e == 0) {
                                    alert("barcode tidak sesuai area kerja anda")
                                } else {
                                    if (jarak > 10) {
                                        alert("anda diluar area " + area_kerja);
                                    } else {
                                        $.ajax({
                                            url: "<?= base_url('Tester/Absensi/input_absen') ?>",
                                            method: "POST",
                                            data: "wilayah=" + wilayah + "&npk=" + npk + "&id_absen=" + id_absen + "&area_kerja=" + area_kerja,
                                            success: function(e) {
                                                alert(e);
                                            }
                                        })
                                    }
                                }
                            }
                        })
                    })
                }

            }
        };
        var decoder = new WebCodeCamJS("canvas").buildSelectMenu('select', 'environment|back').init(arg).play();

        var options = {
            DecodeQRCodeRate: 5, // null to disable OR int > 0 !
            DecodeBarCodeRate: 5, // null to disable OR int > 0 !
            successTimeout: 500, // delay time when decoding is succeed
            codeRepetition: true, // accept code repetition true or false
            tryVertical: true, // try decoding vertically positioned barcode true or false
            frameRate: 15, // 1 - 25
            width: 320, // canvas width
            height: 240, // canvas height
            constraints: { // default constraints
                video: {
                    mandatory: {
                        maxWidth: 1280,
                        maxHeight: 720
                    },
                    optional: [{
                        sourceId: true
                    }]
                },
                audio: false
            },
            flipVertical: false, // boolean
            flipHorizontal: false, // boolean
            zoom: 2, // if zoom = -1, auto zoom for optimal resolution else int
            beep: 'audio/beep.mp3', // string, audio file location
            decoderWorker: 'js/DecoderWorker.js', // string, DecoderWorker file location
            brightness: 0, // int
            autoBrightnessValue: false, // functional when value autoBrightnessValue is int
            grayScale: false, // boolean
            contrast: 0, // int
            threshold: 0, // int 
            sharpness: [], // to On declare matrix, example for sharpness ->  [0, -1, 0, -1, 5, -1, 0, -1, 0]
            resultFunction: function(result) {
                /*
                    result.format: code format,
                    result.code: decoded string,
                    result.imgData: decoded image data
                */
                //alert(result.code);
            },
        }


        document.querySelector('select').addEventListener('change', function() {
            decoder.stop().play();
        });
    </script>
</body>

</html>