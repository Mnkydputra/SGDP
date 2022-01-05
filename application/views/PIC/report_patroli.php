<br>
<div class="bg-tikor col-lg-11 container-fluid mt-5">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Report Patroli Harian</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Report Patroli Periodik</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form method="post" target="_blank" action="<?= base_url('PIC/Report_Patroli/reportHarian') ?>">
                <label for="">Pilih Area Kerja</label>
                <select name="area_kerja1" id="" class="form-control text-dark">
                    <option value="VLC">ADM VLC</option>
                    <option value="HO">ADM HO</option>
                    <option value="DOR">DOR</option>
                    <option value="PC">PC</option>
                    <option value="P1">PLAN 1</option>
                    <option value="P2">PLAN 2</option>
                    <option value="P3">PLAN 3</option>
                    <option value="P4-ASSY1">PLAN 4 ASSY 1</option>
                    <option value="P4-ASSY2">PLAN 4 ASSY 2</option>
                    <option value="P5">PLAN 5</option>
                </select>

                <label for="">Tanggal Report</label>
                <input value="<?= date('Y-m-d') ?>" type="text" readonly name="day" class="form-control text-dark">
                <button class="btn btn-danger mt-2">Generate Report</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <form method="post" target="_blank" action="<?= base_url('PIC/Report_Patroli/reportPeriodik') ?>">

                <label for="">Pilih Area Kerja</label>
                <select name="area2" id="" class="form-control text-dark">
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

                <label for="">Tanggal Awal</label>
                <input value="<?= date('Y-m-d') ?>" id="datepicker2" type="text" name="day2" value="" class="form-control text-dark">

                <label for="">Tanggal Akhir</label>
                <input value="<?= date('Y-m-d') ?>" type="text" id="datepicker3" name="day3" value="" class="form-control text-dark">
                <button type="submit" class="btn btn-danger mt-2">Generate Report</button>
            </form>
        </div>
    </div>
    <div class="row">

    </div>
</div>

<script>
    // Initialize the agent at application startup.
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
        .then(FingerprintJS => FingerprintJS.load())

    // Get the visitor identifier when you need it.
    fpPromise
        .then(fp => fp.get())
        .then(result => {
            // This is the visitor identifier:
            const visitorId = result.visitorId
            console.log(visitorId)
        })
        .catch(error => console.error(error))
</script>