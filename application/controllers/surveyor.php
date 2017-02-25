<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Surveyor extends CI_Controller{

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('username')){ 
            redirect('login');
        }
	}

	function index(){
		$username=$this->session->userdata('username');
		$data['datauser']=$this->m_user->getnama($username);
		$config['base_url']=site_url()."/surveyor/index";
	    $config['total_rows']= $this->db->query("SELECT * FROM user where level=1;")->num_rows();
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

		$data['dataadmin']=$this->m_user->getadmin($config);
	    $data['title']='Surveyor';
		$data['page']='v_surveyor';	       
	    $this->load->view('v_dashboard', $data);
	}

	function tambah(){
        $username=$this->session->userdata('username');
        $data['datauser']=$this->m_user->getnama($username);
        $data['title']='Tambah Pengguna';
        $data['page']='v_tambah_pengguna';
        $this->load->view('v_dashboard', $data);
	}

	function tambah_surveyor(){
        $this->form_validation->set_rules('username', 'username', 'trim|min_length[4]|max_length[60]|required|callback_cek_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]|matches[passwordconf]');
        $this->form_validation->set_rules('passwordconf', 'Konfirmasi Password', 'trim|required');
        $this->form_validation->set_rules('nama_pengguna', 'Nama', 'trim|required|min_length[4]|max_length[100]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->tambah();
        }else{                    
            $data['nama_pengguna']=$this->input->post('nama_pengguna');
            $data['password']=md5($this->input->post('password'));
            $data['username']=$this->input->post('username');
            $data['level']=1;
            $this->m_user->daftar($data);
            $this->session->set_flashdata('msg_success','Pengguna Berhasil ditambahkan.');
            redirect('surveyor');           
        }
    }

    function cek_username($input){
        $cek=$this->m_user->cekusername($input);
            if($cek->num_rows()>0){                
                $this->form_validation->set_message('cek_username', '%s telah digunakan oleh pengguna lain!');            
                return FALSE;
            }else{            
                return TRUE;
            }
    }
}
?>