<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries\RestController.php';

use chriskacerguis\RestServer\RestController;
// use chriskacerguis\RestServer\Format;

class Karyawan extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->load->model('Api_model');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $url = $this->uri->segment(3);

        $this->response(['pesan' => 'hallo'], 200);

        // $mhs = $this->Api_model->get("mahasiswa", $id);

        // if ($mhs->num_rows() > 0) {
        //     $this->response($mhs->result(), 200);
        // } else {

        //     $this->response([
        //         'status' => false,
        //         'message' => 'No such user found'
        //     ], 404);
        // }
    }


    public function tambah_post()
    {
        # code...
        // $name  = $this->post("nama");
        // $email = $this->post("email");
        // $nim = $this->post('nim');
        // $data = [
        //     'nama'   => $name,
        //     'email'  => $email,
        //     'nim'    =>  $nim
        // ];

        // $pesan = [
        //     'result' => $data,
        //     'pesan' => 'data has been created'
        // ];

        // if (is_null($name)) {
        //     $this->response([
        //         'message' => 'value tidak boleh kosong',
        //         'result'  => $data
        //     ], 402);
        // } else {
        //     $q = $this->Api_model->add($data, "mahasiswa");
        //     if ($q > 0) {
        //         $this->response($pesan, 200);
        //     } else {
        //         $this->response(['status' => 'fail'], 502);
        //     }
        // }
    }


    public function edit_put()
    {
        # code...
        // $id = $this->put('id');
        // $data = [
        //     'nama'   => $this->put("nama"),
        //     'email'  => $this->put("email"),
        //     'nim'    => $this->put('nim')
        // ];

        // $pesan = [
        //     'result' => $data,
        //     'pesan'  => 'data has been updated'
        // ];
        // $update = $this->Api_model->edit($data, "mahasiswa", ['id' => $id]);
        // if ($update > 0) {
        //     $this->response($pesan, 200);
        // } else {
        //     $this->response(['status' => 'failed'], 502);
        // }
    }


    public function hapus_delete()
    {
        //cek id 
        // $id = $this->delete('id');

        // $cekID = $this->db->get_where('mahasiswa', ['id' => $id])->num_rows();
        // if ($cekID > 0) {
        //     $this->Api_model->delete("mahasiswa", $id);
        //     $this->response(['message' => 'data terhapus']);
        // } else {
        //     $this->response(['message' => 'id ' . $id . ' not found'], 501);
        // }
    }
}
