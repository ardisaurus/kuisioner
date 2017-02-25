<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Responden extends CI_Controller{

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('username')){ 
            redirect('login');
        }
	}

	function index(){
		$username=$this->session->userdata('username');
		$data['datauser']=$this->m_user->getnama($username);
		$config['base_url']=site_url()."/responden/index";
	    $config['total_rows']= $this->db->query("SELECT * FROM user where level=0;")->num_rows();
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

		$data['dataresponden']=$this->m_user->getresponden($config);
	    $data['title']='Responden';
		$data['page']='v_responden';	       
	    $this->load->view('v_dashboard', $data);
	}

	function tambah(){
        $username=$this->session->userdata('username');
        $data['datauser']=$this->m_user->getnama($username);
        $data['title']='Tambah Pengguna';
        $data['page']='v_tambah_responden';
        $this->load->view('v_dashboard', $data);
	}

	function tambah_responden(){
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
            $data['level']=0;
            $this->m_user->daftar($data);
            $this->session->set_flashdata('msg_success','Pengguna Berhasil ditambahkan.');
            redirect('responden');           
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

    function hapus(){    	
        $username=$this->input->post('username');
        $this->m_user->hapusakun($username);
        $this->session->set_flashdata('msg_success','Pengguna Berhasil dihapus.');
        redirect('responden');           
    }

    function ubah(){        
        $this->form_validation->set_rules('usernamebaru','usernamebaru','required|trim|min_length[4]|max_length[60]');
        $this->form_validation->set_rules('nama_pengguna','Nama pengguna','required|trim|min_length[4]|max_length[100]');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Masukan harus berjumlah antara 4-50 karakter.');
            redirect('responden');
        }else{
            $usernamelama=$this->input->post('usernamelama');
            $usernamebaru=$this->input->post('usernamebaru');        
            $data['username']=$usernamebaru;
            $data['nama_pengguna']=$this->input->post('nama_pengguna');        
            $cek=$this->m_user->cekusername($usernamebaru);
            if($cek->num_rows()>0){
            	if($usernamelama==$usernamebaru){
	                $this->m_user->ubahakun($usernamelama, $data);        
                    $this->session->set_flashdata('msg_success','Data responden berhasil diubah.');
	                redirect('responden');           		
            	}else{
	                $this->session->set_flashdata('message','Username telah digunakan pengguna lain.');
	                redirect('responden');  
            	}               
            }else{ 
                $this->m_user->ubahakun($usernamelama, $data);       
                $this->session->set_flashdata('msg_success','Data responden berhasil diubah.');
                redirect('responden');
            }
        }
    }

    function ubah_password(){
    	$this->form_validation->set_rules('passwordbaru','passwordbaru','required|trim|min_length[6]|max_length[12]');        
        $this->form_validation->set_rules('passwordbaru2','passwordbaru2','required|trim');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Password harus diisi dengan 6-12 Karakter.');
            redirect('responden');
        }else{
        	$username=$this->input->post('username');
            $passwordbaru=$this->input->post('passwordbaru');            
            $passwordbaru2=$this->input->post('passwordbaru2');
            if ($passwordbaru==$passwordbaru2) {                                
                $data['password']=md5($passwordbaru);
                $this->m_user->ubahakun($username, $data);
                $this->session->set_flashdata('msg_success','Password berhasil diubah.');
                redirect('responden');
            }else{
        	    $this->session->set_flashdata('message','Masukan password baru 2 kali dengan benar.');
                redirect('responden');
            }
        }
    }
}
?>