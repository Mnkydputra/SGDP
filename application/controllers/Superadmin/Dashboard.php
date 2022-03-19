<?php


class Dashboard extends CI_Controller
{
    public function index()
    {
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        $data = [
            'tanggal'   => $tgl_kemarin,
            'HO'        => $this->Super_model->countPatroli("HO", $tgl_kemarin),
            'VLC'       => $this->Super_model->countPatroli("VLC", $tgl_kemarin),
            'DOR'       => $this->Super_model->countPatroli("DOR", $tgl_kemarin),
            'PC'        => $this->Super_model->countPatroli("PC", $tgl_kemarin),
            'P1'        => $this->Super_model->countPatroli("P1", $tgl_kemarin),
            'P2'        => $this->Super_model->countPatroli("P2", $tgl_kemarin),
            'P3'        => $this->Super_model->countPatroli("P3", $tgl_kemarin),
            'P4A'       => $this->Super_model->countPatroli("P4-ASSY1", $tgl_kemarin),
            'P4B'       => $this->Super_model->countPatroli("P4-ASSY2", $tgl_kemarin),
            'P5'        => $this->Super_model->countPatroli("P5", $tgl_kemarin),
        ];
        $this->load->view('superadmin/dashboard', $data);
    }
}
