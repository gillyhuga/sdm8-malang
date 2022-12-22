
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Token.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Token
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Token extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Token_Model', 'token', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('token/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___fullname');
        $this->session->set_userdata('___username');
        $this->session->set_userdata('___role_id');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___token_reset_at_start');
        $this->session->set_userdata('___token_reset_at_end');
        $this->session->set_userdata('___token_reset_by');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
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
        if($this->input->post('___token_reset_at') != ''){
            $dateranges = (explode('-', $this->input->post('___token_reset_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];
            $this->session->set_userdata('___token_reset_at_start', $start);
            $this->session->set_userdata('___token_reset_at_end', $end);
        } else {
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___token_reset_at_start');
                $this->session->unset_userdata('___token_reset_at_end');
            }
        }
        if($this->input->post('___token_reset_by') != ''){
            $this->session->set_userdata('___token_reset_by', $this->input->post('___token_reset_by'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___token_reset_by');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
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
                    'html' => $this->load->view('token/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('token/index', '', true),
                ];
            }
            echo json_encode($response);
        }
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
                'module'    => 'token',
                'socket'    => 'administrator_token',
                'action'    => 'not_valid',
                'message' => $this->form_validation->error_array(),
            ];
        } else {
            $data = $this->___get_posted_data();
            $this->token->store('users', $data);
            if(is_superadmin()){
                $html = $this->load->view('token/index', '', true);
            }else{
                $html = $this->load->view('dashboard/index', '', true);
            }
            $response = [
                'status'    => 200,
                'modular'   => 'administrator',
                'module'    => 'token',
                'socket'    => 'administrator_token',
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
        $this->form_validation->set_rules('token', 'token', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ verify data to database store  ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___get_posted_data()
    {
        $items[] = 'uuid';
        $data = elements($items, $_POST);
        $data['mytoken']        = $this->input->post('mytoken');
        $data['modified_at']    = date('Y-m-d H:i:s');
        $data['modified_by']    = logged_in_user_id();
        $data['token_reset_at'] = date('Y-m-d H:i:s');
        $data['token_reset_by'] = logged_in_user_id();
        $this->token->account_logs($this->input->post('uuid'));
        return $data;
    }
    
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data fullname from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_fullname()
    {
        $response = $this->token->get_filter_by_fullname();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data username from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_username()
    {
        $response = $this->token->get_filter_by_username();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role_id()
    {
        $response = $this->token->get_filter_by_role_id();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_role_id()
    {
        $response = $this->token->get_single('roles', array('id' => $this->input->post('_role_id')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data token from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->token->get_filter_by_email();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data token_reset_by from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_token_reset_by()
    {
        $response = $this->token->get_filter_by_token_reset_by();
        echo json_encode($response);
    }
    

        
    public function reset()
    {
        if (check_permission(EDIT)) {
            $this->data['token'] = $this->token->get_single('users', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Reset Token',
                'html'  => $this->load->view('token/reset', $this->data, true)
            ];
            echo json_encode($response);
        }
    }   


    public function edit()
    {
        $this->data['token'] = $this->token->get_single('users', array('uuid' => $this->input->post('id')));
        $response = [
            'title' => 'Edit Token',
            'html'  => $this->load->view('token/edit', $this->data, true)
        ];
        echo json_encode($response);
    }   


    public function activitylog()
    {
        if (check_permission(EDIT)) {
            $this->data['log'] = $this->token->get_list('account_logs', array('uuid' => $this->input->post('id'), 'type' => 5), '', '','id', 'DESC');
            $response = [
                'title' => 'Activitylog Token',
                'html'  => $this->load->view('token/log', $this->data, true)
            ];
            echo json_encode($response);
        }
    }   


    public function check_auth()
    {
        $hashed = $this->token->get_single('users', array('uuid' => $this->input->post('_auth')))->password;
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 12 June, 2022 10:29:32 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->token->get_datatables();
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

                      
            if (has_permission(VIEW, 'administrator', 'token')) {
                $button_show =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="administrator/token/activitylog"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                    Activitylog
                </button>';
            }

            if (has_permission(EDIT, 'administrator', 'token')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="administrator/token/reset"  type="button" class="btn btn-sm btn-icon btn-primary waves-effect waves-classic">
                    Reset Token
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
                $row[]  = @$obj->mytoken;
                $row[]  = @__datetime($obj->token_reset_at);
                $row[]  = @__user_email($obj->token_reset_by);
                $row[]  = @$status;
            }else {
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->mytoken;
                $row[]  = @__datetime($obj->token_reset_at);
                $row[]  = @__user_email($obj->token_reset_by);
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->token->count_all_dt(),
            "recordsFiltered" => $this->token->count_filtered(),
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
