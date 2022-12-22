
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Permission.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Permission
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Permission extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permission_Model', 'permission', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 10 June, 2022 02:39:31 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        if (check_permission(MENU)) {
            $response = [
                'title' => 'Permission',
                'html' => $this->load->view('permission/index', '', true),
            ];
            echo json_encode($response);
        }
    }


     // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit permission ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 10 June, 2022 02:39:31 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['roles'] = $this->permission->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['modules'] = $this->permission->get_list('modules', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['role_id'] = $this->input->post('id');
            $this->data['role'] = $this->permission->get_single('roles', array('id' => $this->input->post('id')));
            $response = [
                'title' => "Edit Role Permission",
                'html' => $this->load->view('permission/edit', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store permission ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 10 June, 2022 02:39:31 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (count((array) $this->input->post('operation')) > 0) {
            $role_id = $this->input->post('role_id');
            foreach ($this->input->post('operation') as $key => $value) {
                $data = array();
                $data['role_id'] = $role_id;
                $data['operation_id'] = $key;
                $data['is_menu']    = isset($_POST['is_menu'][$key]) && !empty($_POST['is_menu'][$key]) ? $_POST['is_menu'][$key] : 0;
                $data['is_add']     = isset($_POST['is_add'][$key]) && !empty($_POST['is_add'][$key]) ? $_POST['is_add'][$key] : 0;
                $data['is_edit']    = isset($_POST['is_edit'][$key]) && !empty($_POST['is_edit'][$key]) ? $_POST['is_edit'][$key] : 0;
                $data['is_delete']  = isset($_POST['is_delete'][$key]) && !empty($_POST['is_delete'][$key]) ? $_POST['is_delete'][$key] : 0;
                $data['is_view']    = isset($_POST['is_view'][$key]) && !empty($_POST['is_view'][$key]) ? $_POST['is_view'][$key] : 0;
                $data['status']     = 1;
                $data['created_at']     = date('Y-m-d H:i:s');
                $data['created_by']     = logged_in_user_id();
                $data['modified_at']    = date('Y-m-d H:i:s');
                $data['modified_by']    = logged_in_user_id();

                $exist = $this->permission->get_single('privileges', array('role_id' => $role_id, 'operation_id' => $key));
                if ($exist) {
                    $this->permission->update('privileges', $data, array('role_id' => $role_id, 'operation_id' => $key));
                } else {
                    $this->permission->insert('privileges', $data);
                }
            }
      
            $this->update_config();
            $this->create_sidebar();
            $response = [
                'status'    => 200,
                'modular'   => 'administrator',
                'module'    => 'permission',
                'socket'    => 'administrator_operation',
                'action'    => 'edit',
                'user'      => $this->session->userdata('fullname'),
                'message'   => 'Setup Permission successfully',
                'html'      => $this->load->view('permission/index', '', true)
            ];
            echo json_encode($response);
            create_log($response);
        }
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 10 June, 2022 02:39:31 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->permission->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            @$is_default =  @$obj->is_default == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_superadmin =  @$obj->is_superadmin == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            if (has_permission(EDIT, 'administrator', 'permission')) {
            $permission =
            '<button id="button_edit" data-id="' . $obj->id . '" data-url="administrator/permission/edit"  type="button" class="btn btn-sm btn-icon btn-danger waves-effect waves-classic">
                <i class="icon md-shield-security" aria-hidden="true"></i> Setup Permission
            </button>';
            }
            // =====> action <===========================================================================================================================
            $no++;
            $row = array();
            $row[]  = $no;
            $row[]  = @$obj->name;
            $row[]  = @$obj->slug;
            $row[]  = @$is_default;
            $row[]  = @$is_superadmin;
            $row[] = $permission;
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->permission->count_all_dt(),
            "recordsFiltered" => $this->permission->count_filtered(),
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
