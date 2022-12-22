
<?php

defined('BASEPATH') or exit('No direct script access allowed');


/* * ***************** Setting.php **********************************
* @product name    : CoreT Apps
* @programmer      : Faizal Harwin
* @module          : Setting
* @type            : Class
* @class name      : Setting
* @description     : Your description here
* @author          : Faizal Harwin, S.Kom
* @url             : https://themeforest.net/user/bale_nichi
* @support         : faizalharwin@gmail.com
* @copyright       : Bale Nichi Team
* Tempate          : Nazox - Admin & Dashboard Template v1.0.0
* ***************************************************************** */


class Setting extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_Model', 'set', true);
    }
    
    
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:39:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        if (check_permission(EDIT)) {
            $this->data['data'] = $this->set->get_single('settings', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Setting',
                'html'  => $this->load->view('edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }
    
   
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:39:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'setting',
                    'module'    => 'setting',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->set->save('settings', $data);
                $html = $this->load->view('dashboard/index', '', true);

                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'setting',
                            'module'    => 'setting',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $html
                        ];
                    } else {
                        $response = [
                            'status'    => 200,
                            'modular'   => 'setting',
                            'module'    => 'setting',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $html
                        ];
                    }
                }
            }
            echo json_encode($response);
        }
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ form validation check ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:39:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
            $this->form_validation->set_rules('logo', 'Logo', 'trim|xss_clean');
            $this->form_validation->set_rules('meta_author', 'Meta Author', 'trim|xss_clean');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
            $this->form_validation->set_rules('login', 'Login', 'trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
            $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean');
            $this->form_validation->set_rules('currency_symbol', 'Currency symbol', 'trim|xss_clean');
            $this->form_validation->set_rules('footer', 'Footer', 'trim|xss_clean');
            $this->form_validation->set_rules('enable_frontend', 'Enable frontend', 'trim|xss_clean');
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:39:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
		$items[]    = 'id';
		$items[]    = 'name';
		$items[]    = 'title';
		$items[]    = 'address';
		$items[]    = 'phone';
		$items[]    = 'login';
		$items[]    = 'email';
		$items[]    = 'meta_author';
		$items[]    = 'meta_description';
		$items[]    = 'currency';
		$items[]    = 'currency_symbol';
		$items[]    = 'footer';
		$items[]    = 'enable_frontend';
		$items[]    = 'facebook_url';
		$items[]    = 'twitter_url';
		$items[]    = 'google_plus_url';
		$items[]    = 'youtube_url';
		$items[]    = 'instagram_url';
        
        $data = elements($items, $_POST);
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = 1;
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = 1;
            $data['status']     = 1;
            $data['is_deleted'] = 0;
        }
        if($_FILES['logo']['name']){
            $data['logo'] = $this->_upload_logo();
        }
        return $data;
    }
    
    


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ upload data image ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 15 June, 2022 01:39:02 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function _upload_logo() {
        $prev_logo = $this->input->post('prev_logo');
        $image = $_FILES['logo']['name'];
        $image_type = $_FILES['logo']['type'];
        $return_logo = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                        $original = 'assets/backend/uploads/original/';
                        $thumbnail = 'assets/backend/uploads/thumbnail/';

                        $file_type = explode(".", $image);
                        $extension = strtolower($file_type[count($file_type) - 1]);
                        $filename = strtolower(str_replace(' ', '-', $file_type[0]));
                        $rename_logo = time() . '-'. $filename .'.'.$extension;
                        move_uploaded_file($_FILES['logo']['tmp_name'], $original . $rename_logo);

                        $this->load->library('image_lib');
                        // original
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $original.$rename_logo;
                        $config['new_image']	= $original.$rename_logo;
                        $config['maintain_ratio'] = FALSE;
                        $config['width'] = '';
                        $config['height'] = '';
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        //this is the thumbnail images
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $original.$rename_logo;
                        $config['new_image']	= $thumbnail.$rename_logo;
                        $config['maintain_ratio'] = FALSE;
                        $config['width'] = '250';
                        $config['height'] = '250';
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        // need to unlink previous image
                        if ($prev_logo != "") {
                        if (file_exists($original . $prev_logo)) {
                            @unlink($original . $prev_logo);
                        }
                        if (file_exists($thumbnail . $prev_logo)) {
                            @unlink($thumbnail . $prev_logo);
                        }
                }
                $return_logo = $rename_logo;
            }
        } else {
            $return_logo = $prev_logo;
        }
        return $return_logo;
    }
}

#################################################################################### Cretated by Faizal Harwin ####################################################################################
####### *ALFIRA* ############################################################# Thank to My beloved wife and daughter ############################################################## *HAUARA* ######
################################################################################## Thank Your For Suporting Us ####################################################################################
####################################################################################################################################################################################################
