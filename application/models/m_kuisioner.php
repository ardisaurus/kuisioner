<?php
class M_kuisioner extends CI_Model{

	function getkuisioner($config){
		$this->db->select('nama_kuisioner');
		$this->db->select('id_kuisioner');
		$this->db->select('publish');
		$this->db->order_by("id_kuisioner", "desc");
		$hasilquery=$this->db->get('kuisioner', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambahkuisioner($data){
		$this->db->insert('kuisioner', $data);
		return;
	}

	function hapuskuisioner($id_kuisioner){
		$query = $this->db->query("SELECT * FROM pertanyaan WHERE id_kuisioner=".$id_kuisioner);
		foreach ($query->result() as $row)
		{
			$this->db->where('id_pertanyaan', $row->id_pertanyaan);	
			$this->db->delete('jawaban');		    
		}		
		$this->db->where('id_kuisioner', $id_kuisioner);	
		$this->db->delete('pertanyaan');
		$this->db->where('id_kuisioner', $id_kuisioner);
		$this->db->delete('kuisioner');
	}

	function editkuisioner($id_kuisioner, $data){
		$this->db->where('id_kuisioner', $id_kuisioner);
		$this->db->update('kuisioner', $data);
	}

	function cekkuisioner($id){
		$this->db->where('id_kuisioner', $id);
        return $this->db->get("kuisioner");		
	}

	// ===========================================

	function getnamakuisioner(){
		$this->db->select('nama_kuisioner');
		$this->db->select('publish');
		$this->db->where('id_kuisioner', $this->session->userdata('id_kuisioner'));
		$hasilquery=$this->db->get('kuisioner');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getpertanyaan($config, $id_kuisioner){
		$this->db->select('id_pertanyaan');
		$this->db->select('id_kuisioner');
		$this->db->select('pertanyaan');
		$this->db->where('id_kuisioner', $id_kuisioner);		
		$hasilquery=$this->db->get('pertanyaan', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambahpertanyaan($data){
		$this->db->insert('pertanyaan', $data);
		return;
	}

	function hapuspertanyaan($id_pertanyaan){
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		$this->db->delete('pertanyaan');
	}

	function editpertanyaan($id_pertanyaan, $data){
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		$this->db->update('pertanyaan', $data);
	}

	function jumlahpertanyaan(){
		$hasilquery=$this->db->query("select id_kuisioner, count(id_pertanyaan) as jumlah from pertanyaan group by id_kuisioner");
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}
	}

	function jumlahresponden(){
		$hasilquery=$this->db->query("SELECT `id_kuisioner`, `pertanyaan`.`id_pertanyaan`, COUNT(DISTINCT `jawaban`.`username`) AS jumlah FROM `pertanyaan` JOIN `jawaban` WHERE `pertanyaan`.`id_pertanyaan`=`jawaban`.`id_pertanyaan` AND `jawaban`.`status`=1 GROUP BY `id_kuisioner`");
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}
	}

	function jumlahjawaban(){
		$hasilquery=$this->db->query("SELECT `id_pertanyaan`, SUM(`jawaban`) as jumlah FROM jawaban Group By `id_pertanyaan`");
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}
	}

	function getpertanyaanbyid($id_pertanyaan){
		$this->db->select('id_pertanyaan');
		$this->db->select('id_kuisioner');
		$this->db->select('pertanyaan');
		$this->db->where('id_pertanyaan', $id_pertanyaan);		
		$hasilquery=$this->db->get('pertanyaan');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function jumlahjawabanbyid($id, $jawaban){
		$hasilquery=$this->db->query("select id_pertanyaan, jawaban, count(jawaban) as jumlah from jawaban where `id_pertanyaan`=".$id." and `jawaban`=".$jawaban." group by jawaban");
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}
	}
}
?>