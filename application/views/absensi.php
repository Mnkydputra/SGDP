
  <div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
      <div class="container-md-3">
          <!-- <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
              <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center" >DAFTAR HADIR</label>
          </div> -->
          <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
          <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
          </div> 
      </div>
  </div>

  <div style="margin-top:100px; padding-top:25mm; background-color:#F9FAFA;"class="container-md mt-5 " >
                <div class="row">
                  <div class="container-md-3">
                      <div class="btn-group btn-group-toggle md-3" data-toggle="buttons">
                        <label class="btn btn-primary btn-sm">
                          <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                        </label>
                        <label class="btn btn-secondary btn-sm">
                          <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                        </label>
                      </div>
                      </div>
                  </div>
                <div class="row">
                  <div class="container-md-3">
                        <form id="formAbsen" data-url="<?= base_url('Absen/getPlan') ?>" method="post" action="<?= base_url('Absen/getPlan') ?>" id="pilih-form">
                         <input hidden type="text" name="id_absen" value="<?= $biodata->id_biodata?>" id="id_absen">
                         <input hidden type="text" name="npk" value="<?= $biodata->npk?>" id="npk">
                         <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="AreaKerja" id="AreaKerja">
                                  <option hidden value="<?=  $employe->area_kerja  ?>"> </option>
                          </select>
                      </form>
                      <div class="form-group">
                          <video style="border-radius:25px; width:320; height:240;"  class="img-thumbnail" id="preview" ></video>
                      </div>
                  </div>
                </div>
                
  </div>

        <?php if($this->session->flashdata('AbsenMasuk')){ ?>
          <script type="text/javascript">
            Swal.fire({
              icon : "success",
              title : "Berhasil",
              text : "Absen Masuk Berhasil",
              dangerMode : [true , "Ok"]
            })
          </script>
        <?php }else if($this->session->flashdata('AbsenPulang')) {?>
          <script type="text/javascript">
            Swal.fire({
              icon : "success",
              title : "Berhasil",
              text : "Absen Pulang Berhasil",
              dangerMode : [true , "Ok"]
            })
          </script>
        <?php }else if($this->session->flashdata('Gagal')) { ?>
          <script type="text/javascript">
            Swal.fire({
              icon : "error",
              title : "Perhatian",
              text : "Anda Gagal Absen Silahkan Hubungi PIC Anda",
              dangerMode : [true , "Ok"]
            })
          </script>
        <?php }else if($this->session->flashdata('AndaTelahAbsen')) { ?>
          <script type="text/javascript">
            Swal.fire({
              icon : "warning",
              title : "Perhatian",
              text : "Anda Telah Absen Masuk, Silahkan Absen Pada Jam Pulang",
              dangerMode : [true , "Ok"]
            })
          </script>
        <?php } ?> 


      <script type="text/javascript">
        let scanner = new Instascan.Scanner({
          video: document.getElementById('preview'),
          mirror:false,
          scanPeriod: 5
          });
        scanner.addListener('scan', function (content) { 
          navigator.geolocation.getCurrentPosition(function(position) {
            console.log(position);
            console.log(content);
                  var idTikor = $("select[name=AreaKerja] option:selected").val();
                  const long = position.coords.longitude;
                  const lat = position.coords.latitude;
                  const acc = position.coords.accuracy;
                 
            $.ajax({
              url: $("#formAbsen").attr('data-url'),
              method: "POST",
              data: "AreaKerja=" + idTikor,
              success: function(e){
                var result = JSON.parse(e);
                const latitudeBarcode = result[0].latitude;
                const longitudeBarcode = result[0].longtitude;
                var Koma = ", ";
                const db = latitudeBarcode + Koma + longitudeBarcode ;
               
                if(content == db ){
                    var id_absen = document.getElementById('id_absen').value;
                    var npk = document.getElementById('npk').value;
                    console.log(id_absen);
                    console.log(npk);
                    var barcode = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);
                    // lokasi handphone
                    var posisi_user = new google.maps.LatLng(lat, long);
                    const jarak = (google.maps.geometry.spherical.computeDistanceBetween(barcode, posisi_user)/ 1000).toFixed(2); 
                    if (jarak <= 0.05) {
                                Swal.fire({
                                    title:  'Sukses!',
                                    text:   'Absensi Anda Berhasil',
                                    icon:   'success',
                                    buttons: ['dangerMode', true]
                                }).then(function() {
                                   window.location = "<?= base_url("Absen/input/") ?>" + id_absen;
                                })
                                // alert("Lanjut isi dokumentasi");
                            } else {
                                Swal.fire({
                                    title: 'Attention!',
                                    text: 'Anda di Luar Area',
                                    icon: 'danger',
                                })
                            }
                }else {
                    Swal.fire({
                                    title: 'QR SALAH',
                                    text: 'Code QR Tidak Di Ketahui',
                                    icon: 'error',
                                })
                }
  
              }
            })
                  
          }); 
        });

        Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });
        
      </script>

