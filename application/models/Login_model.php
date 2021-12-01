<?php

class Login_model extends CI_Model{
  

  public function cek_login($username, $password)
  {
  		$this->db->select("*");
  		$this->db->from("akun");
  		$this->db->where(array ("akun.id_karyawan" => $username  ,'akun.password' => $password) );
  		$this->db->join("biodata" ," akun.id_karyawan  = biodata.id_karyawan " , "left");
  		return $this->db->get();

  }

  public function LupaPwd($username,$password, $no_hp, $kode_otp)
  {
  	$this->db->select("*");
  	$this->db->from("akun");
  	$this->db->where(array("akun.npk" => $username , 'akun.pass' => $password , 'akun.no_hp' => $no_hp , 'akun.kode_otp' => $kode_otp));
  	$this->db->join("karyawan" , "akun.id_karyawan = karyawan.id_karyawan" , "left");
  	return $this->db->get();
  }

}
