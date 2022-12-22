
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Role.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Role
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */


class Role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_Model', 'role', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('role/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___name');
        $this->session->set_userdata('___is_default');
        $this->session->set_userdata('___is_superadmin');
        $this->session->set_userdata('___note');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___name') != ''){
            $this->session->set_userdata('___name', $this->input->post('___name'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___name');
            }
        }
        if($this->input->post('___is_default') != ''){
            $this->session->set_userdata('___is_default', $this->input->post('___is_default'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_default');
            }
        }
        if($this->input->post('___is_superadmin') != ''){
            $this->session->set_userdata('___is_superadmin', $this->input->post('___is_superadmin'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_superadmin');
            }
        }
        if($this->input->post('___note') != ''){
            $this->session->set_userdata('___note', $this->input->post('___note'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___note');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
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
                    'html' => $this->load->view('role/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('role/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Create Role',
                'html' => $this->load->view('role/create', '', true),
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['role'] = $this->role->get_single('roles', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Role',
                'html'  => $this->load->view('role/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['role'] = $this->role->get_single('roles', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Role',
                'html'  => $this->load->view('role/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->role->get_single('roles', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Role',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->role->save('roles', $data);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'role',
                            'socket'    => 'administrator_role',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $this->load->view('role/index', '', true)
                        ];
                    } else {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'role',
                            'socket'    => 'administrator_role',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $this->load->view('role/index', '', true)
                        ];
                    }
                }
            }
            echo json_encode($response);
            create_log($response);
        }
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ form validation check ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
            $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|xss_clean');
            $this->form_validation->set_rules('is_default', 'Is default', 'trim|xss_clean');
            $this->form_validation->set_rules('is_superadmin', 'Is superadmin', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
		$items[]    = 'id';
		$items[]    = 'name';
		$items[]    = 'is_default';
		$items[]    = 'is_superadmin';
		$items[]    = 'note';
        $data = elements($items, $_POST);
        $data['slug'] = sanitize($this->input->post('name'));
        if ($this->input->post('id')) {
            $data['modified_at']    = date('Y-m-d H:i:s');
            $data['modified_by']    = logged_in_user_id();
        } else {
            $data['created_at']     = date('Y-m-d H:i:s');
            $data['created_by']     = logged_in_user_id();
            $data['status']         = 1;
            $data['is_deleted']     = 0;
        }
        return $data;
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ change status data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->role->get_single('roles', array('id' => $obj));
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
                    $this->role->update('roles', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ destroty data from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->role->get_single('roles', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->role->delete('roles', array('id' => $this->input->post('id')));
                } else {
                    $this->role->update('roles', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Delete data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }

    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ bulk restore data from recyle bin ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function bulkdestroy()
    {
        if (check_permission(DELETE)) {
            if ($this->input->post('data_arr')) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                $id = $this->input->post('data_arr');
                for ($count = 0; $count < count($id); $count++) {
                    $check_exist = $this->role->get_single('roles', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->role->delete('roles', array('id' => $id[$count]));
                    } else {
                        $this->role->update('roles', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Delete data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ bulk restore data from recyle bin more then one ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function bulkrestore()
    {
        if (check_admin()) {
            if ($this->input->post('data_arr')) {
                $data = [
                    'is_deleted'    => 0,
                    'is_restored'   => 2,
                    'restored_at'   => date('Y-m-d H:i:s'),
                    'restored_by'   => logged_in_user_id(),
                ];

                $id = $this->input->post('data_arr');
                for ($count = 0; $count < count($id); $count++) {
                    $this->role->update('roles', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Restore data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique NAME from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_name()
    {
        $check_exist = $this->role->duplicate_check_name();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        } 
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ import data with excel format ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function import()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Import File',
                'html'  => $this->load->view('role/import', '', true)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    @$name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    @$is_default = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    @$is_superadmin = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $data[] = array(
                        'name' => @$name,
                        'slug' => sanitize(@$name),
                        'is_default' => @$is_default,
                        'is_superadmin' => @$is_superadmin,
                        'status'        => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => logged_in_user_id(),
                    );
                }
            }
            
            $insert = $this->db->insert_batch('roles', $data);
            if ($insert) {
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'import',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Import data has been success',
                    'html'      => $this->load->view('role/index', '', true)
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'role',
                    'socket'    => 'administrator_role',
                    'action'    => 'not_valid',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                    'html'      => $this->load->view('role/index', '', true)
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data name from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_name()
    {
        $response = $this->role->get_filter_by_name();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data note from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_note()
    {
        $response = $this->role->get_filter_by_note();
        echo json_encode($response);
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 14 June, 2022 10:44:49 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->role->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';
            // =====> status <===========================================================================================================================
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';
            @$is_default =  @$obj->is_default == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_superadmin =  @$obj->is_superadmin == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            // =====> action <===========================================================================================================================
            if (has_permission(VIEW, 'administrator', 'role')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="administrator/role/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }
            if (has_permission(EDIT, 'administrator', 'role')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="administrator/role/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }
            if (has_permission(DELETE, 'administrator', 'role')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="administrator/role/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$obj->name;
                $row[]  = @$obj->slug;
                $row[]  = @$is_default;
                $row[]  = @$is_superadmin;
                $row[]  = @$obj->note;
                $row[]  = @$status;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$obj->name;
                $row[]  = @$obj->slug;
                $row[]  = @$is_default;
                $row[]  = @$is_superadmin;
                $row[]  = @$obj->note;
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->role->count_all_dt(),
            "recordsFiltered" => $this->role->count_filtered(),
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
