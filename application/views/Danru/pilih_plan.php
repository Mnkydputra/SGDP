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
                 <div id="dataPLAN" class="form-group">
                     <!-- isi plan nanti disini -->
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
         navigator.geolocation.getCurrentPosition(function(position) {
             var divisiId = $("select[name=tikor] option:selected").val();
             var idTikor = $("#tikor").val();
             const lat = position.coords.latitude;
             const long = position.coords.longitude;
             const acc = position.coords.accuracy;
             //  console.log("lat user" + lat);
             //  console.log("long user " + long);
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
 </script>