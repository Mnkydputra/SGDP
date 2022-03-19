<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="<?= base_url("Tester/Absensiv3/cek") ?>">
        <select name="opsi">
            <option value="IN">MASUK</option>
            <option value="OUT">PULANG</option>
        </select>
        <button type="submit">absen</button>
    </form>

    <?php
    if ($this->session->flashdata("info")) { ?>
        <p><?= $this->session->flashdata("info") ?></p>
    <?php  } ?>
    <hr>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>IN</th>
                <th>OUT</th>
                <th>Keterangan</th>
            </tr>
        <tbody>
            <?php $no = 1;
            foreach ($data as $dt) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dt->jadwal_masuk ?></td>
                    <td><?= $dt->in_time ?></td>
                    <td><?= $dt->out_time ?></td>
                    <td><?= $dt->ket ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        </thead>
    </table>
</body>

</html>