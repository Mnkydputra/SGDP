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
            <form action="">

                <label for="">Pilih Area Kerja</label>
                <select name="" id="" class="form-control text-dark">
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

                <label for="">Tanggal Report</label>
                <input value="<?= date('Y-m-d') ?>" type="text" name="day" value="" class="form-control text-dark">
                <button class="btn btn-danger mt-2">Generate Report</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <form action="">

                <label for="">Pilih Area Kerja</label>
                <select name="" id="" class="form-control text-dark">
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
                <input value="<?= date('Y-m-d') ?>" id="datepicker2" type="text" name="day" value="" class="form-control text-dark">

                <label for="">Tanggal Akhir</label>
                <input value="<?= date('Y-m-d') ?>" type="text" id="datepicker3" name="day" value="" class="form-control text-dark">
                <button class="btn btn-danger mt-2">Generate Report</button>
            </form>
        </div>
    </div>
    <div class="row">

    </div>
</div>