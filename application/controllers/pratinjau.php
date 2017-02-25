<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pratinjau extends CI_Controller{

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){ 
        	redirect('login');
        }
	}

	function index(){
		$config['base_url']=site_url()."/pratinjau/index";
	    $config['total_rows']= $this->db->query("SELECT * FROM kuisioner;")->num_rows();
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
        $data['datakuisioner']=$this->m_kuisioner->getkuisioner($config);
        $data['datajumlahpertanyaan']=$this->m_kuisioner->jumlahpertanyaan();
        $data['datajumlahresponden']=$this->m_kuisioner->jumlahresponden();

		$username=$this->session->userdata('username');
		$data['datauser']=$this->m_user->getnama($username);
	    $data['title']='Pratinjau';
		$data['page']='v_pratinjau';	       
	    $this->load->view('v_dashboard', $data);
	}

	function tambah_kuisioner(){
        $this->form_validation->set_rules('nama_kuisioner', 'Nama kuisioner', 'trim|min_length[4]|max_length[250]|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }else{                    
            $data['nama_kuisioner']=$this->input->post('nama_kuisioner');
            $this->m_kuisioner->tambahkuisioner($data);
            $this->session->set_flashdata('msg_success','Kuisioner berhasil ditambahkan.');
            redirect('pratinjau');           
        }
    }

    function edit_kuisioner(){
        $this->form_validation->set_rules('nama_kuisioner', 'Nama kuisioner', 'trim|min_length[4]|max_length[250]|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }else{                    
            $id_kuisioner=$this->input->post('id_kuisioner');
            $data['nama_kuisioner']=$this->input->post('nama_kuisioner');
            $this->m_kuisioner->editkuisioner($id_kuisioner, $data);
            $this->session->set_flashdata('msg_success','Kuisioner berhasil diubah.');
            redirect('pratinjau');           
        }
    }

    function publikasi_kuisioner(){       
        $id_kuisioner=$this->input->post('id_kuisioner');
        $data['publish']=1;
        $this->m_kuisioner->editkuisioner($id_kuisioner, $data);
        $this->session->set_flashdata('msg_success','Kuisioner berhasil dipublikasikan.');
        redirect('pratinjau');    
    }

    function hentikan_kuisioner(){       
        $id_kuisioner=$this->input->post('id_kuisioner');
        $data['publish']=2;
        $this->m_kuisioner->editkuisioner($id_kuisioner, $data);
        $this->session->set_flashdata('msg_success','Kuisioner berhasil dihentikan.');
        redirect('pratinjau');    
    }

    function hapus_kuisioner(){    	
        $id_kuisioner=$this->input->post('id_kuisioner');
        $this->m_kuisioner->hapuskuisioner($id_kuisioner);
        $this->session->set_flashdata('msg_success','Kuisioner berhasil dihapus.');
        redirect('pratinjau');           
    }

    function daftar_pertanyaan(){
        $id=$this->uri->segment(3);        
        $cek=$this->m_kuisioner->cekkuisioner($id);
        if($cek->num_rows()>0){
            $this->session->set_userdata('id_kuisioner',$id);            
            redirect('pertanyaan');           
        }else{
            redirect('pratinjau');           
        }
    }

}
?>