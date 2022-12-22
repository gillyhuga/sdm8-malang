
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Module.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Module
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Module extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Module_Model', 'module', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('module/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___module_name');
        $this->session->set_userdata('___module_slug');
        $this->session->set_userdata('___module_icon');
        $this->session->set_userdata('___module_order');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___module_name') != ''){
            $this->session->set_userdata('___module_name', $this->input->post('___module_name'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___module_name');
            }
        }
        if($this->input->post('___module_slug') != ''){
            $this->session->set_userdata('___module_slug', $this->input->post('___module_slug'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___module_slug');
            }
        }
        if($this->input->post('___module_icon') != ''){
            $this->session->set_userdata('___module_icon', $this->input->post('___module_icon'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___module_icon');
            }
        }
        if($this->input->post('___module_order') != ''){
            $this->session->set_userdata('___module_order', $this->input->post('___module_order'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___module_order');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
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
                    'html' => $this->load->view('module/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('module/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Create Module',
                'html' => $this->load->view('module/create', '', true),
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['module'] = $this->module->get_single('modules', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Module',
                'html'  => $this->load->view('module/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['module'] = $this->module->get_single('modules', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Module',
                'html'  => $this->load->view('module/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->module->get_single('modules', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Module',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->module->save('modules', $data);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'module',
                            'socket'    => 'administrator_module',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $this->load->view('module/index', '', true)
                        ];
                    } else {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'module',
                            'socket'    => 'administrator_module',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $this->load->view('module/index', '', true)
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
            $this->form_validation->set_rules('module_name', 'Module name', 'trim|xss_clean');
            $this->form_validation->set_rules('module_slug', 'Module slug', 'trim|xss_clean');
            $this->form_validation->set_rules('module_icon', 'Module icon', 'trim|xss_clean');
            $this->form_validation->set_rules('module_order', 'Module order', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
		$items[]    = 'id';
		$items[]    = 'module_name';
		$items[]    = 'module_slug';
		$items[]    = 'module_icon';
		$items[]    = 'module_order';
		$items[]    = 'note';
        $data = elements($items, $_POST);
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->module->get_single('modules', array('id' => $obj));
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
                    $this->module->update('modules', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->module->get_single('modules', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->module->delete('modules', array('id' => $this->input->post('id')));
                } else {
                    $this->module->update('modules', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
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
                    $check_exist = $this->module->get_single('modules', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->module->delete('modules', array('id' => $id[$count]));
                    } else {
                        $this->module->update('modules', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
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
                    $this->module->update('modules', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique MODULE NAME from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_module_name()
    {
        $check_exist = $this->module->duplicate_check_module_name();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        } 
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique MODULE SLUG from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_module_slug()
    {
        $check_exist = $this->module->duplicate_check_module_slug();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        } 
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique MODULE ORDER from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_module_order()
    {
        $check_exist = $this->module->duplicate_check_module_order();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        } 
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ import data with excel format ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function import()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Import File',
                'html'  => $this->load->view('module/import', '', true)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    @$module_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    @$module_slug = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    @$module_icon = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    @$module_order = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $data[] = array(
                        'module_name' => @$module_name,
                        'module_slug' => @$module_slug,
                        'module_icon' => @$module_icon,
                        'module_order' => @$module_order,
                        'status'        => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => logged_in_user_id(),
                    );
                }
            }
            
            $insert = $this->db->insert_batch('modules', $data);
            if ($insert) {
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'import',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Import data has been success',
                    'html'      => $this->load->view('module/index', '', true)
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'module',
                    'socket'    => 'administrator_module',
                    'action'    => 'not_valid',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                    'html'      => $this->load->view('module/index', '', true)
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data module_name from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_module_name()
    {
        $response = $this->module->get_filter_by_module_name();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data module_slug from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_module_slug()
    {
        $response = $this->module->get_filter_by_module_slug();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data module_icon from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_module_icon()
    {
        $response = $this->module->get_filter_by_module_icon();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data module_order from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_module_order()
    {
        $response = $this->module->get_filter_by_module_order();
        echo json_encode($response);
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:18:17 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->module->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';
            // =====> status <===========================================================================================================================
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';
            // =====> action <===========================================================================================================================
            if (has_permission(VIEW, 'administrator', 'module')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="administrator/module/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }
            if (has_permission(EDIT, 'administrator', 'module')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="administrator/module/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }
            if (has_permission(DELETE, 'administrator', 'module')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="administrator/module/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = '<button type="button" class="btn btn-xs btn-icon btn-danger waves-effect waves-classic">'.$obj->id.'</button>';
                $row[]  = @$obj->module_name;
                $row[]  = @$obj->module_slug;
                $row[]  = @$obj->module_icon;
                $row[]  = @$obj->module_order;
                $row[]  = @$obj->note;
                $row[]  = @$status;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$obj->module_name;
                $row[]  = @$obj->module_slug;
                $row[]  = @$obj->module_icon;
                $row[]  = @$obj->module_order;
                $row[]  = @$obj->note;
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->module->count_all_dt(),
            "recordsFiltered" => $this->module->count_filtered(),
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
