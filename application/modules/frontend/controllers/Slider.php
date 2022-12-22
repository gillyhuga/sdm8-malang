
<?php

defined('BASEPATH') or exit('No direct script access allowed');


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------[  Aplication Name  ]    : CoreT                                                           
// -----------------[  Programmer       ]    : Faizal Harwin                                                
// -----------------[  Module           ]    : Frontend                                               
// -----------------[  Type             ]    : Class                                                  
// -----------------[  Class name       ]    : Slider                                                     
// -----------------[  Description      ]    : Your description here                                       
// -----------------[  Author           ]    : Faizal Harwin, S.Kom                                         
// -----------------[  URL              ]    : https://themeforest.net/user/bale_nichi                   
// -----------------[  Support          ]    : faizalharwin@gmail.com                                     
// -----------------[  Copyright        ]    : Bale Nichi Team                                          
// -----------------[  Tempate usage    ]    : Remark Pro - V4                                           
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

class Slider extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slider_Model', 'slider', true);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('slider/filter', '', true),
        ];
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        $this->store_filter();
        if (check_permission(MENU)) {
            $response = [
                'title' => 'Slider',
                'html' => $this->load->view('slider/index', '', true),
            ];
            echo json_encode($response);
        }
    }

    
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Add New Slider',
                'html' => $this->load->view('slider/create', '', true),
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['slider'] = $this->slider->get_single('fr_slider', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Slider',
                'html'  => $this->load->view('slider/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['slider'] = $this->slider->get_single('fr_slider', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Slider',
                'html'  => $this->load->view('slider/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->slider->get_single('fr_slider', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Slider',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->slider->save('fr_slider', $data);
                $page = $this->load->view('slider/index', '', true);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'frontend',
                            'module'    => 'slider',
                            'socket'    => 'frontend_slider',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $page
                        ];
                    } else {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'frontend',
                            'module'    => 'slider',
                            'socket'    => 'frontend_slider',
                            'action'    => 'add',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'New data has been added',
                            'html'      => $page
                        ];
                    }
                }
            }
            echo json_encode($response);
            create_log($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ form validation check ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
        $this->form_validation->set_rules('slider', 'Slider', 'trim|xss_clean');
        $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'trim|xss_clean');
        $this->form_validation->set_rules('order_menu', 'Order menu', 'trim|xss_clean');      
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
        $items[]    = 'id';
		$items[]    = 'title';
		$items[]    = 'subtitle';
		$items[]    = 'order_menu';
		$items[]    = 'note';
        $data = elements($items, $_POST);
        if($_FILES['slider']['name']){
            $data['slider'] = $this->_upload_slider();
        }
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();;
        } else {
            $data['created_at']    = date('Y-m-d H:i:s');
            $data['created_by']    = logged_in_user_id();;
            $data['status']        = 1;
            $data['is_deleted']    = 0;
        }
        return $data;
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ change status data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->slider->get_single('fr_slider', array('id' => $obj));
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
                    $this->slider->update('fr_slider', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                ];
            }
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ destroty data from database ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->slider->get_single('fr_slider', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->slider->delete('fr_slider', array('id' => $this->input->post('id')));
                } else {
                    $this->slider->update('fr_slider', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Delete data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ bulk restore data from recyle bin ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
                    $check_exist = $this->slider->get_single('fr_slider', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->slider->delete('fr_slider', array('id' => $id[$count]));
                    } else {
                        $this->slider->update('fr_slider', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Delete data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ bulk restore data from recyle bin more then one ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
                    $this->slider->update('fr_slider', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'slider',
                    'socket'    => 'frontend_slider',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Restore data FAILED, Please try again',
                ];
            }
            echo json_encode($response);
        }
    }


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------------------------------------------[ HAURA START ] --------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<-----------
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:24:02 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Upload Image file slider ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function _upload_slider() {
        $prev_slider = $this->input->post('prev_slider');
        $image = $_FILES['slider']['name'];
        $image_type = $_FILES['slider']['type'];
        $return_slider = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' ||$image_type == 'image/jpg' || $image_type == 'image/png') {
                    $original = 'assets/backend/uploads/original/';
                    $thumbnail = 'assets/backend/uploads/thumbnail/';
                    $file_type = explode(".", $image);
                    $extension = strtolower($file_type[count($file_type) - 1]);
                    $filename = strtolower(str_replace(' ', '-', $file_type[0]));
                    $rename_slider = time() . '-'. $filename .'.'.$extension;
                    move_uploaded_file($_FILES['slider']['tmp_name'], $original . $rename_slider);

                    $this->load->library('image_lib');
                    // original
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_slider;
                    $config['new_image']	= $original.$rename_slider;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '1920';
                    $config['height'] = '820';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //this is the thumbnail images
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_slider;
                    $config['new_image']	= $thumbnail.$rename_slider;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '480';
                    $config['height'] = '205';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    // need to unlink previous image
                    if ($prev_slider != "") {
                    if (file_exists($original . $prev_slider)) {
                        @unlink($original . $prev_slider);
                    }
                    if (file_exists($thumbnail . $prev_slider)) {
                        @unlink($thumbnail . $prev_slider);
                    }
                }
                $return_slider = $rename_slider;
            }
        } else {
            $return_slider = $prev_slider;
        }
        return $return_slider;
    }

    
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ unique order_menu ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function unique_order_menu()
    {
        $check_exist = $this->slider->duplicate_check_order_menu();
        if ($check_exist) {
            $isAvailable = false;
        } else {
            $isAvailable = true;
        } 
        echo json_encode(array('valid' => $isAvailable));
    }
    


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------------------------------------------[ ALFIRA END] ----------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<-----------
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:24:02 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:24:02 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->slider->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ checkbox ]
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ slider ]
            if(!empty($obj->slider)){
                @$slider =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/'.@$obj->slider.'" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'original/'.@$obj->slider.'" width="50">
                </a>';
            }else{
                @$slider =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/no_image.png" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'thumbnail/no_image.png" width="50">
                </a>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Status ]
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button show ]
            if (has_permission(VIEW, 'frontend', 'slider')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="frontend/slider/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button edit ]
            if (has_permission(VIEW, 'frontend', 'slider')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="frontend/slider/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button destroy ]
            if (has_permission(VIEW, 'frontend', 'slider')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="frontend/slider/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            $row[]  = $checkbox;
            $row[]  = $no;
            $row[]  = @$slider;
            $row[]  = @$obj->title;
            $row[]  = @$obj->subtitle;
            $row[]  = @$obj->order_menu;
            $row[]  = @$obj->note;
            $row[]  = @$status;
            $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->slider->count_all_dt(),
            "recordsFiltered" => $this->slider->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ You can make function Here to make easy to Maintenace your code  ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}

#################################################################################### Cretated by Faizal Harwin ####################################################################################
####### *ALFIRA* ############################################################# Thank to My beloved wife and daughter ############################################################## *HAUARA* ######
################################################################################## Thank Your For Suporting Us ####################################################################################
####################################################################################################################################################################################################