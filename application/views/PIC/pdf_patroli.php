<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Patroli Area <?= $area ?> </title>
    <link rel="stylesheet" href="/assets/css/style2.css">
    
</head>

<body>
    <img src="./assets/img/Login.png" class="img-logo" style="display:flex;position:relative;margin-top:-70px;margin-left:300px;width:100px">
    <?php
    if ($patrol->num_rows() > 0) { ?>
        <table>
            <tr>
                <td>Area Patroli</td>
                <td>:</td>
                <td> <?= $area ?></td>
            </tr>
            <tr>
                <td>Tanggal Penarikan</td>
                <td>:</td>
                <?php if ($tgl2 == null) { ?>
                    <td> <?= $tgl1 ?></td>
                <?php } else { ?>
                    <td> <?= $tgl1 . ' - ' . $tgl2 ?></td>
                <?php } ?>
            </tr>
        </table>

        <table style="font-size: 12px;border:2px solid #000;width:100%">
            <tbody>
                <?php foreach ($patrol->result() as $ptr) : ?>
                    <?php $d = $this->db->get_where('documentasi_patroli', ['id_patroli' => $ptr->id_patroli]) ?>
                    <tr>
                        <td class="title-td" colspan="3">Lokasi : <?= $ptr->lokasi . ' || ' . $ptr->tanggal . ' ' . $ptr->jam  . ' || Keterangan : ' . $ptr->keterangan ?> </td>
                    </tr>
                    <tr>
                        <?php foreach ($d->result() as $cd) : ?>
                            <td align="center" style="border:3px solid #000">
                                <img  class="img-report" src="<?= base_url() ?>/assets/patrol/<?= $cd->picture ?>">
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php } else { ?>
        <hr>
        <table width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <h1 style="color:red">No Data Found</h1>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php } ?>


</body>

=======
<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Report Patroli Area <?= $area ?> </title>

    <link rel="stylesheet" href="/assets/css/style2.css">

    

</head>



<body>

    <img src="./assets/img/Login.png" class="img-logo" style="display:flex;position:relative;margin-top:-70px;margin-left:300px;width:100px">

    <?php

    if ($patrol->num_rows() > 0) { ?>

        <table>

            <tr>

                <td>Area Patroli</td>

                <td>:</td>

                <td> <?= $area ?></td>

            </tr>

            <tr>

                <td>Tanggal Penarikan</td>

                <td>:</td>

                <?php if ($tgl2 == null) { ?>

                    <td> <?= $tgl1 ?></td>

                <?php } else { ?>

                    <td> <?= $tgl1 . ' - ' . $tgl2 ?></td>

                <?php } ?>

            </tr>

        </table>



        <table style="font-size: 12px;border:2px solid #000;width:100%">

            <tbody>

                <?php foreach ($patrol->result() as $ptr) : ?>

                    <?php $d = $this->db->get_where('documentasi_patroli', ['id_patroli' => $ptr->id_patroli]) ?>
                    <tr>
                        <td class="title-td" colspan="3">Lokasi : <?= $ptr->lokasi . ' || ' . $ptr->tanggal . ' ' . $ptr->jam  . ' || Keterangan : ' . $ptr->keterangan ?> </td>
                    </tr>
                    <tr>
                        <?php foreach ($d->result() as $cd) : ?>
                            <td align="center" style="border:3px solid #000">
                                <img  class="img-report" src="<?= base_url() ?>/assets/patrol/<?= $cd->picture ?>">
                            </td>

                        <?php endforeach ?>

                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>

    <?php } else { ?>

        <hr>

        <table width="100%">

            <tbody>

                <tr>

                    <td align="center">

                        <h1 style="color:red">No Data Found</h1>

                    </td>

                </tr>

            </tbody>

        </table>

    <?php } ?>





</body>



>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
</html>