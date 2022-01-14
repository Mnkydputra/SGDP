 <!-- Begin Page Content -->
 <div id="content" class="container-md" style="background-color:#F9FAFA;">
   <div class="row">
     <div class="col-md-3">
       <div class="card shadow ml-3 mr-3">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">Change Profile Picture</h6>
         </div>
         <div class="card-body">
           <div class="table-responsive md-3">

             <form id="form2" action="" enctype="multipart/form-data" method="post">
               <div class="form-group">
                 <input type="submit" name="upload" id="submit" value="Upload" class="btn btn-primary btn-sm mt-2 mb-5">
                 <img height="256" width="256" class="img-thumbnail" src="<?= base_url('assets/berkas/Poto/') . $berkas->foto ?>">
               </div>
               <div class="form-control">
                 <input type="hidden" name="npk" value="<?= $this->session->userdata('id_akun') ?>>">
                 <input type="file" class="text-dark" onchange="return validasi()" name="foto" id="file">
               </div>
               <span class="small text-danger"><b>hanya jpeg jpg dan png yang di ijinkan di upload</b> </span><br>
               <div id="info" class="alert-danger alert text-center" style="display:none">
                 <div class="spinner-border" role="status">
                 </div>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <br>
 <script type="text/javascript">
   function validasi() {
     var file = document.getElementById('file');
     var path = file.value;
     var exe = /(\.jpg|\.png|\.jpeg|\.gif)$/i;
     if (!exe.exec(path)) {
       swal.fire({
         icon: "error",
         title: "Format File Salah",
         dangerMode: [true, "Ok"]
       });
       file.value = "";
       return;
     }
   }
 </script>
 <script type="text/javascript">
   $(document).ready(function() {
     $("#form2").on('submit', function(event) {
       event.preventDefault();
       const fle = document.getElementById('file');
       //  alert(fle.value);
       if (document.getElementById('file').value == "") {
         swal.fire({
           icon: "error",
           title: "File kosong ",
           dangerMode: [true, "Ok"]
         })
       } else {
         $.ajax({
           url: "<?= base_url('Anggota/Profile/UpdateFoto') ?>",
           method: "POST",
           data: new FormData(this),
           processData: false,
           contentType: false,
           cache: false,
           beforeSend: function() {
             document.getElementById('submit').style.display = 'none';
             document.getElementById('info').style.display = 'block';
           },
           complete: function() {
             $("#submit").val('upload');
             document.getElementById('submit').style.display = 'block';
             document.getElementById('info').style.display = 'none';
           },
           success: function(msg) {
             Swal.fire({
               icon: "success",
               title: "Berhasil"
             }).then(function() {
               window.location.href = "<?= base_url("Anggota/Profile/Foto") ?>";
             })
           }
         })
       }

     })
   })
 </script>