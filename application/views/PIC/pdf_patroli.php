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

    <table border="1">
        <thead>
            <tr>
                <th>Nama - NPK </th>
                <th>Tanggal & Jam</th>
                <th>Lokasi</th>
                <th>Documentasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patrol->result() as $ptr) : ?>
                <?php $d = $this->db->get_where('documentasi_patroli', ['id_patroli' => $ptr->id_patroli]) ?>
                <tr>
                    <td><?= $ptr->nama . " - " . $ptr->id_npk  ?></td>
                    <td><?= $ptr->tanggal . ' ' . $ptr->jam  ?></td>
                    <td><?= $ptr->lokasi  ?></td>
                    <td>
                        <?php foreach ($d->result() as $cd) : ?>
                            <img class="img-report" height="250px" src="<?= base_url() ?>/assets/patrol/<?= $cd->picture ?>">
                        <?php endforeach ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>