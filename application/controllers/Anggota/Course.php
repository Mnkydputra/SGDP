<?php

class Course extends CI_Controller{
    
    function index()
    {
        $data =  array(
			'url' 				=> $this->uri->segment(2),
		);
        $this->load->view('mobile/header');
        $this->load->view('Anggota/course');
        $this->load->view('mobile/fotter',$data);
    }
}

?>