<br>

</br></br></br></br>
<!--- Bagian Judul-->
<div class="container" style="margin-top:10px">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Wilayah 2 </div>
                <div class="panel-body">
                    <div id="wilayah2" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
            <table id="table_id2" class="mt-3 table table-bordered table-striped small" style="width: 100%;">
                <?php
                $tanggal =  date('Y-m-d'); //date('Y-m-d');
                $minggu_lalu = date('Y-m-d', strtotime('-1 week', strtotime($tanggal)));
                $n = new DateTime($tanggal);
                $n2 = new DateTime($minggu_lalu);
                $jarak = $n->diff($n2);
                ?>
                <tr align="center">
                    <th class="align-center" colspan="<?= $jarak->d + 8 ?>">Januari </th>
                </tr>
                <tr>
                    <th>Area VLC</th>
                    <?php
                    for ($i = ($jarak->d); $i <= ($jarak->d + 7); $i++) { ?>
                        <th> <?= $i ?></th>
                    <?php } ?>
                </tr>
                <tbody>
                    <?php foreach ($titik->result() as $d) : ?>
                        <tr>
                            <td><?= $d->lokasi ?></td>
                            <?php
                            //buat perulangan untuk mencari 
                            for ($j = $jarak->d; $j <= ($jarak->d + 7); $j++) {
                                if ($j < 9) {
                                    $j = "0" . $j;
                                } else {
                                    $j = $j;
                                }
                                $where = ['lokasi' => $d->lokasi, 'area_kerja' => $d->id_plan, 'tanggal' => date('Y-m-') . $j];
                                //ambil jam patroli 
                                //lalu show di tabel berdasarkan tanggal
                                $re = $this->db->get_where("report_patrol", $where);
                                if ($re->num_rows() == 0) {
                                    echo "<td> - </td>";
                                } else {
                                    echo "<td>";
                                    foreach ($re->result() as $a) {
                                        echo " <i class='bx bx-time'> " .  $a->jam .  "<br>";
                                    } ?>
                                    </td>
                            <?php }
                            }
                            ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



<script>
    function wilayah() {
        //looad wilayah 2 
        var locations_wil2 = [
            <?php foreach ($titik->result() as $d) { ?>['<h5> <?= $d->id_plan . " : " . $d->lokasi ?></h5>', <?= $d->titik_koordinat ?>],
            <?php } ?>
        ];
        var infowindow = new google.maps.InfoWindow();
        var options = {
            zoom: 18,
            center: new google.maps.LatLng(-6.146517, 106.884907), //tengah peta 
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