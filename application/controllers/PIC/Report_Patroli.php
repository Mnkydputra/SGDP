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


    public function index(Type $var = null)
    {
        $anggota = array('role_id' => 1);
        $danru = array('role_id' => 2);
        $korlap = array('role_id' => 3);
        $sipd = array('role_id' => 4);
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'total'   => $this->Sipd_model->countAll()->num_rows(),
            'titik'  => $this->db->get_where('titik_area', ['id_plan' => "VLC"]),
        );
        $this->load->view('web/header', $data);
        // $this->load->view('PIC/report_patroli', $data);
        $this->load->view('PIC/i_patrol', $data);
        $this->load->view('web/fotter');
    }

    public function download()
    {
        $anggota  = array('role_id' => 1);
        $danru    = array('role_id' => 2);
        $korlap   = array('role_id' => 3);
        $sipd     = array('role_id' => 4);
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
        $this->load->view('PIC/report_patroli', $data);
        $this->load->view('web/fotter');
    }

    public function reportHarian(Type $var = null)
    {
        # code...

        $day = $this->input->post("day");
        $area = $this->input->post("area_kerja1");
<<<<<<< HEAD
        $this->db->where('area_kerja',$area);
=======
        $this->db->where('area_kerja', $area);
>>>>>>> fda584628a4dda7fca0d47966193e261410e3aa6
        $result = $this->db->get_where('report_patrol', ['tanggal' => $day, 'area_kerja' => $area]);

        $data = [
            'patrol'  =>  $result,
<<<<<<< HEAD
            'area'    => $area ,
=======
            'area'    => $area,
>>>>>>> fda584628a4dda7fca0d47966193e261410e3aa6
            'tgl1'    => $day,
            'tgl2'     => ""
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $data = $this->load->view('PIC/report_patroli_v2', $data,  TRUE);
        $mpdf->WriteHTML($data);
<<<<<<< HEAD
        $mpdf->Output("Report Patroli " . $area . ".pdf" , 'I');
=======
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'I');
>>>>>>> fda584628a4dda7fca0d47966193e261410e3aa6
    }


    public function reportPeriodik(Type $var = null)
    {
        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area2");
<<<<<<< HEAD
        $this->db->where('area_kerja',$area);
=======
        $this->db->where('area_kerja', $area);
>>>>>>> fda584628a4dda7fca0d47966193e261410e3aa6
        $this->db->where('tanggal >=', $day);
        $this->db->where('tanggal <=', $day2);
        $result = $this->db->get('report_patrol');

        $data = [
            'patrol'  =>  $result,
<<<<<<< HEAD
            'area'    => $area ,
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        // $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
=======
            'area'    => $area,
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];
        $mpdf = new \Mpdf\Mpdf();
>>>>>>> fda584628a4dda7fca0d47966193e261410e3aa6
        $data = $this->load->view('PIC/report_patroli_v2', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'I');
    }
}
