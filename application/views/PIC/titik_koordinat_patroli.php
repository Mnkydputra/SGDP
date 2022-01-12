<br>
<div class="bg-tikor col-lg-11 container-fluid mt-5">
    <button data-bs-toggle="modal" data-bs-target="#modalAddTitik" class="btn-add btn btn-danger mt-2 mb-2">Tambah Data</button>
    <div class="row">
        <table class="table table-bordered table-striped" id="infoTitik" data-delete="<?= base_url('PIC/Tikor/delete') ?>" id="table_id">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Area Kerja</td>
                    <td>Urutan</td>
                    <td>Lokasi</td>
                    <td>Longitude</td>
                    <td>Latitude</td>
                    <td>Opsi</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tikor as $tkr) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tkr->id_plan ?></td>
                        <td><?= $tkr->urutan ?></td>
                        <td><?= $tkr->lokasi ?></td>
                        <td><?= $tkr->latitude ?></td>
                        <td><?= $tkr->longitude ?></td>
                        <td>
                            <a href="javascript:hapusTikor('<?= $tkr->id  ?>')" class="btn btn-danger btn-sm">hapus</a>
                            <button data-id="<?= $tkr->id ?>" data-area="<?= $tkr->id_plan ?>" data-lokasi="<?= $tkr->lokasi ?>" data-lat="<?= $tkr->latitude ?>" data-long="<?= $tkr->longitude ?>" data-area="<?= $tkr->id_plan ?>" data-bs-toggle="modal" data-bs-target="#edit-data" class="btn-add btn btn-sm btn-success mt-2 mb-2">edit</button>
                            <a href="<?= base_url('assets/patrol/qrcode/' . $tkr->id_plan . '-' . $tkr->lokasi . '.png') ?>" class="btn btn-primary btn-sm">cetak qrcode</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<br>

<!-- Modal tambah data -->
<div class="modal fade" id="modalAddTitik" data-keyboard="false" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Titik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="formADDTikor" data-upload="<?= base_url('PIC/Tikor/tambah_titik') ?>" data-refresh="<?= base_url('PIC/Tikor') ?>">
                    <input type="hidden" value="<?= $id_titik ?>" name="id2">
                    <select name="id_plan" id="id_plan" class="text-dark  form-control">
                        <option value="">Pilih Area Kerja</option>
                        <option value="VLC">ADM VLC</option>
                        <option value="HO">ADM HO</option>
                        <option value="DOR">DOR</option>
                        <option value="PC">PC</option>
                        <option value="P1">PLAN 1</option>
                        <option value="P2">PLAN 2</option>
                        <option value="P3">PLAN 3</option>
                        <option value="P4">PLAN 4</option>
                        <option value="P5">PLAN 5</option>
                    </select>
                    <div class="form-group">
                        <label for="">Lokasi Patroli</label>
                        <input name="lokasi" type="text" autocomplete="off" class="form-control form-btn form-control-sm text-dark" id="lokasi">
                    </div>

                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" autocomplete="off" class="form-control form-control-sm text-dark" name="latitude" id="latitude">
                    </div>

                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" autocomplete="off" class="form-control form-control-sm text-dark" name="longitude" id="longitude">
                    </div>
                    <div class="alert alert-danger" id="infoSave">
                        <label for="">sedang menyimpan harap tunggu . . . </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end of modal tambah -->


<!-- Modal edit data-->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Tambah Titik</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="updateTitik" data-update="<?= base_url('PIC/Tikor/update_titik') ?>" data-refresh="<?= base_url('PIC/Tikor') ?>">
                    <input type="hidden" name="id" id="id">
                    <select name="id_plan2" id="id_plan2" class="text-dark  form-control">
                        <option value="">Pilih Area Kerja</option>
                        <option value="VLC">ADM VLC</option>
                        <option value="HO">ADM HO</option>
                        <option value="DOR">DOR</option>
                        <option value="PC">PC</option>
                        <option value="P1">PLAN 1</option>
                        <option value="P2">PLAN 2</option>
                        <option value="P3">PLAN 3</option>
                        <option value="P4">PLAN 4</option>
                        <option value="P5">PLAN 5</option>
                    </select>
                    <div class="form-group">
                        <label for="">Lokasi Patroli</label>
                        <input name="lokasi2" type="text" class="form-control form-btn form-control-sm text-dark" id="lokasi2">
                    </div>

                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control form-control-sm text-dark" name="latitude2" id="latitude2">
                    </div>

                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control form-control-sm text-dark" name="longitude2" id="longitude2">
                    </div>

                    <div class="alert alert-danger" id="infoSave2">
                        <label for="">memperbarui harap tunggu . . . </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end of modal tambah -->
<!-- Modal Ubah -->
<script>

</script>