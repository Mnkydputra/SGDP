</br></br>
</br></br>
<!--- Bagian Judul-->
<div class="container" style="margin-top:10px;background:#fff">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default mb-5">
                <div class="panel-heading text-center"></div>
                <div class="panel-body">
                    <!-- <div id="wilayah2" style="width: 100%; height: 450px;"></div> -->
                </div>
            </div>
            <form action="<?= base_url('PIC/Report_Patroli/tarikExcel')  ?>" method="post">
                <select name="area_patrol" id="" class="form-control text-dark">
                    <option value="P1">PLAN 1 </option>
                    <option value="P2">PLAN 2</option>
                    <option value="P3">PLAN 3</option>
                    <option value="P4-ASSY1">PLAN 4 - ASSY 1</option>
                    <option value="P4-ASSY2">PLAN 4 - ASSY 2</option>
                    <option value="P5">PLAN 5</option>
                    <option value="VLC">VLC</option>
                    <option value="HO">HEAD OFFICE</option>
                    <option value="DOR">DORMITORY</option>
                    <option value="PC">PART CENTER</option>
                </select>
                <button type="submit" name="reportExcel" class="mt-1 mb-2 btn btn-primary">Tarik Excel</button>
            </form>
            <table id="example" class="mt-5 table table-bordered table-striped small" style="width: 100%;">
                <?php
                $tanggal =  date('Y-m-d'); //date('Y-m-d');
                $minggu_lalu = date('Y-m-d', strtotime('+1 week', strtotime($tanggal)));
                $n = new DateTime($tanggal);
                $n2 = new DateTime($minggu_lalu);
                $jarak = $n->diff($n2);
                ?>
                <thead>
                    <tr align="center">
                        <th class="align-center" colspan="<?= $jarak->d + 8 ?>">Januari </th>
                    </tr>
                    <tr>
                        <th>AREA</th>
                        <th>Lokasi</th>
                        <?php
                        for ($i = ($jarak->d + 1); $i <= ($jarak->d + 8); $i++) { ?>
                            <th> <?= $i ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody style="border: 1px solid #000;">
                    <?php foreach ($titik->result() as $d) : ?>
                        <tr align="left">
                            <td><?= $d->id_plan . " - " . $d->lokasi ?></td>
                            <td><?= $d->id_plan . " - " . $d->lokasi ?></td>
                            <?php
                            //buat perulangan untuk mencari 
                            for ($j =  ($jarak->d + 1); $j <= ($jarak->d + 8); $j++) {
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
    $(function() {
        $("#example").DataTable();
    })

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