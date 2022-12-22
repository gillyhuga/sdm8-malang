
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** User.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Admin
* @type            : Class
* @class name      : User
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model', 'user', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('user/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___fullname');
        $this->session->set_userdata('___username');
        $this->session->set_userdata('___role_id');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___last_logged_in_start');
        $this->session->set_userdata('___last_logged_in_end');
        $this->session->set_userdata('___last_logged_out_start');
        $this->session->set_userdata('___last_logged_out_end');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___fullname') != ''){
            $this->session->set_userdata('___fullname', $this->input->post('___fullname'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___fullname');
            }
        }
        if($this->input->post('___username') != ''){
            $this->session->set_userdata('___username', $this->input->post('___username'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___username');
            }
        }
        if($this->input->post('___role_id') != ''){
            $this->session->set_userdata('___role_id', $this->input->post('___role_id'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___role_id');
            }
        }
        if($this->input->post('___email') != ''){
            $this->session->set_userdata('___email', $this->input->post('___email'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___email');
            }
        }
        if($this->input->post('___last_logged_in') != ''){
            $dateranges = (explode('-', $this->input->post('___last_logged_in')));
            $start = $dateranges[0];
            $end = $dateranges[1];
            $this->session->set_userdata('___last_logged_in_start', $start);
            $this->session->set_userdata('___last_logged_in_end', $end);
        } else {
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___last_logged_in_start');
                $this->session->unset_userdata('___last_logged_in_end');
            }
        }
        if($this->input->post('___last_logged_out') != ''){
            $dateranges = (explode('-', $this->input->post('___last_logged_out')));
            $start = $dateranges[0];
            $end = $dateranges[1];
            $this->session->set_userdata('___last_logged_out_start', $start);
            $this->session->set_userdata('___last_logged_out_end', $end);
        } else {
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___last_logged_out_start');
                $this->session->unset_userdata('___last_logged_out_end');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        $this->destroy_session_filter2();
        $this->store_filter();
        if (check_permission(MENU)) {
            if ($this->input->post('export')) {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('user/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('user/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    

    public function password()
    {
        if (check_permission(EDIT)) {
            $this->data['password'] = $this->user->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Reset Password',
                'html'  => $this->load->view('user/reset_password', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    public function email()
    {
        if (check_permission(EDIT)) {
            $this->data['email'] = $this->user->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Reset Email',
                'html'  => $this->load->view('user/reset_email', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    public function permission()
    {
        if (check_permission(EDIT)) {
            $this->data['privilege'] = $this->user->get_single('users', array('uuid' => $this->input->post('id')));
            $this->data['permission'] = $this->user->get_list('roles', array('status' => 1, 'id !=' => 1), '', '', '', 'id',  'ASC');
            $response = [
                'title' => 'Reset Permission',
                'html'  => $this->load->view('user/reset_permission', $this->data, true)
            ];
            echo json_encode($response);
        }
    }

    public function token()
    {
        if (check_permission(EDIT)) {
            $this->data['token'] = $this->user->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Reset Token',
                'html'  => $this->load->view('user/reset_token', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    public function check_old_privilege()
    {
        $check_role = $this->user->get_single('users', array('uuid' => $this->input->post('id')))->role_id;
        if($check_role == $this->input->post('old_permission')){
            $isAvailable = true;
        }else{
            $isAvailable = false;
        }
         echo json_encode(array('valid' => $isAvailable));
    }



    public function check_new_privilege()
    {
        $check_role = $this->user->get_single('users', array('uuid' => $this->input->post('id')))->role_id;
        if($check_role == $this->input->post('new_permission')){
            $isAvailable = false;
        }else{
            $isAvailable = true;
        }
         echo json_encode(array('valid' => $isAvailable));
    }
    
    public function check_email()
    {
        $check_email = $this->user->check_email();
        if (empty($check_email)) {
            $isAvailable = true;
        } else {
            $isAvailable = false;
        }
        echo json_encode(array('valid' => $isAvailable));
    }


    public function check_auth()
    {
        $hashed = $this->user->get_single('users', array('uuid' => $this->input->post('_auth')))->password;
        $auth = $this->input->post('auth');
        if (password_verify($auth, $hashed)) {
            $isAvailable = true;
        } else {
            $isAvailable = false;
        }
        echo json_encode(array('valid' => $isAvailable));
    }

    


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store new password here  ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        $this->___check_data_validation();
        if ($this->form_validation->run() == false) {
            $response = [
                'status' => 403,
                'modular'   => 'admin',
                'module'    => 'user',
                'socket'    => 'admin_user',
                'action'    => 'not_valid',
                'message' => $this->form_validation->error_array(),
            ];
        } else {
            $data = $this->___get_posted_data();
            $this->user->store('users', $data);
            if(is_admin()){
                $html = $this->load->view('user/index', '', true);
            }else{
                $html = $this->load->view('dashboard/index', '', true);
            }
            $response = [
                'status'    => 200,
                'modular'   => 'admin',
                'module'    => 'user',
                'socket'    => 'admin_user',
                'action'    => 'reset',
                'user'      => $this->session->userdata('fullname'),
                'message'   => 'Your data has been updated',
                'html'      => $html
            ];
        }
        echo json_encode($response);
        create_log($response);
    }


     // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ new password validation  ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
        if($this->input->post('_data') == 'passoword'){
            $this->form_validation->set_rules('password', 'password', 'trim|xss_clean');
        }else if($this->input->post('_data') == 'email'){
            $this->form_validation->set_rules('email', 'email', 'trim|xss_clean');
        }else if($this->input->post('_data') == 'permission'){
            $this->form_validation->set_rules('new_permission', 'new_permission', 'trim|xss_clean');
        }else{
            $this->form_validation->set_rules('mytoken', 'mytoken', 'trim|xss_clean');
        }
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ verify data to database store  ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___get_posted_data()
    {
        $items[] = 'uuid';
        $data = elements($items, $_POST);
        if($this->input->post('_data') == 'password'){
            $data['password'] = password_hash_random($this->input->post('password'));
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $data['password_reset_at'] = date('Y-m-d H:i:s');
            $data['password_reset_by'] = logged_in_user_id();
        }else if($this->input->post('_data') == 'email'){
            $this->update_data();
            $data['email'] = $this->input->post('email');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $data['email_reset_at'] = date('Y-m-d H:i:s');
            $data['email_reset_by'] = logged_in_user_id();
        }else if($this->input->post('_data') == 'permission'){
            $this->update_data();
            $data['role_id'] = $_POST['new_permission'];
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $data['permission_reset_at'] = date('Y-m-d H:i:s');
            $data['permission_reset_by'] = logged_in_user_id();
        }else{
            $data['mytoken'] = $this->input->post('mytoken');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $data['token_reset_at'] = date('Y-m-d H:i:s');
            $data['token_reset_by'] = logged_in_user_id();
        }
        $this->user->account_logs($this->input->post('uuid'));
        return $data;
    }
    

    private function update_data()
    {
        $table_name = ara_decrypt($this->user->get_single('users', array('uuid' => $this->input->post('uuid')))->filestore);
        $data['uuid'] = $this->input->post('uuid');
        if($this->input->post('new_permission')){
            $data['role'] = $_POST['new_permission'];
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        }else{
            $data['email'] = $this->input->post('email');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        }
        return $this->user->store($table_name, $data);
    }
   // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ change status data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 03:43:20 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                
                $data = [
                    'status' => $this->input->post('status'),
                    'modified_at' => date('Y-m-d H:i:s'),
                    'modified_by' => logged_in_user_id(),
                ];

                foreach ($data_arr as $obj) {
                    $check_exist = $this->user->get_single('users', array('uuid' => $obj));
                    if (empty($check_exist)) {
                        continue;
                    }
                    $table_name = ara_decrypt($check_exist->filestore);
                    $this->user->update($table_name, $data, array('uuid' => $check_exist->uuid));
                    $this->user->update('users', $data, array('uuid' => $obj));
                    if ($check_exist->status) {
                        $data = [
                            'status'        => 0,
                            'modified_at'   => date('Y-m-d H:i:s'),
                            'modified_by'   => logged_in_user_id(),
                        ];
                    } else {
                        $data = [
                            'status'        => 1,
                            'modified_at'   => date('Y-m-d H:i:s'),
                            'modified_by'   => logged_in_user_id(),
                        ];
                    }
                    
                    $this->user->update('users', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'admin',
                    'module'    => 'user',
                    'socket'    => 'admin_user',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'admin',
                    'module'    => 'user',
                    'socket'    => 'admin_user',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data fullname from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_fullname()
    {
        $response = $this->user->get_filter_by_fullname();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data username from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_username()
    {
        $response = $this->user->get_filter_by_username();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role_id()
    {
        $response = $this->user->get_filter_by_role_id();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_role_id()
    {
        $response = $this->user->get_single('roles', array('id' => $this->input->post('_role_id')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data email from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->user->get_filter_by_email();
        echo json_encode($response);
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 02:27:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->uuid . '" name="log[' . $obj->uuid . ']" value="' . $obj->uuid . '"> <label for="checkbox' . $obj->uuid . '"></label> </div>';
            // =====> status <===========================================================================================================================
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';
            if(!empty($obj->photo)){
                @$photo =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/'.@$obj->photo.'" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'original/'.@$obj->photo.'" width="50">
                </a>';
            }else{
                @$photo =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/no_user.png" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'thumbnail/no_user.png" width="50">
                </a>';
            }

            if (has_permission(EDIT, 'admin', 'user')) {
                $password =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="admin/user/password"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    <i class="icon md-shield-security" aria-hidden="true"></i> Password
                </button>';
                $email =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="admin/user/email"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    <i class="icon md-shield-security" aria-hidden="true"></i> Email
                </button>';
                $permission =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="admin/user/permission"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    <i class="icon md-shield-security" aria-hidden="true"></i> Permission
                </button>';
                $token =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="admin/user/token"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    <i class="icon md-shield-security" aria-hidden="true"></i> Token
                </button>';
                }
            // =====> action <===========================================================================================================================
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->username;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->mytoken;
                $row[]  = @$obj->email;
                $row[]  = @$status;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->username;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->mytoken;
                $row[]  = @$obj->email;
                $row[]  = @$status;
                $row[]  = @$password." ".@$email." ".@$permission. " ".@$token;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all_dt(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // public function your_funtion_here()
    // {
        // statement here
    // }   
}

#################################################################################### Cretated by Faizal Harwin ####################################################################################
####### *ALFIRA* ############################################################# Thank to My beloved wife and daughter ############################################################## *HAUARA* ######
################################################################################## Thank Your For Suporting Us ####################################################################################
####################################################################################################################################################################################################
