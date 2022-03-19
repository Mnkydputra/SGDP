<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ilmu-detil.blogspot.com">
    <title>Multi Marker Map </title>
    <!-- Bagian css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
    <!-- Bagian js -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="assets/js/bootstrap.min.js"></script>
    <!-- akhir dari Bagian js -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>

<body onload="initialize()">
    <nav class="navbar navbar-default navbar-fixed-top mb-5">
    </nav>
    </br></br>
    <!--- Bagian Judul-->
    <div class="container" style="">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-heading">Marker Google Maps</div>
                    <div class="card-body">
                        <div id="map_canvas" style="width: 700px; height: 600px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<script>
    function initialize() {

        var locations = [
            <?php foreach ($titik->result() as $t) : ?>['<h5><?= $t->lokasi ?></h5>', <?= $t->latitude ?>, <?= $t->longitude ?>],
            <?php endforeach ?>
        ];
        var infowindow = new google.maps.InfoWindow();

        var options = {
            zoom: 15,
            center: new google.maps.LatLng(<?= $tengah ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('map_canvas'), options);

        var marker, i;
        // proses penambahan marker pada masing-masing lokasi yang berbeda
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,

            });

            // Menampilkan informasi pada masing-masing marker yang diklik 
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

    };
</script>

</html>