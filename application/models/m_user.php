<?php
class M_user extends CI_Model{

// =========================== Login Section ================================
    function cek($username,$password){
        $this->db->where("username",$username);
        $this->db->where("password",$password);     
        return $this->db->get("user");
    }

	 function getNama()
	{			
		$username=$this->session->userdata('username');
        $this->db->where("username",$username);
        $this->db->select('nama_pengguna');
		$query=$this->db->get('user');
		$full_name=$query->result();
		foreach ($full_name as $user) {
			$nick_name=explode(" ",$user->nama_pengguna);
			if (count($nick_name)>1) {				
				$nama_user=$nick_name[0]." ".$nick_name[1];	
			}else{
				$nama_user=$user->nama_pengguna;
			}
		}
		return $nama_user;
	}

	function daftar($data){
		$this->db->insert('user', $data);
		return;
	}

	function levelUser()
	{			
		$username=$this->session->userdata('username');
		$this->db->where('username',$username);
        $this->db->select('level');
		$query=$this->db->get('user');
		$row = $query->row();
		$level=$row->level;		
		return $level;
	}

// =========================== Login Section End ===============================

// ========================== Pengaturan Section ===============================
	function getUser(){		
		$username=$this->session->userdata('username');
        $this->db->select('nama_pengguna');
        $this->db->select('username');
		$this->db->where('username', $username);
		$hasilquery=$this->db->get('user');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function admin_num(){
        $this->db->select('level');		
		$this->db->where('level', 1);
		$hasilquery=$this->db->get('user');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function cekusername($usernamebaru){
		$this->db->where('username', $usernamebaru);
        return $this->db->get("user");
	}

	function ubahusername($usernamelama, $data){
		$this->db->where('username', $usernamelama);
		$this->db->update('user', $data);
	}

	function ubahAkun($username, $data){
		$this->db->where('username', $username);
		$this->db->update('user', $data);
	}

// ============================== Pengaturan End ==============================

// ========================== Manajemen Section ===============================
	function getAdmin($config){
		$this->db->select('nama_pengguna');
        $this->db->select('username');		
		$this->db->where('level', 1);
		$hasilquery=$this->db->get('user', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getResponden($config){
		$this->db->select('nama_pengguna');
        $this->db->select('username');		
		$this->db->where('level', 0);
		$hasilquery=$this->db->get('user', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function hapusakun($username){
		$this->db->where('username', $username);
		$this->db->delete('user');
	}

// ============================== Manajemen End ==============================

}
?>