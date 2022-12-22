
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** User.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Master
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___role');
        $this->session->set_userdata('___email');
        $this->session->set_userdata('___nama');
        $this->session->set_userdata('___jenis_kelamin');
        $this->session->set_userdata('___hp');
        $this->session->set_userdata('___alamat');
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
        if($this->input->post('___role') != ''){
            $this->session->set_userdata('___role', $this->input->post('___role'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___role');
            }
        }
        if($this->input->post('___email') != ''){
            $this->session->set_userdata('___email', $this->input->post('___email'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___email');
            }
        }
        if($this->input->post('___nama') != ''){
            $this->session->set_userdata('___nama', $this->input->post('___nama'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___nama');
            }
        }
        if($this->input->post('___jenis_kelamin') != ''){
            $this->session->set_userdata('___jenis_kelamin', $this->input->post('___jenis_kelamin'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___jenis_kelamin');
            }
        }
        if($this->input->post('___hp') != ''){
            $this->session->set_userdata('___hp', $this->input->post('___hp'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___hp');
            }
        }
        if($this->input->post('___alamat') != ''){
            $this->session->set_userdata('___alamat', $this->input->post('___alamat'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___alamat');
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Create User',
                'html' => $this->load->view('user/create', '', true),
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['user'] = $this->user->get_single('admin', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Edit User',
                'html'  => $this->load->view('user/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['user'] = $this->user->get_single('admin', array('uuid' => $this->input->post('id')));
            $response = [
                'title' => 'Show User',
                'html'  => $this->load->view('user/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->user->get_single('admin', array('uuid' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog User',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                if ($_FILES['photo']['name']) {
                    $photo = $data['photo'];
                } else {
                    $photo = $this->input->post('prev_photo');
                }
                $process = $this->user->store('admin', $data);
                $this->user->create_new_user($process, $this->input->post('nama'), $photo);
                if(is_admin()){
                    $html = $this->load->view('user/index', '', true);
                }else{
                    $html = $this->load->view('dashboard/index', '', true);
                }
                if ($process) {
                    if ($data['uuid']) {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'master',
                            'module'    => 'user',
                            'socket'    => 'master_user',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $html
                        ];
                    } else {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'master',
                            'module'    => 'user',
                            'socket'    => 'master_user',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $html
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
            $this->form_validation->set_rules('role', 'Role', 'trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|xss_clean');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|xss_clean');
            $this->form_validation->set_rules('hp', 'Hp', 'trim|xss_clean');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
		$items[]    = 'uuid';
		$items[]    = 'nama';
		$items[]    = 'jenis_kelamin';
		$items[]    = 'hp';
		$items[]    = 'alamat';
        $data = elements($items, $_POST);
        if ($this->input->post('uuid')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = 1;
        } else {
            $data['role']      = $this->input->post('role');
            $data['email']     = $this->input->post('email');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = 1;
            $data['status']     = 1;
            $data['is_deleted'] = 0;
        }
        if($_FILES['photo']['name']){
            $data['photo'] = $this->_upload_photo();
        }
        return $data;
    }
    
    


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data image ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ change status data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
    
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->user->get_single('admin', array('uuid' => $obj));
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
                    $this->user->update('admin', $data, array('uuid' => $obj));
                    $this->user->update('users', $data, array('uuid' => $obj));
                    
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->user->get_single('admin', array('uuid' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->user->delete('admin', array('uuid' => $this->input->post('id')));
                    $this->user->delete('users', array('uuid' => $this->input->post('id')));
                } else {
                    $this->user->update('admin', $data, array('uuid' => $this->input->post('id')));
                    $this->user->update('users', $data, array('uuid' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
                    $check_exist = $this->user->get_single('admin', array('uuid' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->user->delete('admin', array('uuid' => $id[$count]));
                            $this->user->delete('users', array('uuid' => $id[$count]));
                    } else {
                        $this->user->update('admin', $data, array('uuid' => $id[$count]));
                        $this->user->update('users', $data, array('uuid' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
                    $this->user->update('admin', $data, array('uuid' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
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
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ import data with excel format ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function import()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Import File',
                'html'  => $this->load->view('user/import', '', true)
            ];
            echo json_encode($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    @$email = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    @$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    @$jenis_kelamin = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    @$hp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    @$alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data[] = array(
                        'uuid'          =>  $this->user->uuid_gen(),
                        'role'          => 2,
                        'email' => @$email,
                        'nama' => @$nama,
                        'jenis_kelamin' => @$jenis_kelamin,
                        'hp' => @$hp,
                        'alamat' => @$alamat,
                        'status'        => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => logged_in_user_id(),
                    );
                }
            }
            
            $insert = $this->db->insert_batch('admin', $data);
            if ($insert) {
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'import',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Import data has been success',
                    'html'      => $this->load->view('user/index', '', true)
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'not_valid',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                    'html'      => $this->load->view('user/index', '', true)
                ];
            }
            echo json_encode($response);
            create_log($response);
        }
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data role from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_role()
    {
        $response = $this->user->get_filter_by_role();
        echo json_encode($response);
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ edit filter data role from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit_filter_by_role()
    {
        $response = $this->user->get_single('roles', array('id' => $this->input->post('_role')));
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data email from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_email()
    {
        $response = $this->user->get_filter_by_email();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data nama from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_nama()
    {
        $response = $this->user->get_filter_by_nama();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data hp from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_hp()
    {
        $response = $this->user->get_filter_by_hp();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get filter data alamat from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_filter_by_alamat()
    {
        $response = $this->user->get_filter_by_alamat();
        echo json_encode($response);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ form validation check ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function check_exist_email()
    {
        $check_exist = $this->user->get_single('users', array('email' => $this->input->post('email')));
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        }
        echo json_encode(array('valid' => $isAvailable));
    }


    public function setup()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = array_reverse($this->input->post('data_arr'));
                foreach ($data_arr as $obj) {
                    $check_exist_user = $this->user->get_single('users', array('uuid' => $obj));
                    if($check_exist_user) continue;
                    $check_exist = $this->user->get_single('admin', array('uuid' => $obj));
                    $fullname = ucfirst($check_exist->nama);
                    $username = str_replace(' ', '', $check_exist->nama);
                    $pass = $check_exist->email;
                    $password = password_hash_random($pass);
                    if($check_exist){
                        $data = [
                            'uuid'          => $obj,
                            'photo'         => $check_exist->photo,
                            'fullname'      => $fullname,
                            'username'      => $username,
                            'role_id'       => 2,
                            'password'      => $password,
                            'email'         => $check_exist->email,
                            'mytoken'       => mt_rand(100000, 999999),
                            'filestore'     => 'HYSwzJY=',
                            'url'           => 'master/user',
                            'theme'         => 1,
                            'status'        => 1,
                            'is_verify'     => 1,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'created_by'    => logged_in_user_id(),
                        ];
                    }
                    $this->user->insert('users', $data);
                    $data2 = [
                        'status' => 1,
                        'modified_at' => date('Y-m-d H:i:s'),
                        'modified_by' => logged_in_user_id(),
                    ];
                    $this->user->update('admin', $data2, array('uuid' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'master',
                    'module'    => 'user',
                    'socket'    => 'master_user',
                    'action'    => 'setup',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'New data has been added',
                    'html'      => $this->load->view('user/index', '', true)
                ];
            }
            echo json_encode($response);
        }
    }    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:34:37 AM ]
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
            if(@$obj->jenis_kelamin == 0){
                $data_jenis_kelamin = 'Laki-laki'; 
            }else {
                $data_jenis_kelamin = 'Perempuan';
            }
            // =====> action <===========================================================================================================================
            if (has_permission(VIEW, 'master', 'user')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->uuid . '" data-url="master/user/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }
            if (has_permission(EDIT, 'master', 'user')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->uuid . '" data-url="master/user/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }
            if (has_permission(DELETE, 'master', 'user')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->uuid . '" data-url="master/user/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->role;
                $row[]  = @$obj->email;
                $row[]  = @$obj->nama;
                $row[]  = @$data_jenis_kelamin;
                $row[]  = @$obj->hp;
                $row[]  = @$obj->alamat;
                $row[]  = @$status;
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$photo;
                $row[]  = @$obj->role;
                $row[]  = @$obj->email;
                $row[]  = @$obj->nama;
                $row[]  = @$data_jenis_kelamin;
                $row[]  = @$obj->hp;
                $row[]  = @$status;
                $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
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
