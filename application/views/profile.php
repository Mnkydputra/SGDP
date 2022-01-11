<div id="content" class="container-md" style="background-color:#F9FAFA;">
  <div class="row">
    <div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="btn btn-dark bg-danger text-dark ps-2 ms-2 my-2 nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
            <h6>Profil Diri</h6>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="btn btn-dark bg-info text-dark ps-3 ms-2 my-2 nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
            <h6> Status</h6>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="btn btn-dark bg-warning text-dark ps-3 ms-2 my-2 nav-link" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi" type="button" role="tab" aria-controls="absen" aria-selected="false">
            <h6>Absensi</h6>
          </button>
        </li>
      </ul>
    </div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <div class="col-md-3">
            <table class="table ">
              <td>NPK</td>
              <td>:</td>
              <td><?= $biodata->npk ?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $biodata->nama ?></td>
              </tr>
              <tr>
                <td>Nomor KTP</td>
                <td>:</td>
                <td><?= $biodata->ktp ?></td>
              </tr>
              <tr>
                <td>Nomor KK</td>
                <td>:</td>
                <td><?= $biodata->kk ?></td>
              </tr>

              <tr>
                <td>Alamat KTP</td>
                <td>:</td>
                <td>JL: <?= $biodata->jl_ktp ?>, RT:<?= $biodata->rt_ktp ?>/RW:<?= $biodata->rw_ktp ?>. KELURAHAN : <?= $biodata->kel_ktp ?> , KECAMATAN : <?= $biodata->kec_ktp ?>. KOTA / KABUPATEN : <?= $biodata->kota_ktp ?>. PROVINSI : <?= $biodata->provinsi_ktp ?> </td>
              </tr>
              <tr>
                <td>Alamat Domisili</td>
                <td>:</td>
                <td>JL: <?= $biodata->jl_dom ?>, RT:<?= $biodata->rt_dom ?>/RW:<?= $biodata->rw_dom ?>. KELURAHAN : <?= $biodata->kel_dom ?> , KECAMATAN : <?= $biodata->kec_dom ?>. Kota/Kabupaten : <?= $biodata->kota_dom ?>. PROVINSI : <?= $biodata->provinsi_dom ?> </td>
              </tr>
              <tr>
                <td>Alamat Email</td>
                <td>:</td>
                <td><?= $biodata->email ?></td>
              </tr>
              <tr>
                <td>No Handhphone</td>
                <td>:</td>
                <td><?= $biodata->no_hp ?> </td>
              </tr>

              <tr>
                <td>No Emergency</td>
                <td>:</td>
                <td><?= $biodata->no_emergency ?> </td>
              </tr>

              <tr>
                <td>Tinggi Badan</td>
                <td>:</td>
                <td> <?= $biodata->tinggi_badan ?> cm</td>
              </tr>
              <tr>
                <td>Berat Badan</td>
                <td>:</td>
                <td> <?= $biodata->berat_badan ?> Kg</td>
              </tr>
              <tr>
                <td>Nilai IMT</td>
                <td>:</td>
                <td><?= $biodata->imt ?></td>
              </tr>
              <tr>
                <td>Keterangan IMT</td>
                <td>:</td>
                <td><?= $biodata->keterangan ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <!-- Button update -->
                  <button type="button" class="btn btn-primary pull right" data-bs-toggle="modal" data-bs-target="#ModalBiodata">
                    Update Biodata
                  </button>
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- MODAL BIODATA -->
      <!-- Button trigger modal tabindex="-1" -->
      <!-- Modal -->
      <div class="modal fade" id="ModalBiodata" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalBiodata"><u>UPDATE BIODATA</u></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" id="form<?= $biodata->id_biodata ?>" style="color:black">
                <div class="row">
                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                    <h5>Biodata</h5>
                    <label for="no_ktp">No KTP</label>
                    <input type="hidden" name="id_biodata" value="<?= $biodata->id_biodata ?>">
                    <input type="hidden" name="npk" value="<?= $biodata->npk ?>">
                    <input type="text" name="no_ktp" id="no_ktp" value="<?= $biodata->ktp ?>" class="form-control text-dark" placeholder="">

                    <label for="no_kk">No KK</label>
                    <input type="text" name="no_kk" id="no_kk" value="<?= $biodata->kk ?>" class="form-control text-dark" placeholder="">

                    <label for="no_hp">No Handphone</label>
                    <input type="tel" name="no_hp" id="no_hp" value="<?= $biodata->no_hp ?>" class="form-control text-dark" placeholder="">

                    <label for="no_emergency">No Emergency</label>
                    <input type="tel" name="no_emergency" id="no_emergency" value="<?= $biodata->no_emergency ?>" class="form-control text-dark" placeholder="">

                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" value="<?= $biodata->email ?>" class="form-control text-dark" placeholder="">


                  </div>
                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                    <h5>Alamat KTP</h5>
                    <label for="jl_ktp">Nama Jalan & Nomor Rumah</label>
                    <input type="text" name="jl_ktp" id="jl_ktp" value="<?= $biodata->jl_ktp ?>" class="form-control text-dark" placeholder="">

                    <label for="rt_ktp">RT</label>
                    <select class="form-control text-dark" name="rt_ktp" id="rt_ktp">
                      <option selected value="<?= $biodata->rt_ktp ?>"><?= $biodata->rt_ktp ?></option>
                      <option value="001">001</option>
                      <option value="002">002</option>
                      <option value="003">003</option>
                      <option value="004">004</option>
                      <option value="005">005</option>
                      <option value="006">006</option>
                      <option value="007">007</option>
                      <option value="008">008</option>
                      <option value="009">009</option>
                      <option value="010">010</option>
                      <option value="011">011</option>
                      <option value="012">012</option>
                      <option value="013">013</option>
                      <option value="014">014</option>
                      <option value="015">015</option>
                      <option value="016">016</option>
                      <option value="017">017</option>
                      <option value="018">018</option>
                      <option value="019">019</option>
                      <option value="020">020</option>
                    </select>

                    <label for="rw_ktp">RW</label>
                    <select class="form-control text-dark" name="rw_ktp" id="rw_ktp">
                      <option selected value="<?= $biodata->rw_ktp ?>"><?= $biodata->rw_ktp ?></option>
                      <option value="001">001</option>
                      <option value="002">002</option>
                      <option value="003">003</option>
                      <option value="004">004</option>
                      <option value="005">005</option>
                      <option value="006">006</option>
                      <option value="007">007</option>
                      <option value="008">008</option>
                      <option value="009">009</option>
                      <option value="010">010</option>
                      <option value="011">011</option>
                      <option value="012">012</option>
                      <option value="013">013</option>
                      <option value="014">014</option>
                      <option value="015">015</option>
                      <option value="016">016</option>
                      <option value="017">017</option>
                      <option value="018">018</option>
                      <option value="019">019</option>
                      <option value="020">020</option>
                    </select>

                    <label for="form_post">Provinsi</label>
                    <select class="form-control m-b text-dark" name="provinsi_ktp" id="propinsi">
                      <!-- kosong data propinsi -->
                      <option selected value="<?= $biodata->provinsi_ktp ?>">
                        <?= $biodata->provinsi_ktp ?></option>
                      <?php for ($i = 0; $i < count($provinsi->list); $i++) { ?>
                        <option value="<?= $provinsi->list[$i]->kode ?>"><?= $provinsi->list[$i]->nama ?></option>
                      <?php } ?>
                    </select>


                    <label for="form_post">Kabupaten / Kota</label>
                    <select class="form-control m-b text-dark" name="kabupaten_ktp" id="kabupaten">
                      <option selected value="<?= $biodata->kota_ktp ?>"><?= $biodata->kota_ktp ?></option>
                    </select>

                    <label for="form_post">Kecamatan</label>
                    <select class="form-control m-b text-dark" name="kecamatan_ktp" id="kecamatan">
                      <option selected value="<?= $biodata->kec_ktp ?>">
                        <?= $biodata->kec_ktp ?>
                      </option>
                    </select>


                    <label for="form_post">Kelurahan / Desa <small>*</small></label>
                    <select class="form-control m-b text-dark" name="kelurahan_ktp" id="kelurahan">
                      <option selected value="<?= $biodata->kel_ktp ?>"><?= $biodata->kel_ktp ?></option>
                    </select>
                    <script>

                    </script>

                  </div>

                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                    <h5>Alamat Domisili</h5>
                    <label for="jl_dom">Nama Jalan & Nomor Rumah</label>
                    <input type="text" name="jl_dom" id="jl_dom" value="<?= $biodata->jl_dom ?>" class="form-control text-dark" placeholder="">

                    <label for="rt_dom">RT</label>
                    <select class="form-control text-dark" name="rt_dom" id="rt_dom">
                      <option selected value="<?= $biodata->rt_dom ?>"><?= $biodata->rt_dom ?></option>
                      <option value="001">001</option>
                      <option value="002">002</option>
                      <option value="003">003</option>
                      <option value="004">004</option>
                      <option value="005">005</option>
                      <option value="006">006</option>
                      <option value="007">007</option>
                      <option value="008">008</option>
                      <option value="009">009</option>
                      <option value="010">010</option>
                      <option value="011">011</option>
                      <option value="012">012</option>
                      <option value="013">013</option>
                      <option value="014">014</option>
                      <option value="015">015</option>
                      <option value="016">016</option>
                      <option value="017">017</option>
                      <option value="018">018</option>
                      <option value="019">019</option>
                      <option value="020">020</option>
                    </select>

                    <label for="rw_dom">RW</label>
                    <select class="form-control text-dark" name="rw_dom" id="rw_dom">
                      <option selected value="<?= $biodata->rw_dom ?>"><?= $biodata->rw_dom ?></option>
                      <option value="001">001</option>
                      <option value="002">002</option>
                      <option value="003">003</option>
                      <option value="004">004</option>
                      <option value="005">005</option>
                      <option value="006">006</option>
                      <option value="007">007</option>
                      <option value="008">008</option>
                      <option value="009">009</option>
                      <option value="010">010</option>
                      <option value="011">011</option>
                      <option value="012">012</option>
                      <option value="013">013</option>
                      <option value="014">014</option>
                      <option value="015">015</option>
                      <option value="016">016</option>
                      <option value="017">017</option>
                      <option value="018">018</option>
                      <option value="019">019</option>
                      <option value="020">020</option>
                    </select>


                    <label for="provinsi">Provinsi</label>
                    <select class="form-control m-b text-dark" name="provinsi_dom" id="propinsi_dom">
                      <option value="<?= $biodata->provinsi_dom ?>">
                        <?= $biodata->provinsi_dom ?>
                      </option>
                      <?php for ($i = 0; $i < count($provinsi->list); $i++) { ?>
                        <option value="<?= $provinsi->list[$i]->kode ?>"><?= $provinsi->list[$i]->nama ?></option>
                      <?php } ?>
                    </select>
                    </select>

                    <label for="form_post">Kabupaten / Kota</label>
                    <select class="form-control m-b text-dark" name="kota_dom" id="kabupaten_dom">
                      <option selected value="<?= $biodata->kota_dom ?>"><?= $biodata->kota_dom ?></option>
                    </select>

                    <label for="form_sex">Kecamatan</label>
                    <select class="form-control m-b text-dark" name="kec_dom" id="kecamatan_dom">
                      <option selected value="<?= $biodata->kec_dom ?>"><?= $biodata->kec_dom ?></option>
                    </select>


                    <label for="form_post">Kelurahan / Desa <small>*</small></label>
                    <select class="form-control m-b text-dark" name="kel_dom" id="kelurahan_dom">
                      <option selected value="<?= $biodata->kel_dom ?>"><?= $biodata->kel_dom ?></option>
                    </select>

                  </div>

                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                    <h5>Postur Tubuh</h5>
                    <label for="berat_badan">Berat Badan</label>
                    <input type="text" name="berat_badan" id="berat_badan" value="<?= $biodata->berat_badan ?>" class="form-control text-dark" placeholder="">

                    <label for="tinggi_badan">Tinggi Badan</label>
                    <input type="text" name="tinggi_badan" id="tinggi_badan" value="<?= $biodata->tinggi_badan ?>" class="form-control text-dark" placeholder="">

                    <label for="imt">IMT</label>
                    <input type="text" readonly="" name="imt" id="imt" value="<?= $biodata->imt ?>" class="form-control text-dark" placeholder="">
                    <label for="imt">Keterangan IMT</label>
                    <input type="text" readonly="" name="keterangan" id="keterangan" value="<?= $biodata->keterangan ?>" class="form-control text-dark" placeholder="">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" id="submit" data-bs-dismiss="modal" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        //kirim data biodata untuk di update lewat ajax
        $(document).ready(function() {

          $("#form<?= $biodata->id_biodata ?>").on('submit', function(event) {
            event.preventDefault();
            var id_biodata = "<?= $biodata->id_biodata   ?>";
            var no_ktp = document.getElementById('no_ktp').value;
            var no_kk = document.getElementById('no_kk').value;
            var no_hp = document.getElementById('no_hp').value;
            var no_emergency = document.getElementById('no_emergency').value;
            var email = document.getElementById('email').value;
            var jl_ktp = document.getElementById('jl_ktp').value;
            var rt_ktp = document.getElementById('rt_ktp').value;
            var rw_ktp = document.getElementById('rw_ktp').value;
            var provinsi_ktp = $("select[name=provinsi_ktp] option:selected").text();
            var kabupaten_ktp = $("select[name=kabupaten_ktp] option:selected").text();
            var kecamatan_ktp = $("select[name=kecamatan_ktp] option:selected").text();
            var keluraha_ktp = $("select[name=kel_dom] option:selected").text();
            var jl_dom = document.getElementById('jl_dom').value;
            var rt_dom = document.getElementById('rt_dom').value;
            var rw_dom = document.getElementById('rw_dom').value;
            var rw_ktp = document.getElementById('rw_ktp').value;
            var propinsiDom = $("select[name=provinsi_dom] option:selected").text();
            var kabupatenDom = $("select[name=kota_dom] option:selected").text();
            var kecamatanDom = $("select[name=kec_dom] option:selected").text();
            var kelurahanDom = $("select[name=provinsi_dom] option:selected").text();
            var berat_badan = document.getElementById('berat_badan').value;
            var tinggi_badan = document.getElementById('tinggi_badan').value;
            var imt = document.getElementById('imt').value;
            var keterangan = document.getElementById('keterangan').value;

            $.ajax({
              url: "<?= base_url('Profile/BiodataUpdate') ?>",
              data: "id_biodata=" + id_biodata + "&no_kk=" + no_kk + "&no_hp=" + no_hp + "&no_emergency=" + no_emergency + "&email=" + email + "&jl_ktp=" + jl_ktp + "&rt_ktp=" + rt_ktp + "&rw_ktp=" + rw_ktp + "&kelurahan_ktp=" + keluraha_ktp + "&kecamatan_ktp=" + kecamatan_ktp + "&kabupaten_ktp=" + kabupaten_ktp + "&provinsi_ktp=" + provinsi_ktp + "&jl_dom=" + jl_dom + "&rt_dom=" + rt_dom + "&rw_dom=" + rw_dom + "&kel_dom=" + kelurahanDom + "&kec_dom=" + kecamatanDom + "&kota_dom=" + kabupatenDom + "&provinsi_dom=" + propinsiDom + "&berat_badan=" + berat_badan + "&tinggi_badan=" + tinggi_badan + "&imt=" + imt + "&keterangan=" + keterangan,
              //data: new FormData(this),
              method: "POST",
              processData: false,
              cache: false,
              success: function(response) {
                Swal.fire({
                  icon: "success",
                  title: response
                }).then(function() {
                  window.location.href = "<?= base_url("Profile") ?>"
                })
              }
            })
          })
        })
      </script>
      <!-- END MODAL BIODATA -->

      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <div class="col-md-3">
            <table class="table">
              <td>No KTA</td>
              <td>:</td>
              <td><?= $employee->no_kta ?></td>
              </tr>
              <tr>
                <td>Tanggal Expired KTA</td>
                <td>:</td>
                <td><?= $employee->expired_kta ?></td>
              </tr>

              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?= $employee->jabatan ?></td>

              </tr>


              <tr>
                <td>Status KTA</td>
                <td>:</td>
                <td><?= $employee->status_kta ?></td>
              </tr>

              <tr>
                <td>Area Kerja</td>
                <td>:</td>
                <td><?= $employee->area_kerja ?></td>
              </tr>



              <tr>
                <td>Tanggal Masuk Sigap</td>
                <td>:</td>
                <td><?= $employee->tgl_masuk_sigap ?></td>
              </tr>

              <tr>
                <td>Tanggal Masuk ADM</td>
                <td>:</td>
                <td><?= $employee->tgl_masuk_adm ?></td>
              </tr>

              <tr>
                <td></td>
                <td></td>
                <td>
                  <!-- Button update -->
                  <button type="button" class="btn btn-primary pull right" data-bs-toggle="modal" data-bs-target="#ModalStatus">
                    Update Biodata
                  </button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="absensi" role="tabpanel" aria-labelledby="absensi-tab">
        <div class="row">
          <div class="col-sm-2">
            <select name="bulan" id="bulan">
              <option value="">Pilih Bulan</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
            <div id="report_absen">
              <!-- show tanggal disini -->
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Provinsi</label>
              <div class="col-sm-6">
                <select id="provinsi" class="form-control" name="provinsi"></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Kabupaten</label>
              <div class="col-sm-6">
                <select id="kabupaten" class="form-control" name="kabupaten"></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Kecamatan</label>
              <div class="col-sm-6">
                <select id="kecamatan" class="form-control" name="kecamatan"></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Kelurahan</label>
              <div class="col-sm-6">
                <select id="kelurahan" class="form-control" name="kelurahan"></select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL STATUS -->
      <div class="modal fade" id="ModalStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalStatus"><u>UPDATE STATUS</u></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" id="formEmployee" style="color:black">
                <div class="row">
                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                    <label for="no_kta">No KTA</label>
                    <input type="hidden" name="id_employe" value="<?= $employee->id_employee ?>">
                    <input type="hidden" name="npk" value="<?= $employee->npk ?>">
                    <input type="text" name="no_kta" id="no_kta" value="<?= $employee->no_kta ?>" class="form-control text-dark" placeholder="">

                    <label for="ex_kta">Expired KTA</label>
                    <input type="text" name="ex_kta" id="datepicker1" value="<?= $employee->expired_kta ?>" class="form-control text-dark" placeholder="">

                    <label for="ex_kta">Jabatan</label>
                    <select class="form-control text-dark" name="jabatan" id="jabatan">
                      <option selected value="<?= $employee->jabatan ?>"><?= $employee->jabatan ?></option>
                      <option value="KORLAP">KORLAP</option>
                      <option value="DANRU">DANRU</option>
                      <option value="PKD">PKD</option>
                      <option value="ANGGOTA">ANGGOTA</option>
                    </select>

                    <label for="ex_kta">Area Kerja</label>
                    <select class="form-control text-dark" name="area_kerja" id="area_kerja">
                      <option selected value="<?= $employee->area_kerja ?>"><?= $employee->area_kerja ?></option>
                      <option value="P1">P1</option>
                      <option value="P2">P2</option>
                      <option value="P3">P3</option>
                      <option value="P4">P4</option>
                      <option value="P5">P5</option>
                      <option value="HO">HO</option>
                      <option value="VLC">VLC</option>
                      <option value="PC">PC</option>
                      <option value="DORMITORY">DORMITORY</option>
                    </select>


                    <label for="masuk_sigap">Tanggal Masuk Sigap</label>
                    <input type="text" name="masuk_sigap" id="datepicker2" value="<?= $employee->tgl_masuk_sigap ?>" class="form-control text-dark" placeholder="">

                    <label for="masuk_adm">Tanggal Masuk ADM</label>
                    <input type="text" name="masuk_adm" id="datepicker3" value="<?= $employee->tgl_masuk_adm ?>" class="form-control text-dark" placeholder="">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" id="submit" data-bs-dismiss="modal" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- END MODAL STATUS -->

      <script type="text/javascript">
        //kirim data biodata untuk di update lewat ajax
        $(document).ready(function() {



          $("#formEmployee").on('submit', function(event) {
            event.preventDefault();
            var no_kta = document.getElementById('no_kta').value;
            var expired_kta = document.getElementById('datepicker1').value;
            var masukSigap = document.getElementById('datepicker2').value;
            var masukAdm = document.getElementById('datepicker3').value;
            var jabatan = document.getElementById('jabatan').value;
            var areaKerja = document.getElementById('area_kerja').value;
            $.ajax({
              url: "<?= base_url('Profile/EmployeeUpdate') ?>",
              data: new FormData(this),
              method: "POST",
              contentType: false,
              processData: false,
              cache: false,
              success: function(response) {
                Swal.fire({
                  icon: "success",
                  title: response
                }).then(function() {
                  window.location.href = "<?= base_url("Profile") ?>"
                })
              }
            });
          })
        })
      </script>

    </div>
  </div>

  <!-- show absensi  jquery absensi-->

  <script>
    $(document).ready(function() {
      $('select[name=bulan]').on('change', function() {
        var bulan = $(this).children("option:selected").val();
        $.ajax({
          url: "<?= base_url('Profile/showAbsensi') ?>",
          method: "POST",
          data: "bulan=" + bulan,
          success: function(e) {
            // console.log(e);
            document.getElementById('report_absen').innerHTML = e;
          }
        })

      });
    })


    // api wilayah
    function clearOptions(id) {
      console.log("on clearOptions :" + id);
      $('#' + id).val(null);
      $('#' + id).empty().trigger('change');
    }
    $(function() {
      $('select[name=provinsi_ktp').on('change', function() {
        var id = $("select[name=provinsi_ktp] option:selected").val();
        $.ajax({
          url: "<?= base_url('Wilayah/kota') ?>",
          method: "POST",
          data: 'provinsi_id=' + id,
          success: function(e) {
            //console.log(id);
            var select1 = $('#kabupaten');
            var result = JSON.parse(e);
            for (var i = 0; i < result.length; i++) {
              var added = document.createElement('option');
              added.value = result[i].kode;
              added.innerHTML = result[i].nama;
              select1.append(added);
            }
          }
        })
      })

      $('select[name=kabupaten_ktp').on('change', function() {
        var id = $("select[name=kabupaten_ktp] option:selected").val();
        $.ajax({
          url: "<?= base_url('Wilayah/kecamatan') ?>",
          method: "POST",
          data: 'kota_id=' + id,
          success: function(e) {
            var select1 = $('#kecamatan');
            var result = JSON.parse(e);
            clearOptions('kecamatan');
            for (var i = 0; i < result.length; i++) {
              var added = document.createElement('option');
              added.value = result[i].kode;
              added.innerHTML = result[i].nama;
              select1.append(added);
            }
          }
        })
      })


      $('select[name=kecamatan_ktp').on('change', function() {
        var id = $("select[name=kecamatan_ktp] option:selected").val();
        $.ajax({
          url: "<?= base_url('Wilayah/desa') ?>",
          method: "POST",
          data: 'kecamatan_id=' + id,
          success: function(e) {
            var select1 = $('#kelurahan');
            var result = JSON.parse(e);
            clearOptions('kelurahan');
            for (var i = 0; i < result.length; i++) {
              var added = document.createElement('option');
              added.value = result[i].kode;
              added.innerHTML = result[i].nama;
              select1.append(added);
            }
          }
        })
      })
    })
    // end of api wilayah ktp


    // api domisili
    $('select[name=provinsi_dom').on('change', function() {
      var id = $("select[name=provinsi_dom] option:selected").val();
      $.ajax({
        url: "<?= base_url('Wilayah/kota') ?>",
        method: "POST",
        data: 'provinsi_id=' + id,
        success: function(e) {
          //console.log(id);
          var select1 = $('#kabupaten_dom');
          var result = JSON.parse(e);
          for (var i = 0; i < result.length; i++) {
            var added = document.createElement('option');
            added.value = result[i].kode;
            added.innerHTML = result[i].nama;
            select1.append(added);
          }
        }
      })
    })

    $('select[name=kota_dom').on('change', function() {
      var id = $("select[name=kota_dom] option:selected").val();
      $.ajax({
        url: "<?= base_url('Wilayah/kecamatan') ?>",
        method: "POST",
        data: 'kota_id=' + id,
        success: function(e) {
          var select1 = $('#kecamatan_dom');
          var result = JSON.parse(e);
          clearOptions('kecamatan_dom');
          for (var i = 0; i < result.length; i++) {
            var added = document.createElement('option');
            added.value = result[i].kode;
            added.innerHTML = result[i].nama;
            select1.append(added);
          }
        }
      })
    })

    $('select[name=kec_dom').on('change', function() {
      var id = $("select[name=kec_dom] option:selected").val();
      $.ajax({
        url: "<?= base_url('Wilayah/desa') ?>",
        method: "POST",
        data: 'kecamatan_id=' + id,
        success: function(e) {
          var select1 = $('#kelurahan_dom');
          var result = JSON.parse(e);
          clearOptions('kelurahan_dom');
          for (var i = 0; i < result.length; i++) {
            var added = document.createElement('option');
            added.value = result[i].kode;
            added.innerHTML = result[i].nama;
            select1.append(added);
          }
        }
      })
    })

    // end of api domisili 
  </script>