</br></br>
</br></br>
<!--- Bagian Judul-->
<div class="container" style="margin-top:10px;background:#fff">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5 container col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Grafik Patroli per Tanggal 23 Januari 2020 <?= $vlc ?>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div>
                            <div id="wilayah2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU" type="text/javascript"></script>
<script>
    $(function() {
        $('#example').DataTable({
            scrollY: "500px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                left: 2,
                // right: 1
            }
        });
    })

    const data = {
        labels: [
            'Head Office ',
            'Dormitori ',
            'Part Center ',
            'VLC ',
            'Plan 1 ',
            'Plan 2',
            'Plan 3',
            'Plan 4 - ASSY 1 ',
            'Plan 4 - ASSY 2 ',
            'Plan 5 ',
        ],
        datasets: [{
            label: 'Grafik Patroli',
            data: [Math.floor(<?= $ho ?>), Math.floor(<?= $dor ?>), Math.floor(<?= $pc ?>), Math.floor(<?= $pc ?>), Math.floor(<?= $vlc ?>), Math.floor(<?= $p1 ?>), Math.floor(<?= $p2 ?>), Math.floor(<?= $p3 ?>), Math.floor(<?= $p4A1 ?>), Math.floor(<?= $p4A2 ?>), Math.floor(<?= $p5 ?>)],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            // animations: {
            //     tension: {
            //         duration: 1000,
            //         easing: 'linear',
            //         from: 1,
            //         to: 0,
            //         loop: true
            //     }
            // },
            scales: {
                y: { // defining min and max so hiding the dataset does not change scale range
                    min: 0,
                    max: 6
                }
            }
        }
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    function wilayah() {
        //looad wilayah 2 
        var locations_wil2 = [
            <?php foreach ($maps->result() as $d) { ?>['<h5> <?= $d->id_plan . " : " . $d->lokasi ?></h5>', <?= $d->titik_koordinat ?>],
            <?php } ?>
        ];
        var infowindow = new google.maps.InfoWindow();
        var options = {
            zoom: 15,
            center: new google.maps.LatLng(<?= $center ?>), //tengah peta 
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('wilayah2'), options);
        var marker, i, j;
        var color = "#FE7569";
        // proses penambahan marker pada masing-masing lokasi yang berbeda
        for (i = 0; i < locations_wil2.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations_wil2[i][1], locations_wil2[i][2]),
                map: map,
            });
            // Menampilkan informasi pada masing-masing marker yang diklik	
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations_wil2[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    };
</script>