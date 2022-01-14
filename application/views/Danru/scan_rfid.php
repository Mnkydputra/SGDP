 <!-- <?php
        if ($this->session->userdata("ok")) { ?>
            <script>
                Swal.fire({
                    title: 'Sukses ',
                    text: 'Report Terkirim',
                    icon: 'success',
                })
            </script>
        <?php } else if ($this->session->userdata("nok")) { ?>
            <script>
                Swal.fire({
                    title: 'Failed ',
                    text: 'Report Gagal Terkirim',
                    icon: 'error',
                })
            </script>
        <?php }
        ?> -->
 <!-- Sticky top -->
 <div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
     <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
     <div class="container-md-3">
         <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
             <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
         </div>
         <a style="position:relative;width:100%" class="fixed-top btn btn-danger btn-sm mb-2" href="#">
             <span class="bx bx-street-view"></span> I - PATROL
         </a>
     </div>
 </div>
 <!-- End Sticky Top -->

 <div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
     <div class="row">
         <!--<div class="container-md-3">-->
         <!--    <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">-->
         <!--        <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>-->
         <!--    </div>-->
         <!--</div>-->
         <div class="graph-wr">
             <form method="post" id="formTikor" action="<?= base_url('Danru/Patrol/input_id') ?>">
                 <div id="dataPLAN" class="form-group" style="margin-top:45px">
                     <!-- isi plan nanti disini -->
                     <?php if ($this->session->flashdata("fail")) { ?>
                         <div class="alert alert-danger">
                             <label>NFC tidak terdaftar di sistem</label>
                         </div>
                     <?php } ?>
                     <input type="password" autocomplete="off" readonly placeholder="Scan RFID" class="form-control text-dark mb-1" autofocus name="id_card">
                     <select class="form-control text-dark " name="area" id="area_kerja">
                         <option value="" data-icon="bx bx-street-view">Pilih Area </option>
                         <option value="P1" data-thumbnail="bx bx-street-view">PLAN 1 </option>
                         <option value="P2">PLAN 2</option>
                         <option value="P3">PLAN 3</option>
                         <option value="P4-ASSY1">PLAN 4 - ASSY 1</option>
                         <option value="P4-ASSY2">PLAN 4 - ASSY 2</option>
                         <option value="P5">PLAN 5</option>
                         <option value="VLC">VLC</option>
                         <option value="HO">HEAD OFFICE</option>
                         <option value="DOR">DORMITORY</option>
                         <option value="PC">PARK CENTER</option>
                     </select>
                     <div class="mt-2" id="showLokasi">
                     </div>

                 </div>
             </form>
         </div>
     </div>
 </div>