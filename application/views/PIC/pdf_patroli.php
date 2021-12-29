<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Patroli</title>
    <link rel="stylesheet" href="/assets/css/style2.css">
</head>

<body>


    <?php

    if ($patrol->num_rows() > 0) { ?>

        <table style="font-size: 40px;border:2px solid #000">
            <!-- <thead>
            <tr>
                <th>Nama - NPK </th>
                <th>Tanggal & Jam</th>
                <th>Lokasi</th>
                <th>Gambar 1</th>
                <th>Gambar 2</th>
                <th>Gambar 3</th>
            </tr>
        </thead> -->
            <tbody>
                <?php foreach ($patrol->result() as $ptr) : ?>
                    <?php $d = $this->db->get_where('documentasi_patroli', ['id_patroli' => $ptr->id_patroli]) ?>
                    <tr>
                        <td style="background-color: red;color:#fff" align="center" colspan="3">Area : <?= $ptr->area_kerja ?> || Lokasi : <?= $ptr->lokasi . ' || ' . $ptr->tanggal . ' ' . $ptr->jam ?></td>
                    </tr>
                    <tr>
                        <!-- <td><?= $ptr->nama . " - " . $ptr->id_npk  ?></td>
                    <td><?= $ptr->tanggal . ' ' . $ptr->jam  ?></td>
                    <td><?= $ptr->lokasi  ?></td> -->
                        <?php foreach ($d->result() as $cd) : ?>
                            <td align="center">
                                <img class="img-report" height="450px" src="<?= base_url() ?>/assets/patrol/<?= $cd->picture ?>">
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php } else { ?>
        <table>
            <tbody>
                <tr>
                    <td align="center">
                        <h1>Hasil Tidak Ditemukan</h1>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php } ?>


</body>

</html>