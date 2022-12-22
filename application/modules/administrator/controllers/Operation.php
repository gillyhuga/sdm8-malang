
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Operation.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Administrator
* @type            : Class
* @class name      : Operation
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */

class Operation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Operation_Model', 'operation', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('operation/filter', '', true),
        ];
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___id_module');
        $this->session->set_userdata('___operation_name');
        $this->session->set_userdata('___operation_slug');
        $this->session->set_userdata('___order_menu');
        $this->session->set_userdata('___is_menu_vissible');
        $this->session->set_userdata('___is_view_vissible');
        $this->session->set_userdata('___is_add_vissible');
        $this->session->set_userdata('___is_edit_vissible');
        $this->session->set_userdata('___is_delete_vissible');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___id_module') != ''){
            $this->session->set_userdata('___id_module', $this->input->post('___id_module'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___id_module');
            }
        }
        if($this->input->post('___operation_name') != ''){
            $this->session->set_userdata('___operation_name', $this->input->post('___operation_name'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___operation_name');
            }
        }
        if($this->input->post('___operation_slug') != ''){
            $this->session->set_userdata('___operation_slug', $this->input->post('___operation_slug'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___operation_slug');
            }
        }
        if($this->input->post('___order_menu') != ''){
            $this->session->set_userdata('___order_menu', $this->input->post('___order_menu'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___order_menu');
            }
        }
        if($this->input->post('___is_menu_vissible') != ''){
            $this->session->set_userdata('___is_menu_vissible', $this->input->post('___is_menu_vissible'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_menu_vissible');
            }
        }
        if($this->input->post('___is_view_vissible') != ''){
            $this->session->set_userdata('___is_view_vissible', $this->input->post('___is_view_vissible'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_view_vissible');
            }
        }
        if($this->input->post('___is_add_vissible') != ''){
            $this->session->set_userdata('___is_add_vissible', $this->input->post('___is_add_vissible'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_add_vissible');
            }
        }
        if($this->input->post('___is_edit_vissible') != ''){
            $this->session->set_userdata('___is_edit_vissible', $this->input->post('___is_edit_vissible'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_edit_vissible');
            }
        }
        if($this->input->post('___is_delete_vissible') != ''){
            $this->session->set_userdata('___is_delete_vissible', $this->input->post('___is_delete_vissible'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___is_delete_vissible');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
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
                    'html' => $this->load->view('operation/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Role',
                    'html' => $this->load->view('operation/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Create Operation',
                'html' => $this->load->view('operation/create', '', true),
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['operation'] = $this->operation->get_single('operations', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Operation',
                'html'  => $this->load->view('operation/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['operation'] = $this->operation->get_single('operations', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Operation',
                'html'  => $this->load->view('operation/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->operation->get_single('operations', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Operation',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->operation->save('operations', $data);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'operation',
                            'socket'    => 'administrator_operation',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $this->load->view('operation/index', '', true)
                        ];
                    } else {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'administrator',
                            'module'    => 'operation',
                            'socket'    => 'administrator_operation',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $this->load->view('operation/index', '', true)
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
            $this->form_validation->set_rules('id_module', 'Id module', 'trim|xss_clean');
            $this->form_validation->set_rules('operation_name', 'Operation name', 'trim|xss_clean');
            $this->form_validation->set_rules('operation_slug', 'Operation slug', 'trim|xss_clean');
            $this->form_validation->set_rules('order_menu', 'Order menu', 'trim|xss_clean');
            $this->form_validation->set_rules('is_menu_vissible', 'Is menu vissible', 'trim|xss_clean');
            $this->form_validation->set_rules('is_view_vissible', 'Is view vissible', 'trim|xss_clean');
            $this->form_validation->set_rules('is_add_vissible', 'Is add vissible', 'trim|xss_clean');
            $this->form_validation->set_rules('is_edit_vissible', 'Is edit vissible', 'trim|xss_clean');
            $this->form_validation->set_rules('is_delete_vissible', 'Is delete vissible', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
		$items[]    = 'id';
		$items[]    = 'id_module';
		$items[]    = 'operation_name';
		$items[]    = 'operation_slug';
		$items[]    = 'order_menu';
		$items[]    = 'is_menu_vissible';
		$items[]    = 'is_view_vissible';
		$items[]    = 'is_add_vissible';
		$items[]    = 'is_edit_vissible';
		$items[]    = 'is_delete_vissible';
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->operation->get_single('operations', array('id' => $obj));
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
                    $this->operation->update('operations', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->operation->get_single('operations', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->operation->delete('operations', array('id' => $this->input->post('id')));
                } else {
                    $this->operation->update('operations', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
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
                    $check_exist = $this->operation->get_single('operations', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->operation->delete('operations', array('id' => $id[$count]));
                    } else {
                        $this->operation->update('operations', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
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
                    $this->operation->update('operations', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique OPERATION NAME from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_operation_name()
    {
        $check_exist = $this->operation->duplicate_check_operation_name();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        }
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique OPERATION SLUG from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_operation_slug()
    {
        $check_exist = $this->operation->duplicate_check_operation_slug();
        if(!empty($_POST['id_module'])){
            if ($check_exist) {
                $isAvailable = false;
            } else {
                $isAvailable = true;
            }
        }else{
            $isAvailable = false;
        }
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ check unique ORDER MENU from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_order_menu()
    {
        $check_exist = $this->operation->duplicate_check_order_menu();
        if(!empty($_POST['id_module'])){
            if ($check_exist) {
                $isAvailable = false;
            } else {
                $isAvailable = true;
            }
        }else{
            $isAvailable = false;
        }
        echo json_encode(array('valid' => $isAvailable));
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ import data with excel format ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function import()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Import File',
                'html'  => $this->load->view('operation/import', '', true)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    @$id_module = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    @$operation_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    @$operation_slug = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    @$order_menu = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    @$is_menu_vissible = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    @$is_view_vissible = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    @$is_add_vissible = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    @$is_edit_vissible = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    @$is_delete_vissible = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $data[] = array(
                        'id_module' => @$id_module,
                        'operation_name' => @$operation_name,
                        'operation_slug' => @$operation_slug,
                        'order_menu' => @$order_menu,
                        'is_menu_vissible' => @$is_menu_vissible,
                        'is_view_vissible' => @$is_view_vissible,
                        'is_add_vissible' => @$is_add_vissible,
                        'is_edit_vissible' => @$is_edit_vissible,
                        'is_delete_vissible' => @$is_delete_vissible,
                        'status'        => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => logged_in_user_id(),
                    );
                }
            }
            
            $insert = $this->db->insert_batch('operations', $data);
            if ($insert) {
                $response = [
                    'status'    => 200,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'import',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Import data has been success',
                    'html'      => $this->load->view('operation/index', '', true)
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'administrator',
                    'module'    => 'operation',
                    'socket'    => 'administrator_operation',
                    'action'    => 'not_valid',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                    'html'      => $this->load->view('operation/index', '', true)
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data id_module from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_id_module()
    {
        $response = $this->operation->get_filter_by_id_module();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data id_module from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_id_module()
    {
        $response = $this->operation->get_single('modules', array('id' => $this->input->post('_id_module')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data operation_name from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_operation_name()
    {
        $response = $this->operation->get_filter_by_operation_name();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data operation_slug from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_operation_slug()
    {
        $response = $this->operation->get_filter_by_operation_slug();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data order_menu from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_order_menu()
    {
        $response = $this->operation->get_filter_by_order_menu();
        echo json_encode($response);
    }
    
        
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 13 June, 2022 10:21:38 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->operation->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';
            // =====> status <===========================================================================================================================
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';
            @$is_menu_vissible =  @$obj->is_menu_vissible == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_view_vissible =  @$obj->is_view_vissible == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_add_vissible =  @$obj->is_add_vissible == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_edit_vissible =  @$obj->is_edit_vissible == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            @$is_delete_vissible =  @$obj->is_delete_vissible == 1 ? '<button type="button" class="btn btn-sm btn-primary waves-effect waves-classic">Yes</button>' : '<button type="button" class="btn btn-sm btn-default waves-effect waves-classic">No</button>';
            // =====> action <===========================================================================================================================
            if (has_permission(VIEW, 'administrator', 'operation')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="administrator/operation/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }
            if (has_permission(EDIT, 'administrator', 'operation')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="administrator/operation/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }
            if (has_permission(DELETE, 'administrator', 'operation')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="administrator/operation/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$obj->module;
                $row[]  = @$obj->operation_name;
                $row[]  = @$obj->operation_slug;
                $row[]  = @$obj->order_menu;
                $row[]  = @$is_menu_vissible;
                $row[]  = @$is_view_vissible;
                $row[]  = @$is_add_vissible;
                $row[]  = @$is_edit_vissible;
                $row[]  = @$is_delete_vissible;
                $row[]  = @$status;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$obj->module;
                $row[]  = @$obj->operation_name;
                $row[]  = @$obj->operation_slug;
                $row[]  = @$obj->order_menu;
                $row[]  = @$is_menu_vissible;
                $row[]  = @$is_view_vissible;
                $row[]  = @$is_add_vissible;
                $row[]  = @$is_edit_vissible;
                $row[]  = @$is_delete_vissible;
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            }
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->operation->count_all_dt(),
            "recordsFiltered" => $this->operation->count_filtered(),
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
