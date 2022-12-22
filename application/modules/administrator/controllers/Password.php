
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Password.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Password
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Password extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Password_Model', 'password', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('password/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___fullname');
        $this->session->set_userdata('___username');
        $this->session->set_userdata('___role_id');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___password_reset_at_start');
        $this->session->set_userdata('___password_reset_at_end');
        $this->session->set_userdata('___password_reset_by');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
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
        if($this->input->post('___password_reset_at') != ''){
            $dateranges = (explode('-', $this->input->post('___password_reset_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];
            $this->session->set_userdata('___password_reset_at_start', $start);
            $this->session->set_userdata('___password_reset_at_end', $end);
        } else {
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___password_reset_at_start');
                $this->session->unset_userdata('___password_reset_at_end');
            }
        }
        if($this->input->post('___password_reset_by') != ''){
            $this->session->set_userdata('___password_reset_by', $this->input->post('___password_reset_by'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___password_reset_by');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
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
                    'html' => $this->load->view('password/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('password/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    
    


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data image ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function _upload_photo() {
        $prev_photo = $this->input->post('prev_photo');
        $image = $_FILES['photo']['name'];
        $image_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                        $original = 'assets/backend/uploads/original/';
                        $thumbnail = 'assets/backend/uploads/thumbnail/';

                        $file_type = explode(".", $image);
                        $extension = strtolower($file_type[count($file_type) - 1]);
                        $filename = strtolower(str_replace(' ', '-', $file_type[0]));
                        $rename_photo = time() . '-'. $filename .'.'.$extension;
                        move_uploaded_file($_FILES['photo']['tmp_name'], $original . $rename_photo);

                        $this->load->library('image_lib');
                        // original
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $original.$rename_photo;
                        $config['new_image']	= $original.$rename_photo;
                        $config['maintain_ratio'] = FALSE;
                        $config['width'] = '';
                        $config['height'] = '';
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        //this is the thumbnail images
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $original.$rename_photo;
                        $config['new_image']	= $thumbnail.$rename_photo;
                        $config['maintain_ratio'] = FALSE;
                        $config['width'] = '250';
                        $config['height'] = '250';
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        // need to unlink previous image
                        if ($prev_photo != "") {
                        if (file_exists($original . $prev_photo)) {
                            @unlink($original . $prev_photo);
                        }
                        if (file_exists($thumbnail . $prev_photo)) {
                            @unlink($thumbnail . $prev_photo);
                        }
                }
                $return_photo = $rename_photo;
            }
        } else {
            $return_photo = $prev_photo;
        }
        return $return_photo;
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
                'modular'   => 'administrator',
                'module'    => 'password',
                'socket'    => 'administrator_operation',
                'action'    => 'not_valid',
                'message' => $this->form_validation->error_array(),
            ];
        } else {
            $data = $this->___get_posted_data();
            $this->password->store('users', $data);
            if(is_admin()){
                $html = $this->load->view('password/index', '', true);
            }else{
                $html = $this->load->view('dashboard/index', '', true);
            }
            $response = [
                'status'    => 200,
                'modular'   => 'administrator',
                'module'    => 'password',
                'socket'    => 'administrator_operation',
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
        $this->form_validation->set_rules('password', 'password', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ verify data to database store  ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___get_posted_data()
    {
        $items[] = 'uuid';
        $data = elements($items, $_POST);
        $data['password']       = password_hash_random($this->input->post('password'));
        $data['modified_at']    = date('Y-m-d H:i:s');
        $data['modified_by']    = logged_in_user_id();
        $data['password_reset_at'] = date('Y-m-d H:i:s');
        $data['password_reset_by'] = logged_in_user_id();
        $this->password->account_logs($this->input->post('uuid'));
        return $data;
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data fullname from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_fullname()
    {
        $response = $this->password->get_filter_by_fullname();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data username from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_username()
    {
        $response = $this->password->get_filter_by_username();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role_id()
    {
        $response = $this->password->get_filter_by_role_id();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_role_id()
    {
        $response = $this->password->get_single('roles', array('id' => $this->input->post('_role_id')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data email from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->password->get_filter_by_email();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data password_reset_by from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_password_reset_by()
    {
        $response = $this->password->get_filter_by_password_reset_by();
        echo json_encode($response);
    }
    

    public function reset()
    {
        if (check_permission(EDIT)) {
            $this->data['password'] = $this->password->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Reset Password',
                'html'  => $this->load->view('password/reset', $this->data, true)
            ];
            echo json_encode($response);
        }
    }   


    public function edit()
    {
            $this->data['password'] = $this->password->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Password',
                'html'  => $this->load->view('password/edit', $this->data, true)
            ];
            echo json_encode($response);
    }   


    public function activitylog()
    {
        if (check_permission(EDIT)) {
            $this->data['log'] = $this->password->get_list('account_logs', array('uuid' => $this->input->post('id'), 'type' => 2), '', '','id', 'DESC');
            $response = [
                'title' => 'Activitylog Password',
                'html'  => $this->load->view('password/log', $this->data, true)
            ];
            echo json_encode($response);
        }
    }   


    public function check_auth()
    {
        $hashed = $this->password->get_single('users', array('uuid' => $this->input->post('_auth')))->password;
        $auth = $this->input->post('auth');
        if (password_verify($auth, $hashed)) {
            $isAvailable = true;
        } else {
            $isAvailable = false;
        }
        echo json_encode(array('valid' => $isAvailable));
    }

        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 05:16:24 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->password->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
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
            
            if (has_permission(VIEW, 'administrator', 'password')) {
                $button_show =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="administrator/password/activitylog"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    Activitylog
                </button>';
            }

            if (has_permission(EDIT, 'administrator', 'password')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="administrator/password/reset"  type="button" class="btn btn-sm btn-icon btn-primary waves-effect waves-classic">
                    Reset Password
                </button>';
            }

            // =====> action <===========================================================================================================================
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->email;
                $row[]  = @__datetime($obj->password_reset_at);
                $row[]  = @__user_email($obj->password_reset_by);
                $row[]  = @$status;
            }else {
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->email;
                $row[]  = @__datetime($obj->password_reset_at);
                $row[]  = @__user_email($obj->password_reset_by);
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->password->count_all_dt(),
            "recordsFiltered" => $this->password->count_filtered(),
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
