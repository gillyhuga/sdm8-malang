
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Online.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Online
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Online extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Online_Model', 'online', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('online/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___fullname');
        $this->session->set_userdata('___username');
        $this->session->set_userdata('___role_id');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___is_login');
        $this->session->set_userdata('___last_logged_in_start');
        $this->session->set_userdata('___last_logged_in_end');
        $this->session->set_userdata('___last_logged_out_start');
        $this->session->set_userdata('___last_logged_out_end');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
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
        if($this->input->post('___is_login') != ''){
            $this->session->set_userdata('___is_login', $this->input->post('___is_login'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_login');
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
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
                    'html' => $this->load->view('online/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('online/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }

    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data fullname from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_fullname()
    {
        $response = $this->online->get_filter_by_fullname();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data username from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_username()
    {
        $response = $this->online->get_filter_by_username();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role_id()
    {
        $response = $this->online->get_filter_by_role_id();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data role_id from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_role_id()
    {
        $response = $this->online->get_single('roles', array('id' => $this->input->post('_role_id')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data email from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->online->get_filter_by_email();
        echo json_encode($response);
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 12:31:22 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->online->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';
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
            @$is_login =  @$obj->is_login == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Online</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">Offline</button>';
            // =====> action <===========================================================================================================================
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->email;
                $row[]  = __datetime(@$obj->last_logged_in);
                $row[]  = __datetime(@$obj->last_logged_out);
                $row[]  = @$status;
            }else {
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->role_name;
                $row[]  = @$obj->email;
                $row[]  = @$is_login;
                $row[]  = __datetime(@$obj->last_logged_in);
                $row[]  = __datetime(@$obj->last_logged_out);
                $row[]  = @$status;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->online->count_all_dt(),
            "recordsFiltered" => $this->online->count_filtered(),
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
