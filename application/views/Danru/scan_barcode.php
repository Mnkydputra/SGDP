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
             <form id="formTikor" data-url="<?= base_url('Danru/Patrol/getPlan') ?>">
                 <div id="dataPLAN" class="form-group">
                     <!-- isi plan nanti disini -->
                     <select class="form-control text-dark" name="area" id="area_kerja">
                         <option value="">Pilih Plan</option>
                         <option value="P1">PLAN 1 <i class="bx bx-calendar"></i></option>
                         <option value="P2">PLAN 2</option>
                         <option value="P3">PLAN 3</option>
                         <option value="P4-ASSY1">PLAN 4 - ASSY 1</option>
                         <option value="P4-ASSY2">PLAN 4 - ASSY 2</option>
                         <option value="P5">PLAN 5</option>
                         <option value="VLC">VLC</option>
                         <option value="HO">HEAD OFFICE</option>
                         <option value="DOR">DORMITORY</option>
                     </select>

                     <div class="mt-2" id="showLokasi">

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
     // pilih plan dan titik barcode
     $(function() {
         $('select[name=area').on('change', function() {
             var id = $("select[name=area] option:selected").val();
             if (id == null || id == "") {
                 document.getElementById("showLokasi").innerHTML = "";
                 Instascan.Camera.getCameras().then(function(cameras) {
                     if (cameras.length > 0) {
                         scanner.start(cameras[2]);
                     } else {
                         console.error('No cameras found.');
                     }
                 }).catch(function(e) {
                     console.error(e);
                 });
             } else {
                 $.ajax({
                     url: "<?= base_url('Danru/Patrol/getIDPLAN') ?>",
                     method: "POST",
                     data: "id_plan=" + id,
                     cache: false,
                     success: function(e) {
                         document.getElementById("showLokasi").innerHTML = e;
                         Instascan.Camera.getCameras().then(function(cameras) {
                             if (cameras.length > 0) {
                                 scanner.start(cameras[1]);
                             } else {
                                 console.error('No cameras found.');
                             }
                         }).catch(function(e) {
                             console.error(e);
                         });
                     }
                 })
             }
         });
     })
     // end


     //tampilkan camera untuk scan barcode
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
             var idPLAN = $("select[name=titik] option:selected").val();
             var idTikor = $("#tikor").val();
             const lat = position.coords.latitude;
             const long = position.coords.longitude;
             const acc = position.coords.accuracy;
             //  console.log("lat user" + lat);
             //  console.log("long user " + long);
             $.ajax({
                 url: $("#formTikor").attr('data-url'),
                 method: "POST",
                 data: "tikor=" + idTikor + '&barcode=' + content,
                 success: function(e) {

                     if (e == "OK") {
                         Swal.fire({
                             title: 'Attention!',
                             text: 'Area Sudah Di Lewati',
                             icon: 'error',
                         })
                     } else if (e == 0) {
                         Swal.fire({
                             title: 'Attention!',
                             text: 'Barcode Invalid',
                             icon: 'error',
                         })
                     } else {
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
                         if (jarak <= 0.04) {
                             Swal.fire({
                                 title: 'Sukses!',
                                 text: 'Lanjut Documentasi',
                                 icon: "success",
                             }).then(function() {
                                 window.location = "<?= base_url("Danru/Patrol/input_report/") ?>" + idPLAN;
                             })
                         } else {
                             Swal.fire({
                                 title: 'Attention!',
                                 text: 'Anda di Luar Area',
                                 icon: 'error',
                             })
                         }
                     }
                 }
             })
         });
     });
 </script>