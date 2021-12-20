<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/') ?>instascan.min.js"></script>
</head>

<body>


    <p id="barcode"></p>
    <p id="demo"></p>
    <video id="preview"></video>
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
                console.log(position.coords.longitude);

                console.log(content);
                $.ajax({
                    url: "<?= base_url('Danru/Patrol/input') ?>",
                    method: "POST",
                    data: "barcode=" + content + "&longitude=" + long + "&latitude=" + lat,
                    cache: false,
                    processData: false,
                    success: function(e) {
                        alert(e)
                        // window.location = "<?= base_url("Danru/Patrol/scanBarcode") ?>";
                    }
                })
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

</body>

</html>