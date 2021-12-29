<?php


class Report_Patroli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        }
        if ($role_id != 5) {
            redirect('LogOut');
        }
    }


    public function index()
    {
        $anggota = array('role_id' => 1);
        $danru = array('role_id' => 2);
        $korlap = array('role_id' => 3);
        $sipd = array('role_id' => 4);

        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'anggota'   => $this->Sipd_model->infoDashboard("akun", $anggota)->num_rows(),
            'danru'   => $this->Sipd_model->infoDashboard("akun", $danru)->num_rows(),
            'korlap'   => $this->Sipd_model->infoDashboard("akun", $korlap)->num_rows(),
            'total'   => $this->Sipd_model->countAll()->num_rows(),
        );
        $this->load->view('web/header', $data);
        $this->load->view('PIC/report_Patroli', $data);
        $this->load->view('web/fotter');
        # code...
    }


    public function reportHarian(Type $var = null)
    {
        # code...

        $day = $this->input->post("day");
        $area = $this->input->post("area_kerja1");

        $result = $this->db->get_where('report_patrol', ['tanggal' => $day, 'area_kerja' => $area]);

        $data = [
            'patrol'  =>  $result
        ];
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }


    public function reportPeriodik(Type $var = null)
    {
        # code...

        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area");

        $this->db->where('tanggal >=', $day);
        $this->db->where('tanggal <=', $day2);
        $result = $this->db->get('report_patrol');

        $data = [
            'patrol'  =>  $result
        ];
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }
}
