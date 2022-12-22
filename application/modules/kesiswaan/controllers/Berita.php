
<?php

defined('BASEPATH') or exit('No direct script access allowed');


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------[  Aplication Name  ]    : CoreT                                                           
// -----------------[  Programmer       ]    : Faizal Harwin                                                
// -----------------[  Module           ]    : Kesiswaan                                               
// -----------------[  Type             ]    : Class                                                  
// -----------------[  Class name       ]    : Berita                                                     
// -----------------[  Description      ]    : Your description here                                       
// -----------------[  Author           ]    : Faizal Harwin, S.Kom                                         
// -----------------[  URL              ]    : https://themeforest.net/user/bale_nichi                   
// -----------------[  Support          ]    : faizalharwin@gmail.com                                     
// -----------------[  Copyright        ]    : Bale Nichi Team                                          
// -----------------[  Tempate usage    ]    : Remark Pro - V4                                           
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

class Berita extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_Model', 'berita', true);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('berita/filter', '', true),
        ];
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        $this->store_filter();
        if (check_permission(MENU)) {
            $response = [
                'title' => 'Berita',
                'html' => $this->load->view('berita/index', '', true),
            ];
            echo json_encode($response);
        }
    }

    
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Add New Berita',
                'html' => $this->load->view('berita/create', '', true),
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['berita'] = $this->berita->get_single('fr_berita', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Berita',
                'html'  => $this->load->view('berita/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['berita'] = $this->berita->get_single('fr_berita', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Berita',
                'html'  => $this->load->view('berita/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->berita->get_single('fr_berita', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Berita',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->berita->save('fr_berita', $data);
                $page = $this->load->view('berita/index', '', true);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'kesiswaan',
                            'module'    => 'berita',
                            'socket'    => 'kesiswaan_berita',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $page
                        ];
                    } else {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'kesiswaan',
                            'module'    => 'berita',
                            'socket'    => 'kesiswaan_berita',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|xss_clean');      
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
        $items[]    = 'id';
		$items[]    = 'title';
		$items[]    = 'kategori';
		$items[]    = 'content';
		$items[]    = 'note';
        $data = elements($items, $_POST);
        $data['slug'] = sanitize($this->input->post('title'));
        if($_FILES['thumbnail']['name']){
            $data['thumbnail'] = $this->_upload_thumbnail();
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->berita->get_single('fr_berita', array('id' => $obj));
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
                    $this->berita->update('fr_berita', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->berita->get_single('fr_berita', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->berita->delete('fr_berita', array('id' => $this->input->post('id')));
                } else {
                    $this->berita->update('fr_berita', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
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
                    $check_exist = $this->berita->get_single('fr_berita', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->berita->delete('fr_berita', array('id' => $id[$count]));
                    } else {
                        $this->berita->update('fr_berita', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
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
                    $this->berita->update('fr_berita', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'berita',
                    'socket'    => 'kesiswaan_berita',
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
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:15:05 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Upload Image file thumbnail ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function _upload_thumbnail() {
        $prev_thumbnail = $this->input->post('prev_thumbnail');
        $image = $_FILES['thumbnail']['name'];
        $image_type = $_FILES['thumbnail']['type'];
        $return_thumbnail = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' ||$image_type == 'image/jpg' || $image_type == 'image/png') {
                    $original = 'assets/backend/uploads/original/';
                    $thumbnail = 'assets/backend/uploads/thumbnail/';
                    $file_type = explode(".", $image);
                    $extension = strtolower($file_type[count($file_type) - 1]);
                    $filename = strtolower(str_replace(' ', '-', $file_type[0]));
                    $rename_thumbnail = time() . '-'. $filename .'.'.$extension;
                    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $original . $rename_thumbnail);

                    $this->load->library('image_lib');
                    // original
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_thumbnail;
                    $config['new_image']	= $original.$rename_thumbnail;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '1240';
                    $config['height'] = '699';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //this is the thumbnail images
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_thumbnail;
                    $config['new_image']	= $thumbnail.$rename_thumbnail;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '380';
                    $config['height'] = '214';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    // need to unlink previous image
                    if ($prev_thumbnail != "") {
                    if (file_exists($original . $prev_thumbnail)) {
                        @unlink($original . $prev_thumbnail);
                    }
                    if (file_exists($thumbnail . $prev_thumbnail)) {
                        @unlink($thumbnail . $prev_thumbnail);
                    }
                }
                $return_thumbnail = $rename_thumbnail;
            }
        } else {
            $return_thumbnail = $prev_thumbnail;
        }
        return $return_thumbnail;
    }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ Summernote content ]
    // ---------->>>>>>>>>>>>>>>>>>>>---------------[ 05 July, 2022 12:15:05 PM ]
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload_content()
    {
        $this->load->library('upload');
        if (isset($_FILES["content"]["name"])) {
            $config['upload_path'] = './assets/backend/uploads/images';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('content')) {
                $this->upload->display_errors();
                return false;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/backend/uploads/images/' . $data['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = true;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/backend/uploads/images/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $BASE_PROJECT = parse_url(base_url());
                echo $BASE_PROJECT['path'] . 'assets/backend/uploads/images/' . $data['file_name'];
            }
        }
    }

    public function delete_content()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------------------------------------------[ ALFIRA END] ----------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<-----------
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 05 July, 2022 12:15:05 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 05 July, 2022 12:15:05 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->berita->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $obj) {

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ checkbox ]
            $checkbox = '<div class="checkbox-custom checkbox-primary"><input type="checkbox"  class="checkbox" id="checkbox' . $obj->id . '" name="log[' . $obj->id . ']" value="' . $obj->id . '"> <label for="checkbox' . $obj->id . '"></label> </div>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ thumbnail ]
            if(!empty($obj->thumbnail)){
                @$thumbnail =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/'.@$obj->thumbnail.'" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'original/'.@$obj->thumbnail.'" width="50">
                </a>';
            }else{
                @$thumbnail =
                '<a class="image-popup-no-margins"  href="'.__UPLOAD.'thumbnail/no_image.png" target="_blank">
                    <img class="img-fluid" alt="" src="'.__UPLOAD.'thumbnail/no_image.png" width="50">
                </a>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Status ]
            $status =  @$obj->status == 1 ? '<button type="button" class="btn btn-sm btn-success waves-effect waves-classic">Active</button>' : '<button type="button" class="btn btn-sm btn-danger waves-effect waves-classic">Not Active</button>';

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button show ]
            if (has_permission(VIEW, 'kesiswaan', 'berita')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="kesiswaan/berita/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button edit ]
            if (has_permission(VIEW, 'kesiswaan', 'berita')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="kesiswaan/berita/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button destroy ]
            if (has_permission(VIEW, 'kesiswaan', 'berita')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="kesiswaan/berita/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            $row[]  = $checkbox;
            $row[]  = $no;
            $row[]  = @$thumbnail;
            $row[]  = @$obj->title;
            $row[]  = @$obj->slug;
            $row[]  = @$obj->fr_kategori_berita;
            $row[]  = @$obj->note;
            $row[]  = @$status;
            $row[]  = @$button_show." ".@$button_edit." ".@$button_destroy;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->berita->count_all_dt(),
            "recordsFiltered" => $this->berita->count_filtered(),
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