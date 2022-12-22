<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lockscreen extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('email')){
			$this->session->set_userdata('lockscreen', TRUE);
		}else{
			redirect('login','refresh');
		}
    }
    
    public function index()
    {
        $this->load->view('auth/lockscreen', '', FALSE);
    }

    public function post()
    {
        $password_hash = $this->db->get_where('users', array('email' =>  $_POST['email']))->row();
        $check_password = password_verify($this->input->post('password'), $password_hash->password);
        if(!empty($check_password)){
            $this->session->unset_userdata('lockscreen');
            redirect('dashboard','refresh');
        }else{
            $this->session->set_flashdata('error', TRUE);
            redirect('lockscreen','refresh');
        }
    }

}

/* End of file Lockscreen.php */
