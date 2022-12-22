<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_Model', 'auth', TRUE);
	}
	
	public function index()
	{
		
		if (get_cookie('remember')) {
			$data['email'] = get_cookie('email');
			$password = get_cookie('password');
			$login = $this->auth->get_single('users', $data);
			if ($login) {
				$password_hash = $this->auth->get_single('users', array('email' =>  $data['email']))->password;
				$check_password = password_verify($password, $password_hash);
				if (!empty($check_password)) {
					redirect('dashboard', 'location');
				} else {
					redirect('login', 'location');
				}
			}
		}
		if (logged_in_user_id()) {
			redirect('dashboard', 'location');
		} else {
			$purchas_code = $this->db->get_where('purchase', array('purchase_code' => $this->config->item('encryption_key')))->row();
			if(!empty($purchas_code)){
				$this->load->view('auth/login');
			}else{
				$this->load->view('auth/verify');
			}
		}
	}

	public function not_found()
	{
		$this->load->view('auth/not_found', '', FALSE);
	}
}
