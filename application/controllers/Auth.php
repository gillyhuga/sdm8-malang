<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $data = array();
    public $setting = array();
    private $exp_time = 60 * 5; //5 minutes

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_Model', 'auth', TRUE);
        date_default_timezone_set("Asia/Jakarta");
    }
    

    public function login()
    {
        if($_POST){
            $data['email'] = $this->input->post('email');
            $login = $this->auth->get_single('users', $data);
            if($login){
                $password_hash = $this->db->get_where('users', array('email' => $data['email']))->row()->password;
                $check_password = password_verify($this->input->post('password'), $password_hash);
                if($check_password){
                    if(!$login->status){
                        $this->session->set_flashdata('email_error', 'Maaf account anda sedang tidak aktif');
                        redirect('login');
                    }else{
                        $privileges = $this->auth->get_list('privileges', array('role_id' => $login->role_id));
                     
                        if (empty($privileges)) {
                            $this->session->set_flashdata('email_error', 'Maaf anda belum mendapatkan hak akses pada sistem kami');
                            redirect('login');
                        }

                        // Start Proses Login and save session
                        $table_name = ara_decrypt($login->filestore);
                        $role_permission = $this->db->get_where('roles', array('id' => $login->role_id))->row();
                        $profile = $this->db->get_where($table_name, array('uuid' => $login->uuid))->row();

                        if ($login->is_login) {
                            if ($this->input->post('verify_token')) {
                                if ($login->mytoken != $this->input->post('verify_token')) {
                                    $this->session->set_userdata('email', $this->input->post('email'));
                                    $this->session->set_userdata('password', $this->input->post('password'));
                                    $this->session->set_flashdata('verify_failed', "Ops Kode Verifikasi anda salah, silahkan cobak lagi");
                                    redirect('auth/verify_account');
                                }
                            } else {
                                $this->session->set_userdata('email', $this->input->post('email'));
                                $this->session->set_userdata('password', $this->input->post('password'));
                                redirect('auth/verify_account');
                            }
                        }

                        $this->session->set_userdata('isLogin', true);
                        $this->session->set_userdata('role_id', $login->role_id);
                        $this->session->set_userdata('uuid', $login->uuid);
                        $this->session->set_userdata('url', $login->url);
                        $this->session->set_userdata('fullname', $login->fullname);
                        $this->session->set_userdata('email', $login->email);
                        $this->session->set_userdata('role_permission', $role_permission->name);
                        $this->session->set_userdata('lang', $login->language);
                        $this->session->set_userdata('filestore', $login->filestore);
                        $this->session->set_userdata('photo', $login->photo);

                        // set appliction setting
                        $setting = $this->auth->get_single('settings', array('status' => 1));
                        if (isset($setting->name)) {
                            $this->session->set_userdata('setting_name', $setting->name);
                        }
                        if (isset($setting->address)) {
                            $this->session->set_userdata('setting_address', $setting->address);
                        }
                        if (isset($setting->phone)) {
                            $this->session->set_userdata('setting_phone', $setting->phone);
                        }
                        if (isset($setting->email)) {
                            $this->session->set_userdata('setting_email', $setting->email);
                        }
                        if (isset($setting->footer)) {
                            $this->session->set_userdata('setting_footer', $setting->footer);
                        }
                        if (isset($setting->default_time_zone)) {
                            $this->session->set_userdata('default_time_zone_app', $setting->default_time_zone);
                        }

                        if (isset($setting->title)) {
                            $this->session->set_userdata('setting_title', $setting->title);
                        }

                            //   print_r($this->session->all_userdata());die;
                        $remember = $this->input->post('remember');

                        if ($remember) {
                            set_cookie("email", $this->input->post('email'), $this->exp_time);
                            set_cookie("password", $this->input->post('password'), $this->exp_time);
                            set_cookie("remember", $this->input->post('remember'), $this->exp_time);
                        } else {
                            delete_cookie("email");
                            delete_cookie("password");
                            delete_cookie("remember");
                        }
                        
                        $this->save_login_data();
                        redirect(site_url('dashboard'));
                    }
                }else{
                    $this->session->set_flashdata('password_error', 'Password anda salah, silahkan coba lagi!');
                    redirect('login');
                }
            }else{
                $this->session->set_flashdata('email_error', 'Maaf, Email anda tidak terdaftar!');
                redirect('login');
            }
        }else{
            redirect('login', 'refresh');
        }
    }

    private function save_login_data()
    {
        $data = [
            'last_logged_in' => date('Y-m-d H:i:s'),
            'is_login' => 1,
        ];
        $data2 = [
            'id' => '',
            'uuid' => $this->session->userdata('uuid'),
            'login_at' => date('Y-m-d H:i:s'),
        ];

        $this->auth->update('users', $data, array('uuid' => $this->session->userdata('uuid')));
        $return_id = $this->auth->save('account_login', $data2);
        $this->session->set_userdata('login_id', $return_id);
    }

    private function save_logout_data()
    {
        $data = [
            'last_logged_out' => date('Y-m-d H:i:s'),
            'is_login' => 0,
        ];
        $data2 = [
            'id' => $this->session->userdata('login_id'),
            'uuid' => $this->session->userdata('uuid'),
            'logout_at' => date('Y-m-d H:i:s'),
        ];

        $this->auth->update('users', $data, array('uuid' => $this->session->userdata('uuid')));
        $this->auth->save('account_login', $data2);
    }
    
    public function logout()
    {
        $this->save_logout_data();
        $this->session->unset_userdata('isLogin');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_permission');
        $this->session->unset_userdata('lang');
        $this->session->unset_userdata('filestore');
        $this->session->unset_userdata('photo');
        $this->session->unset_userdata('setting_name');
        $this->session->unset_userdata('setting_address');
        $this->session->unset_userdata('setting_phone');
        $this->session->unset_userdata('setting_email');
        $this->session->unset_userdata('setting_footer');
        $this->session->unset_userdata('default_time_zone_app');

        $this->session->sess_destroy();
        $response = [
            'status' => 200,
            'module' => 'logout',
            'user' => $this->session->userdata('fullname'),
            'message' => 'See you next time',
        ];
        echo json_encode($response);
    }


    public function verify_account()
    {
        $this->load->view('auth/verify_account');
    }

    public function verify()
    {
        $data = [
            'id' => $this->input->post('id'),
            'purchase_code' => $this->input->post('purchase_code'),
        ];
        $this->auth->save('purchase', $data);
        redirect('login');
    }


}

/* End of file Auth.php */
