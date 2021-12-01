<?php
/**
 * 
 */
class LogOut extends CI_Controller
{
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->session->sess_destroy();
		redirect("Login");
	}
}