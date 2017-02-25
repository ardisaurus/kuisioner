<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengaturan extends CI_Controller{

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('username')){ 
            redirect('login');
        }
        
	}

	function index(){
		$username=$this->session->userdata('username');
		$data['datauser']=$this->m_user->getnama($username);        
        $data['userdetail']=$this->m_user->getuser($username);
        $data['admin_num']=$this->m_user->admin_num();		
        $data['title']='Pengaturan';
		$data['page']='v_pengaturan';
        $this->load->view('v_dashboard', $data);
	}

    function ubahusername(){        
        $this->form_validation->set_rules('usernamebaru','usernamebaru','required|trim|min_length[4]|max_length[60]');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Username harus diisi antara 4-50 karakter.');
            redirect('pengaturan');
        }else{
            $usernamelama=$this->session->userdata('username');
            $usernamebaru=$this->input->post('usernamebaru');        
            $data['username']=$usernamebaru;        
            $cek=$this->m_user->cekusername($usernamebaru);
            if($cek->num_rows()>0){
                $this->session->set_flashdata('message','Username telah digunakan pengguna lain.');
                redirect('pengaturan');
            }else{            
                $this->m_user->ubahusername($usernamelama, $data);
                $this->session->set_userdata('username',$data['username']);        
                $this->session->set_flashdata('message','Username berhasil diubah.');
                redirect('pengaturan');
            }
        }
    }

    function ubahNama_pengguna(){        
        $this->form_validation->set_rules('nama_pengguna','Nama pengguna','required|trim|min_length[4]|max_length[100]');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Nama harus diisi antara 4-50 karakter.');
            redirect('pengaturan');
        }else{
            $username=$this->session->userdata('username');        
            $data['nama_pengguna']=$this->input->post('nama_pengguna');
            $this->m_user->ubahakun($username, $data);        
            $this->session->set_flashdata('message','Nama pengguna berhasil diubah.');
            redirect('pengaturan');
        }
    }

    function ubahpassword(){
        $this->form_validation->set_rules('passwordlama','Password Lama','required|trim');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Password harus diisi.');
            redirect('pengaturan');
        }else{
            $username=$this->session->userdata('username');
            $password=$this->input->post('passwordlama');
            $cek=$this->m_user->cek($username, md5($password));
            if($cek->num_rows()>0){                      
                $this->form_validation->set_rules('passwordbaru','passwordbaru','required|trim|min_length[6]|max_length[12]');        
                $this->form_validation->set_rules('passwordbaru2','passwordbaru2','required|trim');
                if($this->form_validation->run()==false){
                    $this->session->set_flashdata('message','Password harus diisi dengan 6-12 Karakter.');
                    redirect('pengaturan');
                }else{
                    $passwordbaru=$this->input->post('passwordbaru');            
                    $passwordbaru2=$this->input->post('passwordbaru2');
                        if ($passwordbaru==$passwordbaru2) {                                
                            $data['password']=md5($passwordbaru);
                            $this->m_user->ubahakun($username, $data);
                            $this->session->set_flashdata('message','Password berhasil diubah.');
                            redirect('pengaturan');
                        }else{
                            $this->session->set_flashdata('message','Masukan password baru 2 kali dengan benar.');
                            redirect('pengaturan');
                        }
                }
            }else{
                //login gagal
                $this->session->set_flashdata('message','Password anda salah.');
                redirect('pengaturan');
            }
        }
    }

    function hapus(){
        $this->form_validation->set_rules('passwordlama','Password','required|trim');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Password harus diisi.');
            redirect('pengaturan');
        }else{
            $username=$this->session->userdata('username');
            $password=$this->input->post('passwordlama');
            $cek=$this->m_user->cek($username, md5($password));
            if($cek->num_rows()>0){
                $this->m_user->hapusakun($username);                      
                $this->logout();
            }else{
                //login gagal
                $this->session->set_flashdata('message','Password anda salah.');
                redirect('pengaturan');
            }
        }       
    }

    function logout(){
        $this->session->unset_userdata('username');  
        redirect('login');
    }
}
?>