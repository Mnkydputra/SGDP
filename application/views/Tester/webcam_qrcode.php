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
        </div>
    </div>
    <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
    <hr>
    <select></select>
    <hr>
    <ul></ul>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script type="text/javascript">
        var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
        var arg = {
            resultFunction: function(result) {
                var aChild = document.createElement('li');
                aChild[txt] = result.format + ': ' + result.code;
                document.querySelector('body').appendChild(aChild);
                alert(result.code);
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
            zoom: -1, // if zoom = -1, auto zoom for optimal resolution else int
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
                alert(result.code);
            },
        }


        document.querySelector('select').addEventListener('change', function() {
            decoder.stop().play();
        });
    </script>
</body>

</html>