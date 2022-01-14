<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Patroli Area <?= $area ?> </title>
    <!-- <link rel="stylesheet" href="/assets/css/style2.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style2.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body onload="initialize()">
    <!-- <img src="./assets/img/Group_2.png" class="img-logo" style="display:flex;position:relative;margin-top:-70px;margin-left:300px;width:100px"> -->
    <?php foreach ($patrol->result() as $ptr) : ?>
        <table style="width: 100%;border:1px solid #000" class="table-info">
            <tbody>
                <tr>
                    <td colspan="3" class="h-info" align="center" style="">I-Patrol Information</td>
                </tr>
                <tr>
                    <td>Area - Lokasi </td>
                    <td colspan="2"><?= $ptr->area_kerja . " - " . $ptr->lokasi ?></td>
                </tr>
                <tr>
                    <td>Informasi</td>
                    <td colspan="2"><?= $ptr->keterangan  ?></td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td colspan="2"><?= $ptr->tanggal . " " . $ptr->jam ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;top:90px;position:absolute">Gambar Kejadian</td>
                    <?php
                    $img = $this->db->get_where("documentasi_patroli", ['id_patroli' => $ptr->id_patroli])->result();
                    foreach ($img as $im) { ?>
                        <td>
                            <img class="img-patrol" src="./assets/patrol/<?= $im->picture ?>" alt="">
                        </td>
                    <?php } ?>
                </tr>
                </tr>
            </tbody>
        </table>
        <br>
    <?php endforeach  ?>
    <div class="panel-body">
        <div id="map_canvas" style="width: 700px; height: 600px;"></div>
    </div>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
        function initialize() {

            var locations = [

                ['<h5>Ruang Exim Logistik</h5>', -6.145917, 106.885216],
                ['<h5>Office HRD</h5>', -6.146240, 106.885261],
                ['<h5>Ruang Kantin</h5>', -6.146199, 106.885198],
                ['<h5>Loker Karyawan</h5>', -6.146077, 106.885063],
                ['<h5>Area Receiving</h5>', -6.145972, 106.885067],
                ['<h5>Genset</h5>', -6.145961, 106.884501],
                ['<h5>Area Utara Perbatasan ADM VLC / TSM </h5>', -6.146171, 106.883221],
                ['<h5>Area Selatan Perbatasan VLC / TSM</h5>', -6.147998, 106.883549],
                ['<h5>Area Timur Perbatasan ADM VLC / AI DSO</h5>', -6.147775, 106.884931],
                ['<h5>Area Car Carrier</h5>', -6.146747, 106.884626],
                ['<h5>Gardu PLN</h5>', -6.146952, 106.885204],
                ['<h5>Area Towing</h5>', -6.146952, 106.885204],
                ['<h5>Parkir Area Office</h5>', -6.146952, 106.885204],
                ['<h5>Parkir Kawasan</h5>', -6.146952, 106.885204],
                ['<h5>Area Towing</h5>', -6.146952, 106.885204]
            ];
            var infowindow = new google.maps.InfoWindow();

            var options = {
                zoom: 18,
                center: new google.maps.LatLng(-6.146517, 106.884907),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            // Pembuatan petanya
            var map = new google.maps.Map(document.getElementById('map_canvas'), options);

            var marker, i;
            var color = "#FE7569";
            // proses penambahan marker pada masing-masing lokasi yang berbeda
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: 'https://www.iconsdb.com/icons/preview/red/map-marker-2-xxl.png'

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


</body>

</html>