
<?php

defined('BASEPATH') or exit('No direct script access allowed');


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------[  Aplication Name  ]    : CoreT                                                           
// -----------------[  Programmer       ]    : Faizal Harwin                                                
// -----------------[  Module           ]    : Frontend                                               
// -----------------[  Type             ]    : Class                                                  
// -----------------[  Class name       ]    : Guru                                                     
// -----------------[  Description      ]    : Your description here                                       
// -----------------[  Author           ]    : Faizal Harwin, S.Kom                                         
// -----------------[  URL              ]    : https://themeforest.net/user/bale_nichi                   
// -----------------[  Support          ]    : faizalharwin@gmail.com                                     
// -----------------[  Copyright        ]    : Bale Nichi Team                                          
// -----------------[  Tempate usage    ]    : Remark Pro - V4                                           
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

class Guru extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_Model', 'guru', true);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('guru/filter', '', true),
        ];
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        $this->store_filter();
        if (check_permission(MENU)) {
            $response = [
                'title' => 'Guru',
                'html' => $this->load->view('guru/index', '', true),
            ];
            echo json_encode($response);
        }
    }

    
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Add New Guru',
                'html' => $this->load->view('guru/create', '', true),
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['guru'] = $this->guru->get_single('fr_guru', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Guru',
                'html'  => $this->load->view('guru/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['guru'] = $this->guru->get_single('fr_guru', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Guru',
                'html'  => $this->load->view('guru/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->guru->get_single('fr_guru', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Guru',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->guru->save('fr_guru', $data);
                $page = $this->load->view('guru/index', '', true);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'frontend',
                            'module'    => 'guru',
                            'socket'    => 'frontend_guru',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $page
                        ];
                    } else {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'frontend',
                            'module'    => 'guru',
                            'socket'    => 'frontend_guru',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
        $this->form_validation->set_rules('foto', 'Foto', 'trim|xss_clean');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|xss_clean');
        $this->form_validation->set_rules('bidang_ilmu', 'Bidang ilmu', 'trim|xss_clean');      
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
        $items[]    = 'id';
		$items[]    = 'nama';
		$items[]    = 'bidang_ilmu';
		$items[]    = 'note';
        $data = elements($items, $_POST);
        if($_FILES['foto']['name']){
            $data['foto'] = $this->_upload_foto();
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->guru->get_single('fr_guru', array('id' => $obj));
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
                    $this->guru->update('fr_guru', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->guru->get_single('fr_guru', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->guru->delete('fr_guru', array('id' => $this->input->post('id')));
                } else {
                    $this->guru->update('fr_guru', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
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
                    $check_exist = $this->guru->get_single('fr_guru', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->guru->delete('fr_guru', array('id' => $id[$count]));
                    } else {
                        $this->guru->update('fr_guru', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
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
                    $this->guru->update('fr_guru', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'frontend',
                    'module'    => 'guru',
                    'socket'    => 'frontend_guru',
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
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:14:48 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Upload Image file foto ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function _upload_foto() {
        $prev_foto = $this->input->post('prev_foto');
        $image = $_FILES['foto']['name'];
        $image_type = $_FILES['foto']['type'];
        $return_foto = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' ||$image_type == 'image/jpg' || $image_type == 'image/png') {
                    $original = 'assets/backend/uploads/original/';
                    $thumbnail = 'assets/backend/uploads/thumbnail/';
                    $file_type = explode(".", $image);
                    $extension = strtolower($file_type[count($file_type) - 1]);
                    $filename = strtolower(str_replace(' ', '-', $file_type[0]));
                    $rename_foto = time() . '-'. $filename .'.'.$extension;
                    move_uploaded_file($_FILES['foto']['tmp_name'], $original . $rename_foto);

                    $this->load->library('image_lib');
                    // original
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_foto;
                    $config['new_image']	= $original.$rename_foto;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '288';
                    $config['height'] = '288';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //this is the thumbnail images
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_foto;
                    $config['new_image']	= $thumbnail.$rename_foto;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '288';
                    $config['height'] = '288';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    // need to unlink previous image
                    if ($prev_foto != "") {
                    if (file_exists($original . $prev_foto)) {
                        @unlink($original . $prev_foto);
                    }
                    if (file_exists($thumbnail . $prev_foto)) {
                        @unlink($thumbnail . $prev_foto);
                    }
                }
                $return_foto = $rename_foto;
            }
        } else {
            $return_foto = $prev_foto;
        }
        return $return_foto;
    }


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------------------------------------------[ ALFIRA END] ----------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<-----------
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:14:48 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:14:48 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->guru->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ checkbox ]
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ foto ]
            if(!empty($obj->foto)){
                @$foto =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/'.@$obj->foto.'" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'original/'.@$obj->foto.'" width="50">
                </a>';
            }else{
                @$foto =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/no_image.png" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'thumbnail/no_image.png" width="50">
                </a>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Status ]
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button show ]
            if (has_permission(VIEW, 'frontend', 'guru')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="frontend/guru/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button edit ]
            if (has_permission(VIEW, 'frontend', 'guru')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="frontend/guru/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button destroy ]
            if (has_permission(VIEW, 'frontend', 'guru')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="frontend/guru/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            $row[]  = $checkbox;
            $row[]  = $no;
            $row[]  = @$foto;
            $row[]  = @$obj->nama;
            $row[]  = @$obj->bidang_ilmu;
            $row[]  = @$obj->note;
            $row[]  = @$status;
            $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_all_dt(),
            "recordsFiltered" => $this->guru->count_filtered(),
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