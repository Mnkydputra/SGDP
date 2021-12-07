<?php 
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Upload_anggota extends CI_Controller{

    function __construct()
    {
    parent::__construct();  

    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
      if ($id == null || $id == "") {
         $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        } 
        if ($role_id != 4){
            redirect('LogOut');
        }
    }

    function index()
    {
        $this->load->view('web/header');
        $this->load->view('sipd/dashboard');
        $this->load->view('web/fotter');
    }
    
    function anggota()
    {
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
}

?>