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
        if ($role_id != 6) {
            redirect('LogOut');
        }
    }


    public function index()
    {
        $anggota = array('role_id' => 1);
        $danru = array('role_id' => 2);
        $korlap = array('role_id' => 3);
        $sipd = array('role_id' => 4);
<<<<<<< HEAD
=======

        $wil = "WIL3";

        switch ($wil) {
            case "WIL1":
                $iw  = "WILAYAH 1";
                $titik_tengah = "-6.1306783, 106.882644";
                break;
            case "WIL2":
                $iw  = "WILAYAH 2";
                $titik_tengah = "-6.1393022, 106.885883";
                break;
            case "WIL3":
                $titik_tengah = "-6.338437, 107.173250";
                $iw  = "WILAYAH 3";
                break;
            case "WIL4":
                $titik_tengah = "-6.416361, 107.336929";
                $iw  = "WILAYAH 4";
                break;
        }

        $d = $this->Sipd_model->patrolReporting($wil);
        $data = array(
            'biodata'       => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'           => $this->uri->segment(2),
            'berkas'        => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'total'         => $this->Sipd_model->countAll()->num_rows(),
            // 'titik'      => $this->db->get_where('titik_area', ['id_plan' => "VLC"]),
            'titik'         => $d,
            'maps'          => $d,
            'center'        => $titik_tengah,
            'iw'            => $iw
        );
        $this->load->view('web/header', $data);
        // $this->load->view('PIC/report_patroli', $data);
        $this->load->view('PIC/i_patrol', $data);
        $this->load->view('web/fotter');
    }
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426

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
        # code...
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
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
        $result = $this->db->get_where('report_patrol', ['tanggal' => $day, 'area_kerja' => $area]);

        $data = [
            'patrol'  =>  $result,
<<<<<<< HEAD
            'area'    => $area ,
=======
            'area'    => $area,
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
            'tgl1'    => $day,
            'tgl2'     => ""
        ];
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
<<<<<<< HEAD
        $mpdf->Output("Report Patroli " . $area . ".pdf" , 'I');
=======
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'I');
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
    }


    public function reportPeriodik(Type $var = null)
    {
        # code...

        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area2");
<<<<<<< HEAD
        $this->db->where('area_kerja',$area);
=======
        $this->db->where('area_kerja', $area);
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
        $this->db->where('tanggal >=', $day);
        $this->db->where('tanggal <=', $day2);
        $result = $this->db->get('report_patrol');

        $data = [
            'patrol'  =>  $result,
<<<<<<< HEAD
            'area'    => $area ,
=======
            'area'    => $area,
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        // $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $data = $this->load->view('PIC/report_patroli_v2', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'I');
    }
}
