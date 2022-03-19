<div style="margin-top:120px; background-color:#F9FAFA;" class="container fixed-top">
    <div class="container-md-3">
        <!-- <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">

              <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center" >DAFTAR HADIR</label>

          </div> -->
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>
<div style="margin-top:100px; padding-top:30mm; background-color:#F9FAFA;" class="container-md mt-5 ">
    <div class="row">
        <div class="container-md-3">
            <div style="background-color:#6f9390; height:50px;" class=" alert alert" role="alert">
                <label style="background-color:#6f9390; font-size:13px; font-weight:solid" type="button" data-bs-toggle="modal" data-bs-target="#pengumuman" class="text-white  d-flex align-items-center justify-content-center">
                    Pilih Tombol Absen</label>
            </div>
            <form id="formAbsen" data-url="<?= base_url('Absen/getPlan') ?>" method="post" action="<?= base_url('Absen/getPlan') ?>" id="pilih-form">
                <input hidden type="text" name="id_absen" value="<?= $biodata->id_biodata ?>" id="id_absen">
                <input hidden type="text" name="npk" value="<?= $biodata->npk ?>" id="npk">
                <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="AreaKerja" id="AreaKerja">
                    <option hidden value="<?= $employe->area_kerja  ?>"> </option>
                </select>
                <input hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="Jabatan" id="Jabatan" value="<?= $employe->jabatan  ?>">
                <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="Wilayah" id="Wilayah">
                    <option hidden value="<?= $employe->wilayah ?>"></option>
                </select>
            </form>
            <div class="form-group ms-3 ps-4">
                <video width="250" class="img-thumbnail" id="preview"></video>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
        scanPeriod: 3
    });

    scanner.addListener('scan', function(content) {
        alert(content);
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
</script>