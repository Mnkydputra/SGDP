<?php



class Tikor extends CI_Controller
{

  function index()
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
      'tikor'   => $this->Sipd_model->getData("titik_area")->result()
    );
    $this->load->view('web/header', $data);
    $this->load->view('PIC/titik_koordinat_patroli', $data);
    $this->load->view('web/fotter');
  }

  public function tambah_titik()
  {
    # code...
    $lat    = $this->input->post('latitude');
    $long   = $this->input->post('longitude');
    $lokasi = $this->input->post("lokasi");
    $idplan = $this->input->post("id_plan");

    $data_plan = [
      'id_plan'  =>  $idplan,
      'lokasi'   => $lokasi,
      'latitude' => $lat,
      'longitude' => $long
    ];

    $save = $this->Sipd_model->added("titik_area", $data_plan);
    if ($save > 0) {
      echo "sukses";
    } else {
      echo "fail";
    }
  }

  public function update_titik()
  {
    # code...
    $lat    = $this->input->post('latitude');
    $long   = $this->input->post('longitude');
    $lokasi = $this->input->post("lokasi");
    $idplan = $this->input->post("id_plan");

    $data_plan = [
      'id_plan'  =>  $idplan,
      'lokasi'   => $lokasi,
      'latitude' => $lat,
      'longitude' => $long
    ];

    $where = ['id'  => $this->input->post('id')];

    var_dump($data_plan);
    var_dump($where);

    // $save = $this->Sipd_model->added("titik_area", $data_plan);
    // if ($save > 0) {
    //   echo "sukses";
    // } else {
    //   echo "fail";
    // }
  }


  public function delete()
  {
    # code...
    $id = $this->input->get('id');
    $del = $this->Sipd_model->deleted(['id' => $id], 'titik_area');
    echo $del;
  }
}
