<?php
require 'vendor/autoload.php';
Class Update_stts_kerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id_akun');
        $role = $this->session->userdata('role_id');
         if ($id == null || $id == "") {
         $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        } 
        // if ($role_id != 5){
        //     redirect('LogOut');
        // }

    }

    private $filename = "Format_Status_Kerja";

 	public function index()
 	{
        $anggota = array('role_id' => 1);
        $danru = array('role_id' => 2);
        $korlap = array('role_id' => 3);
        $sipd = array('role_id' => 4);
 		$data = array(
        'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        'anggota'   => $this->Sipd_model->infoDashboard("akun", $anggota)->num_rows(),
        'danru'   => $this->Sipd_model->infoDashboard("akun", $danru)->num_rows(),
        'korlap'   => $this->Sipd_model->infoDashboard("akun", $korlap)->num_rows(),
        'total'   => $this->Sipd_model->countAll()->num_rows(),
         );
		if(isset($_POST['submit'])){
			$upload = $this->Sipd_model->uploadfile4($this->filename);
			if($upload['result'] =="success") {
            
        
                    // $excelreader = new PHPExcel_Reader_Excel2007();
                    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $loadexcel = $spreadsheet->load('assets/upload/status_karyawan/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel               
                    $sheet = $loadexcel->getActiveSheet()->toArray(null,true,true,true);

                    // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                    // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                     $data['sheet'] = $sheet ;
                    // echo '<pre>';
                    // print_r($sheet);
				 }else{
                     $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                     echo $upload['error'];
                 }

		}
 		$this->load->view('web/header',$data);
		$this->load->view('sipd/upload_stts_kerja',$data);
		$this->load->view('web/fotter');
 	}
    
     public function posting()
 	{

 		date_default_timezone_set('Asia/Jakarta');
        // Load plugin PHPExcel nya
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

            $spreadsheet = $reader->load('assets/upload/status_karyawan/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel               
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
		    $sheetcount = count($sheetdata);
            $data = array();
                if($sheetcount > 1){
                    for ($i = 1; $i < $sheetcount; $i++){
                            $IdAnggota      = $sheetdata[$i][0];
                            $Npk            = $sheetdata[$i][1];
                            $AreaKerja      = $sheetdata[$i][2];

                             $data[]= array(
                            'id_employee'			    => $IdAnggota,
                            'npk'					    => $Npk,
                            'area_kerja'                => $AreaKerja,
                        );
                    }
                }
                    $input =  $this->db->update_batch('employee',$data,'npk');
                    // if($input){               
                       
                    //     echo 'Sukses';
                    // }else{
                    //     echo "Gagal";
                    // }

 	}
}