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

             <form id="formTikor" data-url="<?= base_url('Danru/Patrol/getPlan') ?>" method="post" action="<?= base_url('Danru/Patrol/getPlan') ?>" id="pilih-form">
                 <!-- <select style="border:2px solid #ccc;width:100%" class="mb-2" name="plan_id" id="plan_id">
                    <option value="">Pilih Plan Patrol</option>
                    <?php foreach ($plan as $pln) : ?>
                        <option value="<?= $pln->id_plan ?>"><?= $pln->plan  ?></option>
                    <?php endforeach ?>
                </select> -->

                 <div id="dataPLAN" class="form-group">
                     <!-- isi plan nanti disini -->
                     <!-- <select name="tikor" style="border:2px solid #ccc;width:100%;" id="tikor">
                         <?php foreach ($tikor as $tk) : ?>
                             <option selected value="<?= $tk->id ?>"><?= $tk->urutan . ". " . $tk->lokasi  ?> </option>
                         <?php endforeach ?>
                     </select> -->
                     <div class="alert-danger text-center">
                         <?php if ($tikor->num_rows() > 0) { ?>
                             <?php foreach ($tikor->result() as $tk) : ?>
                                 <label for="" class="">Patroli ke <?= $tk->lokasi ?></label>
                             <?php endforeach ?>
                             <input type="hidden" id="tikor" value="<?= $tk->id ?>" name="tikor">
                         <?php } else { ?>
                             <div class="alert alert-danger">
                                 <label for="">Patroli Selesai</label>
                                 <a href="<?= base_url('Danru/Patrol/urutan/1') ?>" class="">klik disini untuk kembali ke titik awal</a>
                             </div>
                             <input type="hidden" id="tikor" value="0" name="tikor">
                         <?php } ?>
                     </div>
                 </div>
             </form>
             <div class="form-group">
                 <video class="img img-thumbnail" id="preview"></video>
             </div>
         </div>
     </div>
 </div>

 <script>
     // barcode
     let scanner = new Instascan.Scanner({
         video: document.getElementById('preview'),
         mirror: true,
         scanPeriod: 5
     });
     scanner.addListener('scan', function(content) {
         //  console.log(content);
         const txt = content.split(",", 2);
         const lo = txt[0];
         const la = txt[1];
         console.log(lo);
         console.log(la);
         navigator.geolocation.getCurrentPosition(function(position) {
             var divisiId = $("select[name=tikor] option:selected").val();
             var idTikor = $("#tikor").val();
             // console.log(idTikor);
             const lat = position.coords.latitude;
             const long = position.coords.longitude;
             const acc = position.coords.accuracy;
             //  console.log("lat user" + lat);
             //  console.log("long user " + long);
             // console.log(position);
             $.ajax({
                 url: $("#formTikor").attr('data-url'),
                 method: "POST",
                 data: "tikor=" + idTikor,
                 success: function(e) {
                     // console.log(e);
                     var result = JSON.parse(e);
                     const latitudeBarcode = result[0].latitude;
                     const longitudeBarcode = result[0].longitude;
                     const lokasi = result[0].id;
                     //  console.log("lat barcode " + latitudeBarcode);
                     //  console.log("long barcode " + longitudeBarcode);

                     //lokasi titik barcode disimpan 
                     var plan = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);
                     // var plan = new google.maps.LatLng(-6.145800, 106.885018);


                     //lokasi perangkat user 
                     var posisi_user = new google.maps.LatLng(lat, long);
                     const jarak = (google.maps.geometry.spherical.computeDistanceBetween(plan, posisi_user) / 1000).toFixed(2);
                     console.log(jarak);
                     if (jarak <= 0.03) {
                         Swal.fire({
                             title: 'Sukses!',
                             text: 'Lanjut Documentasi',
                             icon: "success",
                         }).then(function() {
                             window.location = "<?= base_url("Danru/Patrol/form_report/") ?>" + lokasi;
                         })
                     } else {
                         Swal.fire({
                             title: 'Attention!',
                             text: 'Anda di Luar Area',
                             icon: 'error',
                         })
                     }
                 }
             })
         });
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
     $(function() {
         $('select[name=plan_id]').on('change', function() {
             var tikor = $(this).children("option:selected").val();
             if (tikor == null || tikor == "") {
                 document.querySelector('video').setAttribute("id", "");

                 document.getElementById('dataPLAN').innerHTML = "";
             } else {
                 $.ajax({
                     url: "<?= base_url('Danru/Patrol/titik') ?>",
                     method: "POST",
                     data: "titik=" + tikor,
                     success: function(e) {
                         // console.log(e);
                         document.getElementById('dataPLAN').innerHTML = e;
                     }
                 })
             }
         });
     })
 </script>