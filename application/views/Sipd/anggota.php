   
<div class="content">
<section class="container-fluid pt-3 mt-5">
    <div class="row">
    <h3>Tambah Data Pegawai</h3>
    <div class="container-fluid">
    <?php if($this->session->flashdata("success"))  { ?>
      <div class="alert alert-info">
        <?= $this->session->flashdata("success") ?>
      </div>
    <?php }else if($this->session->flashdata("error"))  { ?>
      <div class="alert alert-danger">
        <?= $this->session->flashdata("error") ?>
      </div>
    <?php } ?>
    <div>
      <form method="post"  enctype="multipart/form-data" action="<?= base_url('Sipd/Anggota/TambahAnggota') ?>" id="uploadpegawai">
          <input type="file" onchange="return cekexe()" name="upload_file" id="upload_file" class="form-control">
        <a href="<?= base_url('assets/upload/format/form_kar_upload.xlsx') ?>" class="btn btn-success btn-round">download format upload</a>

        <button type="submit" name="submit" class="btn btn-danger btn-round">Posting</button>
      </form>
      </div>
      
    </div>
    </div>

    <!-- <?php 
      if(isset($_POST['submit'])){ ?>
    <form action="<?= base_url('superadmin/TambahKaryawan/upload') ?>" method="post" >
      <table id="table" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPK</th>
          </tr>
        </thead>
        <tbody>
          <?php $no =1 ; foreach($sheetdata as $sheetdata ) :  ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $EmployeNumber?></td>
            <td><?= $Name?></td>
          </tr>
        <?php endforeach; ?> -->
        </tbody>
      </table>
      <div class="form-group">
        <button class="btn btn-info">posting data</button>
      </div>
    </form> 
    <?php }
    ?> 
  </section>

  <script type="text/javascript">
    function cekexe(){
      const file = document.getElementById('upload_file');
      const path  = file.value ;
      const exe = /(\.xlsx)$/i;
      if(!exe.exec(path)){
        alert("file salah");
        file.value = "";
        return ;
      }
    }

    function  (){
      const file = document.getElementById('upload_file');
      if(file.value == "" || file.value == null){
        alert("file masih kosong");
        return false  ;
      }
    }

    $(document).ready(function(){
      $("#table").DataTable();
    });
  </script>

  </div>