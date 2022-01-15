<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Patroli Area <?= $area ?> </title>
    <!-- <link rel="stylesheet" href="/assets/css/style2.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style2.css">
</head>

<body>
    <!-- <img src="./assets/img/Group_2.png" class="img-logo" style="display:flex;position:relative;margin-top:-70px;margin-left:300px;width:100px"> -->
    <?php foreach ($patrol->result() as $ptr) : ?>
        <table style="width: 100%;border:1px solid #000" class="table-info">
            <tbody>
                <tr>
                    <td colspan="3" class="h-info" align="center">I-Patrol Information</td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td colspan="2"><?= $ptr->area_kerja ?></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td colspan="2"><?= $ptr->lokasi ?></td>
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
</body>

</html>