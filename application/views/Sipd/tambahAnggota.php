<div style="background-color: #e3e3e1;" class="container-fluid mt-3 pt-5">
<div class="container">
    <div class="row">
    <h3>Upload Anggota Baru</h3>
    <div>
      <form method="post"  enctype="multipart/form-data" action="<?= base_url('Sipd/TambahAnggota/Upload') ?>" id="uploadpegawai">
          <input type="file" onchange="return cekexe()" name="Format_Upload" id="Format_Upload" class="form-control">
        <a href="<?= base_url('assets/upload/format/form_kar_upload.xlsx') ?>" class="btn btn-success btn-round">download format upload</a>

        <button type="submit" name="submit" class="btn btn-danger btn-round">Posting</button>
      </form>
      </div>
      
    </div>
    </div>
</div>

  <script type="text/javascript">
    function cekexe(){
      const file = document.getElementById('Format_Upload');
      const path  = file.value ;
      const exe = /(\.xlsx)$/i;
      if(!exe.exec(path)){
        alert("file salah");
        file.value = "";
        return ;
      }
    }

    function  (){
      const file = document.getElementById('Format_Upload');
      if(file.value == "" || file.value == null){
        alert("file masih kosong");
        return false  ;
      }
    }

    $(document).ready(function(){
      $("#table").DataTable();
    });
  </script>

