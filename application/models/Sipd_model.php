<?php


/**
 *
 */
class Sipd_model extends CI_Model
{



	public function getData($table)
	{
		return $this->db->get($table);
	}

	//report biodata with DataTables
	public function All()
	{
		$this->db->from('karyawan');
		$this->db->join('employe_karyawan', 'employe_karyawan.id_karyawan = karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = karyawan.id_karyawan');
		$this->db->join('skill', 'skill.id_karyawan = karyawan.id_karyawan');
		$this->db->join('pengalaman', 'pengalaman.id_karyawan = karayawan.id_karyawan');
		$this->db->join('pasangan', 'pasangan.id.karyawan = karyawan.id_karyawan');
		$this->db->join('anak', 'anak.id_karyawan = karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	// Count Anggota beserta sipd 
	public function countAll()
	{
		$query = $this->db->query("SELECT * FROM `akun` WHERE role_id = 1 AND role_id = 2 AND role_id = 3 AND role_id = 4");
		return $query;
	}

	public function table()
	{
		$query = $this->db->query("SELECT karyawan.id_karyawan, karyawan.npk ,employe_karyawan.instalasi, karyawan.nama FROM karyawan INNER JOIN employe_karyawan ON karyawan.id_karyawan = employe_karyawan.id_karyawan");
		return $query->result();
	}

	//input data dari excel dengan metode array()
	public function inputArray($data, $table)
	{
		return $this->db->insert_batch($data, $table);
	}


	//join data karyawan
	public function joinAnggota()
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->order_by('nama');
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}


	//join table taliasih dan pkwt untuk taliasih anggota
	//join data karyawan
	public function joinTaliasih()
	{
		$this->db->select('*');
		$this->db->from('taliasih');
		$this->db->join('pkwt', 'pkwt.id_karyawan = taliasih.id_karyawan');
		$query = $this->db->get();
		return $query;
	}


	//join tabel akun dengan karyawan
	public function joinAkunuser()
	{
		$this->db->select("*");
		$this->db->from("akun");
		$this->db->where(array('role_id' => 3));
		return $this->db->get();
	}


	//ganti password
	public function updatePassword($where, $data)
	{
		$this->db->where($where);
		return $this->db->update('akun', $data);
	}

	//ambil history data pkwt karyawan
	public function getPKWT($npk)
	{
		return $this->db->get_where('pkwt', array('npk_br' => $npk));
	}


	//ambil  pkwt untuk di print
	public function getprintPKWT($npk)
	{
		$this->db->where('npk_lm', $npk);
		$this->db->or_where('npk_br', $npk);
		return $this->db->get('pkwt');
	}

	public function printcv($npk)
	{
		$data = $this->db->get('karyawan');
		return $data->result();
	}

	//upload file pkwt
	public function uploadfile($filename)
	{
		$this->load->library('upload');
		$config['upload_path']		= './assets/upload/pkwt';
		$config['allowed_types']	= 'xlsx';
		$config['max_size']			= '12048';
		$config['overwrite']		= true;
		$config['file_name']		= $filename;

		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			//jik berhasil
			$return = array('result' => 'success', 'file'	=> $this->upload->data(), 'error' => '');
			return $return;
		} else {
			$return = array('result' => 'gagal', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	//upload file taliasih
	public function uploadfile2($filename)
	{
		$this->load->library('upload');
		$config['upload_path']		= './assets/upload/taliasih';
		$config['allowed_types']	= 'xlsx';
		$config['max_size']			= '12048';
		$config['overwrite']		= true;
		$config['file_name']		= $filename;

		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			//jik berhasil
			$return = array('result' => 'success', 'file'	=> $this->upload->data(), 'error' => '');
			return $return;
		} else {
			$return = array('result' => 'gagal', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}


	//upload file anggota baru
	public function uploadfile3($filename)
	{
		$this->load->library('upload');
		$config['upload_path']		= './assets/upload/anggota/';
		$config['allowed_types']	= 'xlsx';
		$config['max_size']			= '12048';
		$config['overwrite']		= true;
		$config['file_name']		= $filename;

		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			//jik berhasil
			$return = array('result' => 'success', 'file'	=> $this->upload->data(), 'error' => '');
			return $return;
		} else {
			$return = array('result' => 'gagal', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	public function uploadfile4($filename)
 	{
 		$this->load->library('upload');
 		$config['upload_path']		= './assets/upload/status_karyawan';
 		$config['allowed_types']	='xlsx';
 		$config['max_size']			='12048';
 		$config['overwrite']		=true ;
 		$config['file_name']		= $filename;

 		$this->upload->initialize($config);
 			if ($this->upload->do_upload('file')) {
 				//jik berhasil
 				$return = array('result' => 'success' , 'file'	=> $this->upload->data() , 'error' => '');
 				return $return;
 			}else{
 				$return = array('result' => 'gagal' , 'file' => '' , 'error' => $this->upload->display_errors());
 				return $return;
 			}
 	}


	//tambah file pkwt / taliasih yang di upload ke database
	public function tambah($table, $data)
	{
		$this->db->insert_batch($table, $data);
	}


	//fungsi hapus data pkwt yang akan di perbarui
	public function delPKWTlama($where)
	{
		$this->db->where('npk_br', $where);
		return $this->db->delete('pkwt');
	}

	//fungsi hapus data pkwt
	public function delPKWTupload($where)
	{
		$this->db->where('id', $where);
		return $this->db->delete('pkwt');
	}

	//input data pkwt lama ke table history pkwt
	public function insertHistoryPKWT($data)
	{
		return $this->db->insert('history_pkwt', $data);
	}


	// update data npk 
	public function updatenpk($where)
	{
		$this->db->where('id_karyawan', $where);
		return $this->db->update('karyawan', 'employee_karyawan',);
	}




	//total karyawan yang pkwt per tanggal
	public function dayPKWT($where)
	{
		return $this->db->get_where('pkwt', array('tgl' => $where));
	}

	//update status file pkwt agar bisa di upload
	public function statPKWT($where, $data)
	{
		$this->db->where(array('id_karyawan' => $where));
		return $this->db->update("pkwt", $data);
	}

	//menampilkan user sesuai role id
	public function roleUser($where)
	{
		$this->db->where($where);
		return $this->db->get("akun");
	}

	//reset password anggota 
	public function rstpsword($data, $table, $where)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	//hapus akun arh dan akun user
	public function hapusAkun($where)
	{
		$this->db->where($where);
		return $this->db->delete("akun");
	}


	//tambah akun arh dan anggota baru
	public function addArhuser($data, $table)
	{
		return $this->db->insert($table, $data);
	}

	//ambil data kelengkapan berkas npk
	public function getBerkas($where, $table)
	{
		return $this->db->get_where($table, array('npk_br' => $where));
	}

	//pagination data
	public function pageData($table, $limit, $start, $keyword = null)
	{
		if ($keyword) {
			$this->db->like('npk_br', $keyword);
			$this->db->or_like('nama', $keyword);
		}
		return $this->db->get($table, $limit, $start)->result();
	}


	//pagination data akun user
	public function pageUser($table, $limit, $start, $keyword = null)
	{
		if ($keyword) {
			$this->db->like('npk', $keyword);
			$this->db->or_like('email', $keyword);
			$this->db->where("role_id", 3);
		}
		$this->db->where("role_id", 3);
		return $this->db->get($table, $limit, $start)->result();
	}




	//update data kelengkapan berkas untuk backup tabel taliasih
	public function updatePB($data, $where, $table)
	{
		$this->db->where("id", $where);
		return $this->db->update($table, $data);
	}

	public function cv($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	//update status tempat instalasi / employee user
	public function updateInstalasi($data, $where, $table)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	//ambil data karyawan berdasarkan npk/id_karyawan
	public function getKar($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	//hapus data pengalaman lama dan skill
	public function delPengalaman($where, $table)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}

	//tambah data skill dan pengalaman
	public function addPengalaman($data, $table)
	{
		return $this->db->insert($table, $data);
	}



	//menampilkan nama anak berdasarkan nik buat data model
	public function getNIKAnak($where)
	{
		return $this->db->get_where("anak", array('nik' => $where));
	}

	public function joinExcel($where)
	{
		/*$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where('instalasi',$where);
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');*/
		$this->db->where("instalasi", $where);
		$query = $this->db->get("employe_karyawan");
		return $query;
	}

	//report data anggota di dasboard
	public function infoDashboard($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	//log aktivitas login user
	public function infoLogin($table, $where)
	{
		$this->db->limit(10);
		return $this->db->get_where($table, $where);
	}


	//hitung jumlah file yang diupload oleh user
	public function count($colom)
	{
		$this->db->where("$colom !=", "");
		return $this->db->get("employe_karyawan");
	}

	//hitung data pkwt yang terupload
	public function countPKWT($where, $table)
	{
		$this->db->where("$where !=", "");
		return $this->db->get($table);
	}


	//report excel berdasarkan pendidikan
	public function reportPendidikan($where)
	{
		$this->db->select('*');
		$this->db->from('pendidikan');
		$this->db->where("pendidikan_terakhir", $where);
		$this->db->join('karyawan', 'karyawan.id_karyawan = pendidikan.id_karyawan');
		$this->db->join('employe_karyawan', 'employe_karyawan.id_karyawan = pendidikan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report excel berdasarkan arh
	public function reportARH($where)
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where("arh1", $where);
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report excel berdasarkan domisili
	public function reportDomisili($where)
	{
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->where("domisili", $where);
		$this->db->join('employe_karyawan', ' employe_karyawan.id_karyawan =  karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report excel berdasarkan instalasi
	public function reportInstalasi($where)
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where("instalasi", $where);
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report excel berdasarkan npk
	public function reportNPK($where)
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where("employe_karyawan.npk", $where);
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report excel berdasarkan umur
	public function reportUmur($where)
	{
		if ($where == 1) {
			$query = $this->db->query('(SELECT * , (YEAR(CURDATE()) - YEAR(tgl_lahir)) AS umur FROM karyawan
										JOIN employe_karyawan ON employe_karyawan.id_karyawan = karyawan.id_karyawan
										JOIN pendidikan ON pendidikan.id_karyawan = karyawan.id_karyawan
										WHERE (YEAR(CURDATE()) - YEAR(tgl_lahir)) BETWEEN "18" AND "27" )');
		} else if ($where == 2) {
			$query = $this->db->query('(SELECT * , (YEAR(CURDATE()) - YEAR(tgl_lahir)) AS umur FROM karyawan
										JOIN employe_karyawan ON employe_karyawan.id_karyawan = karyawan.id_karyawan
										JOIN pendidikan ON pendidikan.id_karyawan = karyawan.id_karyawan
										WHERE (YEAR(CURDATE()) - YEAR(tgl_lahir)) BETWEEN "27" AND "35" )');
		} else if ($where == 3) {
			$query = $this->db->query('(SELECT * , (YEAR(CURDATE()) - YEAR(tgl_lahir)) AS umur FROM karyawan
										JOIN employe_karyawan ON employe_karyawan.id_karyawan = karyawan.id_karyawan
										JOIN pendidikan ON pendidikan.id_karyawan = karyawan.id_karyawan
										WHERE (YEAR(CURDATE()) - YEAR(tgl_lahir)) BETWEEN "35" AND "55" )');
		}

		return $query;
	}

	//report excel berdasarkan status kerjanya
	public function reportStatus($where)
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where("status_kerja", $where);
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	//report berkas berdasarkan arh 
	public function reportBERKAS($where)
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->where("arh1", $where);
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}


	// export berkas
	public function Eberkas()
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$query = $this->db->get();
		return $query;
	}

	// export ebiodata
	public function ebiodata()
	{
		$this->db->select('*');
		$this->db->from('employe_karyawan');
		$this->db->join('karyawan', 'karyawan.id_karyawan = employe_karyawan.id_karyawan');
		$this->db->join('pendidikan', 'pendidikan.id_karyawan = employe_karyawan.id_karyawan');

		$query = $this->db->get();
		return $query;
	}

	//cari data berdasarkan inputan 
	public function cari($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	//input

	// 
	public function added($data, $table)
	{
		# code...
		$this->db->insert($data, $table);
		return $this->db->affected_rows();
	}

	// delete
	public function deleted($where, $table)
	{
		# code..
		$this->db->where($where);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}


	public function update($table, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
		# code...
	}


	//cari  npk di select option 
	public function cariNPK($where, $column)
	{
		$this->db->select("*");
		$this->db->limit(10);
		$this->db->from("karyawan");
		$this->db->like("id_karyawan", $where);
		$this->db->or_like("npk", $where);
		return $this->db->get()->result_array();
	}
}
