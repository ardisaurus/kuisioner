<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pertanyaan extends CI_Controller{

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username') OR !$this->session->userdata('id_kuisioner')){ 
        	redirect('login');
        }else{
            $cek=$this->m_kuisioner->cekkuisioner($this->session->userdata('id_kuisioner'));
            if(!$cek->num_rows()>0){
                $this->session->unset_userdata('id_kuisioner');                
                redirect('pratinjau');           
            }
        }
	}

	function index(){
        $id_kuisioner=$this->session->userdata('id_kuisioner');
		$config['base_url']=site_url()."/pertanyaan/index";
	    $config['total_rows']= $this->db->query("SELECT * FROM pertanyaan where id_kuisioner=$id_kuisioner;")->num_rows();
	    $config['per_page']=10;
	    $config['num_links']=3;
	    $config['uri_segment']=3;
	    //Tambahan untuk styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
	    $this->pagination->initialize($config);
        $data['datapertanyaan']=$this->m_kuisioner->getpertanyaan($config, $id_kuisioner);
        $data['datakuisioner']=$this->m_kuisioner->getnamakuisioner();
        $data['datajawaban']=$this->m_kuisioner->jumlahjawaban();        
		$username=$this->session->userdata('username');
		$data['datauser']=$this->m_user->getnama($username);
	    $data['title']='Daftar Pertanyaan';
		$data['page']='v_pertanyaan';	       
	    $this->load->view('v_dashboard', $data);
	}

	function tambah_pertanyaan(){
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'trim|min_length[4]|max_length[250]|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }else{                    
            $data['pertanyaan']=$this->input->post('pertanyaan');
            $data['id_kuisioner']=$this->session->userdata('id_kuisioner');
            $this->m_kuisioner->tambahpertanyaan($data);
            $this->session->set_flashdata('msg_success','Pertanyaan berhasil ditambahkan.');
            redirect('pertanyaan');           
        }
    }

    function edit_pertanyaan(){
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'trim|min_length[4]|max_length[250]|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }else{                    
            $id_pertanyaan=$this->input->post('id_pertanyaan');
            $data['pertanyaan']=$this->input->post('pertanyaan');
            $this->m_kuisioner->editpertanyaan($id_pertanyaan, $data);
            $this->session->set_flashdata('msg_success','Pertanyaan berhasil diubah.');
            redirect('pertanyaan');           
        }
    }

    function hapus_pertanyaan(){    	
        $id_pertanyaan=$this->input->post('id_pertanyaan');
        $this->m_kuisioner->hapuspertanyaan($id_pertanyaan);
        $this->session->set_flashdata('msg_success','Pertanyaan berhasil dihapus.');
        redirect('pertanyaan');           
    }

    function grafik_jawaban(){
        $data['datakuisioner']=$this->m_kuisioner->getnamakuisioner();
        $id=$this->uri->segment(3);        
        $data['datajawaban_1']=$this->m_kuisioner->jumlahjawabanbyid($id, 1);
        $data['datajawaban_2']=$this->m_kuisioner->jumlahjawabanbyid($id, 2);
        $data['datajawaban_3']=$this->m_kuisioner->jumlahjawabanbyid($id, 3);
        $data['datajawaban_4']=$this->m_kuisioner->jumlahjawabanbyid($id, 4);
        $data['datajawaban_5']=$this->m_kuisioner->jumlahjawabanbyid($id, 5);
        $data['datapertanyaan']=$this->m_kuisioner->getpertanyaanbyid($id);        
        $username=$this->session->userdata('username');
        $data['datauser']=$this->m_user->getnama($username);
        $data['title']='Grafik Jawaban';
        $data['page']='v_grafik_jawaban';          
        $this->load->view('v_dashboard', $data);
    }

}
?>