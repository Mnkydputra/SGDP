<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patroli Sementara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="nav mb-5"></div>
    <div class="container">
        <?php if ($this->session->flashdata('ok')) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Berhasil di hapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="card">
            <div class="card-body">
                <table id="example" class="small table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Area</th>
                            <th>Lokasi</th>
                            <th>Jam</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $dt) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $dt->area_kerja ?></td>
                                <td><?= $dt->lokasi ?></td>
                                <td><?= $dt->tanggal . " / " . $dt->jam ?></td>
                                <td><?= $dt->keterangan ?></td>
                                <td><a onclick="return confirm('Hapus ?')" href="<?= base_url('Danru/Patrol/deleteSementara/' . $dt->id) ?>" class="btn btn-sm btn-danger">del</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</html>