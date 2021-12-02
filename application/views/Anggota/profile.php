<div id="content" class="container-md">
    <div class="row">
       
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="btn btn-dark bg-danger text-dark ps-2 ms-2 my-2 nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"> <h6>Profil Diri</h6></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="btn btn-dark bg-info text-dark ps-3 ms-2 my-2 nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><h6> Status</h6></button>
            </li>
            
            </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
     <div class="row">
         <div class="col-md-3">
             <table class="table table-striped">
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
          <td>JL: <?= $biodata->jl_ktp ?>, RT:<?= $biodata->rt_ktp ?>/RW:<?= $biodata->rw_ktp ?>. Kel: <?= $biodata->kel_ktp ?> , Kec: <?= $biodata->kec_ktp ?>. Kota/Kabupaten: <?= $biodata->kota_ktp ?> </td>
        </tr>
        <tr>
          <td>Alamat Domisili</td>
          <td>:</td>
          <td>JL: <?= $biodata->jl_dom ?>, RT:<?= $biodata->rt_dom ?>/RW:<?= $biodata->rw_dom ?>. Kel: <?= $biodata->kel_dom ?> , Kec: <?= $biodata->kec_dom ?>. Kota/Kabupaten: <?= $biodata->kota_dom ?> </td>
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
          <!-- Button trigger modal -->
             <!-- Modal -->
                <div class="modal fade" id="ModalBiodata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalBiodata"><u>UPDATE BIODATA</u></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form method="post" id="form">
                              <div class="row">
                                <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2" >
                                   <h5>Biodata</h5>
                                  <label for="no_ktp">No KTP</label>
                                  <input type="hidden" name="id_karyawan" value="">
                                  <input type="hidden" name="npk" value="">
                                  <input type="text" name="no_ktp" id="no_ktp" value="" class="form-control" placeholder="">

                                    <label for="no_kk">No KK</label>
                                    <input type="text" name="no_kk" id="no_kk" value="" class="form-control"  placeholder="">

                                    <label for="no_hp">No Handphone</label>
                                    <input type="tel" name="no_hp" id="no_hp" value="" class="form-control"  placeholder="">

                                    <label for="no_emergency">No Emergency</label>
                                    <input type="tel" name="no_emergency" id="no_emergency" value="" class="form-control"  placeholder="">

                                    <label for="email">Alamat Email</label>
                                    <input type="email" name="email" id="email" value="" class="form-control"  placeholder="">
                                    
                                   
                                  </div>    
                                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                                    <h5>Alamat KTP</h5>
                                    <label for="jl_ktp">Nama Jalan & Nomor Rumah</label>
                                    <input type="text" name="jl_ktp" id="jl_ktp" value="" class="form-control"  placeholder="">

                                    <label for="rt_ktp">RT</label>
                                    <input type="text" name="rt_ktp" id="rt_ktp" value="" class="form-control"  placeholder="">

                                    <label for="rw_ktp">RW</label>
                                    <input type="text" name="rw_ktp" id="rw_ktp" value="" class="form-control"  placeholder="">

                                    <label for="kel_ktp">Kelurahan</label>
                                    <input type="text" name="kel_ktp" id="kel_ktp" value="" class="form-control"  placeholder="">

                                    <label for="kec_ktp">Kecamatan</label>
                                    <input type="text" name="kec_ktp" id="kec_ktp" value="" class="form-control"  placeholder="">

                                    <label for="kota_ktp">Kota / Kabupaten</label>
                                    <input type="text" name="kota_ktp" id="kota_ktp" value="" class="form-control"  placeholder="">
                                  </div>

                                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                                    <h5>Alamat Domisili</h5>
                                    <label for="jl_dom">Nama Jalan & Nomor Rumah</label>
                                    <input type="text" name="jl_dom" id="jl_dom" value="" class="form-control"  placeholder="">

                                    <label for="rt_dom">RT</label>
                                    <input type="text" name="rt_dom" id="rt_dom" value="" class="form-control"  placeholder="">

                                    <label for="rw_dom">RW</label>
                                    <input type="text" name="rw_dom" id="rw_dom" value="" class="form-control"  placeholder="">

                                    <label for="kel_dom">Kelurahan</label>
                                    <input type="text" name="kel_dom" id="kel_dom" value="" class="form-control"  placeholder="">

                                    <label for="kec_dom">Kecamatan</label>
                                    <input type="text" name="kec_dom" id="kec_dom" value="" class="form-control"  placeholder="">

                                    <label for="kota_dom">Kota / Kabupaten</label>
                                    <input type="text" name="kota_dom" id="kota_dom" value="" class="form-control"  placeholder="">
                                  </div>

                                  <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                                    <h5>Postur Tubuh</h5>
                                    <label for="berat_badan">Berat Badan</label>
                                    <input type="text" name="berat_badan" id="berat_badan" value="" class="form-control"  placeholder="">

                                    <label for="tinggi_badan">Tinggi Badan</label>
                                    <input type="text" name="tinggi_badan" id="tinggi_badan" value="" class="form-control"  placeholder="">

                                    <label for="imt">IMT</label>
                                    <input type="text" readonly="" name="imt" id="imt" value="" class="form-control"  placeholder="">
                                  </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                   </form>
                </div>
              </div>
            </div>
    <!-- END MODAL BIODATA -->

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="row">
                  <div class="col-md-3">
                  <table class="table table-striped">
                      <td>No KTA</td>
                    <td>:</td>
                    <td><?= $employee->no_kta ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Expired KTA</td>
                    <td>:</td>
                    <td><?= $employee->expired_kta?></td>
                  </tr>

                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $employee->jabatan?></td>
                  </tr>

                  <tr>
                    <td>Status Anggota</td>
                    <td>:</td>
                    <td><?= $employee->status_anggota?></td>
                  </tr>

                  <tr>
                    <td>Status KTA</td>
                    <td>:</td>
                    <td><?= $employee->status_kta?></td>
                  </tr>

                  <tr>
                    <td>Area Kerja</td>
                    <td>:</td>
                    <td><?= $employee->area_kerja?></td>
                  </tr>

                  <tr>
                    <td>Wilayah</td>
                    <td>:</td>
                    <td><?= $employee->wilayah?></td>
                  </tr>

                  <tr>
                    <td>Tanggal Masuk Sigap</td>
                    <td>:</td>
                    <td><?= $employee->tgl_masuk_sigap?></td>
                  </tr>

                  <tr>
                    <td>Tanggal Masuk ADM</td>
                    <td>:</td>
                    <td><?= $employee->tgl_masuk_adm?></td>
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
      <!-- MODAL STATUS -->
             <div class="modal fade" id="ModalStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalStatus"><u>UPDATE STATUS</u></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form method="post" id="form">
                              <div class="row">
                                <div class="col-md-3 border border-3 rounded-3 border border-dark py-3 mb-2">
                                  <label for="no_kta">No KTA</label>
                                  <input type="hidden" name="id_karyawan" value="">
                                  <input type="hidden" name="npk" value="">
                                  <input type="text" name="no_kta" id="no_kta" value="" class="form-control" placeholder="">

                                    <label for="ex_kta">Expired KTA</label>
                                    <input type="text" name="ex_kta" id="ex_kta" value="" class="form-control"  placeholder="">

                                    <label for="status_kta">Status KTA</label>
                                    <input class="form-control" list="datalistOptions" id="status_kta" placeholder="Aktif / Tidak Aktif">
                                    <datalist  class="custom-select" name="status_kta" id="datalistOptions" >
                                    <option value="Aktif"></option>
                                    <option value="Tidak Aktif"></option>
                                    </datalist>
                                   
                                </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                   </form>
                  </div>
                </div>
              </div>
        
    <!-- END MODAL STATUS -->

 
      </div> 
    </div>
</div>