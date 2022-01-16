<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="example" class="mt-5 table table-bordered table-striped small" style="width: 100%;border:1px solid #000">
        <?php
        $tanggal =  date('Y-m-d'); //date('Y-m-d');
        $minggu_lalu = date('Y-m-d', strtotime('+1 week', strtotime($tanggal)));
        $n = new DateTime($tanggal);
        $n2 = new DateTime($minggu_lalu);
        $jarak = $n->diff($n2);
        ?>
        <thead style="border: 1px solid #000;">
            <tr align="center">
                <th class="align-center" colspan="33">Januari </th>
            </tr>
            <tr>
                <th>AREA</th>
                <th>Lokasi</th>
                <?php
                for ($i = 1; $i <= 31; $i++) { ?>
                    <th> <?= $i ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000;">
            <?php foreach ($titik->result() as $d) : ?>
                <tr align='center'>
                    <td><?= $d->id_plan  ?></td>
                    <td><?= $d->lokasi ?></td>
                    <?php
                    //buat perulangan untuk mencari 
                    for ($j = 1; $j <= 31; $j++) {
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
                            echo "<td  style='color:red'> x </td>";
                        } else {
                            echo "<td>";
                            foreach ($re->result() as $a) {
                                echo "<li>" .  $a->jam . "</li>";
                            } ?>
                            </td>
                    <?php }
                    }
                    ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>