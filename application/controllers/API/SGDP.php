<?php


require APPPATH . 'libraries\RestController.php';

use chriskacerguis\RestServer\RestController;

class SGDP extends RestController
{

    public function index_get()
    {
        # code...

        $data = $this->API->getData("biodata");
        $id = $this->get('id');

        if ($id != null) {
            $this->db->where('id_biodata', $id);
            $data;
            $this->response(['hasil' => $data->row()]);
        } else {
            if ($data->num_rows() > 0) {
                $this->response([
                    'info' => 'succesfully request',
                    'result' => $data->result()
                ], 200);
            } else {
                $this->response(['info' => 'not data found'], 404);
            }
        }
    }
}
