<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
        </div>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
    <div class="row">
        <div class="container-md-3">
            <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">
                <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>
            </div>
        </div>
        <div class="graph-wr">

            <form onsubmit="return cek()" method="post" action="<?= base_url('Danru/Patrol/getPlan') ?>" id="pilih-form">
                <select style="border:2px solid #ccc;width:100%;" class="mb-2" name="plan_id" id="plan_id">
                    <option value="">Pilih Plan Patrol</option>
                    <?php foreach ($plan as $pln) : ?>
                        <option value="<?= $pln->id ?>"><?= $pln->plan  ?></option>
                    <?php endforeach ?>
                </select>
                <button type="submit" class="btn btn-danger">Show Camera</button>
            </form>
        </div>
    </div>
</div>

<script>
    function cek() {
        var divisiId = $("select[name=plan_id] option:selected").val();
        if (divisiId == null || divisiId == "") {
            // alert("Pilih Plan");
            Swal.fire({
                title: 'Attention!',
                text: 'Pilih Plan Patroli',
                icon: 'danger',
                buttons: ['dangerMode', true]
            })
            return false;
        }
    }
</script>