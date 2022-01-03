<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries\RestController.php';

use chriskacerguis\RestServer\RestController;
// use chriskacerguis\RestServer\Format;

class ISECURITY extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->load->model('Api_model');
    }

    //ambil biodata anggota
    public function biodata_get()
    {
        $id = $this->get('id');
        $url = $this->uri->segment(3);

        $where = ['id_biodata' => $id];
        $data = $this->Api_Model->getData("biodata", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'result'  => $data->result(),
                'status'  => 'ok'
            ], 200);
        } else {

            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }

    //update biodata
    public function biodata_put()
    {
        # code...
        $id  = $this->put('id');
        $data = [
            'ktp'                     => $this->put("no_ktp"),
            // 'kk'                      => $this->put("no_kk"),
            // 'no_hp'                   => $this->put("no_hp"),
            // 'no_emergency'            => $this->put("no_emergency"),
            // 'email'                   => $this->put("email"),
            // 'jl_ktp'                  => strtoupper($this->put("jl_ktp")),
            // 'rt_ktp'                  => $this->put("rt_ktp"),
            // 'rw_ktp'                  => $this->put("rw_ktp"),
            // 'kel_ktp'                 => strtoupper($this->put("kelurahan_ktp")),
            // 'kec_ktp'                 => strtoupper($this->put("kecamatan_ktp")),
            // 'kota_ktp'                => strtoupper($this->put("kabupaten_ktp")),
            // 'provinsi_ktp'            => strtoupper($this->put("provinsi_ktp")),
            // 'jl_dom'                  => strtoupper($this->put("jl_dom")),
            // 'rt_dom'                  => $this->put("rt_dom"),
            // 'rw_dom'                  => $this->put("rw_dom"),
            // 'kel_dom'                 => strtoupper($this->put("kel_dom")),
            // 'kec_dom'                 => strtoupper($this->put("kec_dom")),
            // 'kota_dom'                => strtoupper($this->put("kota_dom")),
            // 'provinsi_dom'            => strtoupper($this->put("provinsi_dom")),
            // 'berat_badan'             => $this->put("berat_badan"),
            // 'tinggi_badan'            => $this->put("tinggi_badan"),
            // 'imt'                     => $this->put("imt"),
            // 'keterangan'              => strtoupper($this->put("keterangan")),
        ];

        $where = ['id_biodata'  => $id];
        $update = $this->Api_Model->update("biodata", $data, $where);

        if ($update) {
            $this->response([
                'result'  => $data,
                'pesan'   => 'update sukses',
                'status'  => 'ok'
            ], 200);
        } else {
            $this->response([
                'pesan'   => 'update failed',
                'status'  => 'nok'
            ], 401);
        }
    }

    //ambil data employee 
    public function employe_get()
    {
        $id = $this->get('id');

        $where = ['id_employee' => $id];
        $data = $this->Api_Model->getData("employee", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'result'  => $data->result(),
                'status'  => 'ok'
            ], 200);
        } else {

            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }

    //update data lewat API 
    public function employe_put(Type $var = null)
    {
        $data = [
            'no_kta'                          => $this->put("no_kta"),
            // 'expired_kta'                  => $this->put("ex_kta"),
            // 'jabatan'                      => strtoupper($this->put("jabatan")),
            // 'area_kerja'                   => strtoupper($this->put("area_kerja")),
            // 'tgl_masuk_sigap'              => $this->put("masuk_sigap"),
            // 'tgl_masuk_adm'                => $this->put("masuk_adm"),
        ];
        $id = $this->put('id');
        $where = ['id_employee'  => $id];
        $update = $this->Api_Model->update("employee", $data, $where);

        if ($update) {
            $this->response([
                'result'  => $data,
                'pesan'   => 'update sukses',
                'status'  => 'ok'
            ], 200);
        } else {
            $this->response([
                'pesan'   => 'update failed',
                'status'  => 'nok'
            ], 401);
        }
    }

    //ambil data berkas
    public function berkas_get()
    {
        $id = $this->get('id');
        $where = ['id_berkas' => $id];
        $data = $this->Api_Model->getData("berkas", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'result'  => $data->result(),
                'status'  => 'ok'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }

    //
}
