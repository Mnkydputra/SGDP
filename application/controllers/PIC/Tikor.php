<?php



class Tikor extends CI_Controller
{

  function index()
  {

    $query = $this->db->query("select max(id) as hasil from titik_area  ");
    $p = $query->row();

    $ticket = $p->hasil;
    // echo $query->num_rows();
    if ($query->num_rows() > 0) {
      $nkode =  substr($ticket, 4);
      $kode = (int) $nkode;
      $kode = $kode + 1;
      $result = "ADM" . str_pad($kode, 4, "0", STR_PAD_LEFT);
      $d = $result;
      // echo  $data['id_titik'];
    } else {
      $d = "ADM0001";
    }


    $anggota = array('role_id' => 1);
    $danru = array('role_id' => 2);
    $korlap = array('role_id' => 3);
    $sipd = array('role_id' => 4);

    $data = array(
      'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
      'url'  => $this->uri->segment(2),
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
      'total'   => $this->Sipd_model->countAll()->num_rows(),

      //ambil berdasarkan area kerja  
      'tikor'   => $this->Sipd_model->getData("titik_area")->result(),
      'id_titik'  => $d
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
    $id     = $this->input->post("id2");

    $data_plan = [
      'id'        => $id,
      'id_akun'   => $this->session->userdata('id_akun'),
      'id_plan'   =>  $idplan,
      'lokasi'    => $lokasi,
      'latitude'  => $lat,
      'longitude' => $long,
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
    $lat    = $this->input->post('latitude2');
    $long   = $this->input->post('longitude2');
    $lokasi = $this->input->post("lokasi2");
    $idplan = $this->input->post("id_plan2");

    $data_plan = [
      'id_plan'  =>  $idplan,
      'lokasi'   => $lokasi,
      'latitude' => $lat,
      'longitude' => $long
    ];
    $where = ['id'  => $this->input->post('id')];
    $update = $this->Sipd_model->update("titik_area", $data_plan, $where);
    if ($update > 0) {
      echo "sukses";
    } else {
      echo "fail";
    }
  }


  public function delete()
  {
    # code...
    $id = $this->input->get('id');
    $del = $this->Sipd_model->deleted(['id' => $id], 'titik_area');
    echo $del;
  }


  function qr($kodeqr)
  {
    // if ($kodeqr) {
    //   $filename = 'qr/' . $kodeqr;
    //   if (!file_exists($filename)) {

    //   }
    // }
  }
}
