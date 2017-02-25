<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
        if($this->session->userdata('username')){
            redirect('/pratinjau/');
        }
	}

	function index(){
        $this->data['title']='Login';
        $this->load->view('v_login', $this->data);
    }

	function proses(){
        $this->form_validation->set_rules('username','username','required|trim');
        $this->form_validation->set_rules('password','password','required|trim');
        
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Username dan password harus diisi.');
            redirect('login/index');
        }else{
            $username=$this->input->post('username');
            // cek username sudah terdaftar?
            $cek_username=$this->m_user->cekusername($username);
            if($cek_username->num_rows()>0){
                $password=$this->input->post('password');
                // cek kecocokan username dan password
                $cek=$this->m_user->cek($username, md5($password));
                if($cek->num_rows()>0){
                    //login berhasil, buat session
                    $this->session->set_userdata('username',$username);
                    $level=$this->m_user->leveluser();
                    if($level==1){
                        redirect('/pratinjau/');
                    }else{
                        $this->session->unset_userdata('username');
                        $this->session->set_flashdata('message','Responden hanya dapat login dari perangkat android.');
                        redirect('/login/');
                    }

                }else{
                    //login gagal
                    $this->session->set_flashdata('message','Kombinasi Username dan Anda Password Salah.');
                    redirect('login/index');
                }
            }else{
                //login gagal
                $this->session->set_flashdata('message','Username tidak terdaftar.');
                redirect('login/index');
            }            
        }
    }    
}
?>