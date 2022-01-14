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

    <form id="form2" action="" enctype="multipart/form-data" method="post" >
      <div class="form-group">
          <img height="256" width="256" class="img-thumbnail" src="<?= base_url('assets/berkas/Poto/'). $berkas->foto ?>">
        </div>
        <div class="form-control">
        <input type="hidden" name="npk" value="<?= $this->session->userdata('id_akun')?>>">
        <input type="file" onchange="return validasi()" name="foto" id="file">
      </div>
      <span class="small text-danger"><b>hanya jpeg jpg dan png yang di ijinkan di upload</b> </span><br>
      <input type="submit" name="upload" id="submit" value="Upload" class="btn btn-primary btn-sm mt-2">
    </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
<br>
<script type="text/javascript">
  function validasi(){
    var file = document.getElementById('file');
    var path = file.value ;
    var exe = /(\.jpg|\.png|\.jpeg|\.gif)$/i;
      if(!exe.exec(path)){
        swal({
          icon : "error",
          title : "File Salah",
          dangerMode : [true,"Ok"]  
        });
        file.value = "" ;
        return false 
      }
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $("#form2").on('submit',function(event){
        event.preventDefault();
        if(document.getElementById('file').value == ""){
            swal({
              icon : "error",
              title : "File kosong ",
              dangerMode : [true,"Ok"]
            })
        }else {
            $.ajax({
              url : "<?= base_url('Danru/Profile/UpdateFoto') ?>",
              method : "POST",
              data : new FormData(this),
              processData : false ,
              contentType : false ,
              cache : false ,
              success : function(msg){
                  Swal.fire({
                    icon : "success",
                    title : "Berhasil"
                  }).then(function(){
                    window.location.href="<?= base_url("Danru/Profile/Foto") ?>";
                  })
              }
            })
        }
            
      })
  })
</script>


