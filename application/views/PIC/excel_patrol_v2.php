<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="kT6HzKD1Qm2Fp0Uh24SdjRoIMmLMmM2amx8pd11VSqM" />
    <title>I - SECURITY</title>
</head>

<body>
    <?php

    use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

    $t = new Grei\TanggalMerah();
    $bulan = "02";
    $tahun = date('Y'); //Mengambil tahun saat ini
    // $bulan = date('m'); //Mengambil bulan saat ini
    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    ?>
    <!-- <table class="table table-bordered table-striped" border="1"> -->
    <table id="example" class="mt-5 table table-bordered table-striped small" style="width: 100%;border:1px solid #000">
        <thead style="border: 1px solid #000;">
            <tr style="border: 1px solid #000;">
                <th>Tanggal</th>
                <th>Durasi</th>
                <?php foreach ($titik->result() as $t) { ?>
                    <th><?= $t->lokasi  ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000;">
            <?php

            for ($i = 1; $i < $tanggal + 1; $i++) {
                if ($i < 9) {
                    $i = "0" . $i;
                } else {
                    $i;
                }
                $tgl = $tahun . "-" . $bulan . "-" .  $i; ?>
                <tr>
                    <td style='text-align:center;margin:auto'>
                        <p><?= $tahun . "-" . $bulan . "-" .  $i ?></p>
                    </td>
                    <td style='border: 1px solid #000'>
                        <?php
                        $time = $this->db->query("SELECT durasi_patroli.durasi , durasi_patroli.id_durasi FROM hasil_patroli  JOIN  durasi_patroli 
                        WHERE   durasi_patroli.id_durasi = hasil_patroli.id_durasi AND tgl_kirim_patroli = '" . $tgl . "' AND area_kerja = '" . $area . "'
                        GROUP BY durasi_patroli.id_durasi ORDER BY durasi_patroli.id ASC  ");

                        foreach ($time->result() as $drs) {
                            echo "<li style='list-style:none'>" . $drs->durasi . "</li>";
                        }
                        ?>
                    </td>

                    <?php

                    foreach ($titik->result() as $u) { ?>


                    <?php $d = $this->db->query('select jam  from hasil_patroli where tgl_kirim_patroli="' . $tgl . '" and lokasi="' . $u->lokasi . '" and area_kerja="' . $u->id_plan . '" ');
                        if ($d->num_rows() > 0) {

                            $ko = $d->result();

                            echo "<td style='border: 1px solid #000;text-align:center'>";
                            foreach ($ko as $l) {
                                echo "<li style='list-style:none'>" . $l->jam . "</li>";
                            }
                            echo "</td>";
                        } else {
                            echo "<td style='border: 1px solid #000;text-align:center'> - </td>";
                        }
                    }
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>