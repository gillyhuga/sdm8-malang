
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Activitylog.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Activitylog
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Activitylog extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Activitylog_Model', 'activitylog', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('activitylog/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___uuid');
        $this->session->set_userdata('___role');
        $this->session->set_userdata('___fullname');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___modular');
        $this->session->set_userdata('___module');
        $this->session->set_userdata('___action');
        $this->session->set_userdata('___response');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___uuid') != ''){
            $this->session->set_userdata('___uuid', $this->input->post('___uuid'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___uuid');
            }
        }
        if($this->input->post('___role') != ''){
            $this->session->set_userdata('___role', $this->input->post('___role'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___role');
            }
        }
        if($this->input->post('___fullname') != ''){
            $this->session->set_userdata('___fullname', $this->input->post('___fullname'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___fullname');
            }
        }
        if($this->input->post('___email') != ''){
            $this->session->set_userdata('___email', $this->input->post('___email'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___email');
            }
        }
        if($this->input->post('___modular') != ''){
            $this->session->set_userdata('___modular', $this->input->post('___modular'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___modular');
            }
        }
        if($this->input->post('___module') != ''){
            $this->session->set_userdata('___module', $this->input->post('___module'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___module');
            }
        }
        if($this->input->post('___action') != ''){
            $this->session->set_userdata('___action', $this->input->post('___action'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___action');
            }
        }
        if($this->input->post('___response') != ''){
            $this->session->set_userdata('___response', $this->input->post('___response'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___response');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
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
                    'html' => $this->load->view('activitylog/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('activitylog/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data uuid from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_uuid()
    {
        $response = $this->activitylog->get_filter_by_uuid();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role()
    {
        $response = $this->activitylog->get_filter_by_role();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data fullname from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_fullname()
    {
        $response = $this->activitylog->get_filter_by_fullname();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data email from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->activitylog->get_filter_by_email();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data modular from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_modular()
    {
        $response = $this->activitylog->get_filter_by_modular();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data module from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_module()
    {
        $response = $this->activitylog->get_filter_by_module();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data action from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_action()
    {
        $response = $this->activitylog->get_filter_by_action();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data response from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_response()
    {
        $response = $this->activitylog->get_filter_by_response();
        echo json_encode($response);
    }
    

     // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ bulk restore data from recyle bin ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:06:04 AM ]?
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function bulkdestroy()
    {
        if (check_permission(DELETE)) {
            if ($this->input->post('data_arr')) {
                $id = $this->input->post('data_arr');
                for ($count = 0; $count < count($id); $count++) {
                    $this->activitylog->delete('activitylogs', array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'activitylog',
                    'socket'    => 'administrator_activitylog',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'activitylog',
                    'socket'    => 'administrator_activitylog',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Delete data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
        }
    }
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:02:45 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->activitylog->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';
            // =====> action <===========================================================================================================================
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$obj->uuid;
                $row[]  = @$obj->role;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->email;
                $row[]  = @$obj->ip_address;
                $row[]  = @$obj->user_agent;
                $row[]  = @$obj->modular;
                $row[]  = @$obj->module;
                $row[]  = @$obj->action;
                $row[]  = @$obj->response;
                $row[]  = @$obj->activity;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$obj->role;
                $row[]  = @$obj->fullname;
                $row[]  = @$obj->email;
                $row[]  = @$obj->ip_address;
                $row[]  = @$obj->modular;
                $row[]  = @$obj->module;
                $row[]  = @$obj->action;
                $row[]  = @$obj->response;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->activitylog->count_all_dt(),
            "recordsFiltered" => $this->activitylog->count_filtered(),
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
