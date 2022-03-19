<div style="margin-top:120px; background-color:#F9FAFA;" class="container fixed-top">
  <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
    <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
  </div>
</div>
</div>
<div style="margin-top:100px; padding-top:30mm; background-color:#F9FAFA;" class="container-md mt-5 ">
  <div class="row">
    <div class="container-md-3">
      <div style="background-color:#6f9390; height:50px;" class=" alert alert" role="alert">
        <label style="background-color:#6f9390; font-size:13px; font-weight:solid" type="button" data-bs-toggle="modal" data-bs-target="#pengumuman" class="text-white  d-flex align-items-center justify-content-center">
          MOHON SCAN BARCODE UNTUK ABSENSI</label>
      </div>
      <form id="formAbsen" data-url="<?= base_url('Absen/getPlan') ?>" method="post" action="<?= base_url('Absen/getPlan') ?>" id="pilih-form">
        <input hidden type="text" name="id_absen" value="<?= $biodata->id_biodata ?>" id="id_absen">
        <input hidden type="text" name="npk" value="<?= $biodata->npk ?>" id="npk">
        <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="AreaKerja" id="AreaKerja">
          <option hidden value="<?= $employe->area_kerja  ?>"> </option>
        </select>
        <input hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="Jabatan" id="Jabatan" value="<?= $employe->jabatan  ?>">
        <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="Wilayah" id="Wilayah">
          <option hidden value="<?= $employe->wilayah ?>"></option>
        </select>
      </form>
      <div class="form-group ms-3 ps-4">
        <video width="250" class="img-thumbnail" id="preview"></video>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  let scanner = new Instascan.Scanner({

    video: document.getElementById('preview'),

    mirror: false,

    scanPeriod: 3

  });

  scanner.addListener('scan', function(content) {

    navigator.geolocation.getCurrentPosition(function(position) {
      var Jabatan = document.getElementById('Jabatan').value;
      var idTikor = $("select[name=AreaKerja] option:selected").val();
      const long = position.coords.longitude;
      const lat = position.coords.latitude;
      const acc = position.coords.accuracy;

      $.ajax({

        url: $("#formAbsen").attr('data-url'),
        method: "POST",
        data: "AreaKerja=" + idTikor,
        success: function(e) {
          var result = JSON.parse(e);
          const latitudeBarcode = result[0].latitude;
          const longitudeBarcode = result[0].longtitude;
          var Koma = ", ";
          const db = latitudeBarcode + Koma + longitudeBarcode;
          const text = content.split(",", 2);
          const la = text[0];
          const lo = text[1];
          if (Jabatan == "KORLAP") {
            var willl = $("select[name=Wilayah] option:selected").val();
            $.ajax({
              url: "<?= base_url('Absen/getlatitude') ?>",
              method: "POST",
              data: "latitude=" + la,
              success: function(response) {
                var raa = JSON.parse(response);
                const latitude = raa[0].wilayah;
                console.log(latitude);
                if (latitude == willl) {
                  $.ajax({
                    url: "<?= base_url("Absen/input/") ?>" + id_absen,
                    method: "POST",
                    contentTYpe: false,
                    processData: true,
                    cache: false,
                    success: function(response) {
                      if (response == "AndaTelahAbsen") {
                        Swal.fire({
                          icon: "warning",
                          title: "Perhatian",
                          text: "Anda Telah Absen Masuk, Silahkan Absen Pada Jam Pulang",
                          dangerMode: [true, "Ok"]
                        }).then(function() {
                          window.location.href = "<?= base_url('Profile') ?>"
                        })
                      } else if (response == "AbsenPulang") {
                        Swal.fire({
                          icon: "success",
                          title: "Berhasil",
                          text: "Absen Pulang Berhasil",
                          dangerMode: [true, "Ok"]
                        }).then(function() {
                          window.location.href = "<?= base_url('Profile') ?>"
                        })
                      } else if (response == "AbsenMasuk") {
                        Swal.fire({
                          icon: "success",
                          title: "Berhasil",
                          text: "Absen Masuk Berhasil",
                          dangerMode: [true, "Ok"]
                        }).then(function() {
                          window.location.href = "<?= base_url('Profile') ?>"
                        })
                      } else {
                        Swal.fire({
                          icon: "error",
                          title: "Perhatian",
                          text: "Anda Gagal Absen Silahkan Hubungi PIC Anda",
                          dangerMode: [true, "Ok"]
                        })
                      }
                    }
                  })
                } else {
                  Swal.fire({
                    icon: "warning",
                    title: "Perhatian",
                    text: "Anda Tidak Bisa Absen Di Luar Wilayah Anda",
                    dangerMode: [true, "Ok"]
                  })
                }
              }
            });
          } else if (content == db) {
            var id_absen = document.getElementById('id_absen').value;
            var npk = document.getElementById('npk').value;
            var barcode = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);
            // lokasi handphone
            var posisi_user = new google.maps.LatLng(lat, long);
            const jarak = (google.maps.geometry.spherical.computeDistanceBetween(barcode, posisi_user) / 1000).toFixed(2);
            if (jarak <= 0.05) {
              $.ajax({
                url: "<?= base_url("Absen/input/") ?>" + id_absen,
                methode: "POST",
                contentTYpe: false,
                processData: true,
                cache: false,
                success: function(response) {
                  if (response == "AndaTelahAbsen") {
                    Swal.fire({
                      icon: "warning",
                      title: "Perhatian",
                      text: "Anda Telah Absen Masuk, Silahkan Absen Pada Jam Pulang",
                      dangerMode: [true, "Ok"]
                    }).then(function() {
                      window.location.href = "<?= base_url('Profile') ?>"
                    })
                  } else if (response == "AbsenPulang") {
                    Swal.fire({
                      icon: "success",
                      title: "Berhasil",
                      text: "Absen Pulang Berhasil",
                      dangerMode: [true, "Ok"]
                    }).then(function() {
                      window.location.href = "<?= base_url('Profile') ?>"
                    })
                  } else if (response == "AbsenMasuk") {
                    Swal.fire({
                      icon: "success",
                      title: "Berhasil",
                      text: "Absen Masuk Berhasil",
                      dangerMode: [true, "Ok"]
                    }).then(function() {
                      window.location.href = "<?= base_url('Profile') ?>"
                    })
                  } else {
                    Swal.fire({
                      icon: "error",
                      title: "Perhatian",
                      text: "Anda Gagal Absen Silahkan Hubungi PIC Anda",
                      dangerMode: [true, "Ok"]
                    })
                  }
                }
              });
            } else {
              Swal.fire({
                icon: "warning",
                title: "Perhatian",
                text: "Anda Diluar Area Absen",
                dangerMode: [true, "Ok"]
              })
            }
          }
        }
      })
    })
  });


  Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[1]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function(e) {
    console.error(e);
  });
</script>