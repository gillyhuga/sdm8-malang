
<?php

defined('BASEPATH') or exit('No direct script access allowed');


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------[  Aplication Name  ]    : CoreT                                                           
// -----------------[  Programmer       ]    : Faizal Harwin                                                
// -----------------[  Module           ]    : Kesiswaan                                               
// -----------------[  Type             ]    : Class                                                  
// -----------------[  Class name       ]    : Galeri                                                     
// -----------------[  Description      ]    : Your description here                                       
// -----------------[  Author           ]    : Faizal Harwin, S.Kom                                         
// -----------------[  URL              ]    : https://themeforest.net/user/bale_nichi                   
// -----------------[  Support          ]    : faizalharwin@gmail.com                                     
// -----------------[  Copyright        ]    : Bale Nichi Team                                          
// -----------------[  Tempate usage    ]    : Remark Pro - V4                                           
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

class Galeri extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Galeri_Model', 'galeri', true);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get form filter ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function filter()
    {
        $response = [
            'title' => 'Filter Data',
            'html' => $this->load->view('galeri/filter', '', true),
        ];
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save filter2 data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy_session_filter2()
    {
        $this->session->set_userdata('___kategori');
        $this->session->set_userdata('___deskripsi');
        $this->session->set_userdata('___tanggal');
        $this->session->set_userdata('___note');
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save filter data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store_filter()
    {
        $this->save_session_filter();

        if($this->input->post('___kategori') != ''){
            $this->session->set_userdata('___kategori', $this->input->post('___kategori'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___kategori');
            }
        }

        if($this->input->post('___deskripsi') != ''){
            $this->session->set_userdata('___deskripsi', $this->input->post('___deskripsi'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___deskripsi');
            }
        }
        
        //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ date tanggal ]
        if($this->input->post('___start_tanggal') != ''){
            $this->session->set_userdata('___start_tanggal', $this->input->post('___start_tanggal'));
            $this->session->set_userdata('___end_tanggal', $this->input->post('___end_tanggal'));
        }else{
            if($this->input->post('ss_filter') == 2){
                $this->session->unset_userdata('___start_tanggal');
                $this->session->unset_userdata('___end_tanggal');
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


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ index data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $this->destroy_session_filter();
        $this->destroy_session_filter2();
        $this->store_filter();
        if (check_permission(MENU)) {
            if ($this->input->post('export')) {
                $response = [
                    'title' => 'Galeri',
                    'html' => $this->load->view('galeri/export', '', true),
                ];
            } else {
                $response = [
                    'title' => 'Galeri',
                    'html' => $this->load->view('galeri/index', '', true),
                ];
            }
            echo json_encode($response);
        }
    }

    
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get create form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Add New Galeri',
                'html' => $this->load->view('galeri/create', '', true),
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get edit form ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        if (check_permission(EDIT)) {
            $this->data['galeri'] = $this->galeri->get_single('fr_galleri', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Edit Galeri',
                'html'  => $this->load->view('galeri/edit', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show()
    {
        if (check_permission(VIEW)) {
            $this->data['galeri'] = $this->galeri->get_single('fr_galleri', array('id' => $this->input->post('id')));
            $response = [
                'title' => 'Show Galeri',
                'html'  => $this->load->view('galeri/show', $this->data, true)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show activitylog data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function activitylog()
    {
        if (is_admin()) {
            $this->data['log'] = $this->galeri->get_single('fr_galleri', array('id' => $this->input->post('id')));
            $response = [
                'title'         =>  'Activitylog Galeri',
                'html'          => $this->load->view('layout/activitylog', $this->data, TRUE)
            ];
            echo json_encode($response);
        }
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ store data to database ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store()
    {
        if (check_csrf()) {
            $this->___check_data_validation();
            if ($this->form_validation->run() == false) {
                $response = [
                    'status' => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'not_valid',
                    'message' => $this->form_validation->error_array(),
                ];
            } else {
                $data = $this->___get_posted_data();
                $process = $this->galeri->save('fr_galleri', $data);
                $page = $this->load->view('galeri/index', '', true);
                if ($process) {
                    if ($data['id']) {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'kesiswaan',
                            'module'    => 'galeri',
                            'socket'    => 'kesiswaan_galeri',
                            'action'    => 'edit',
                            'user'      => $this->session->userdata('fullname'),
                            'message'   => 'Your data has been updated',
                            'html'      => $page
                        ];
                    } else {
                        $response = [
                            'status'    =>  200,
                            'modular'   => 'kesiswaan',
                            'module'    => 'galeri',
                            'socket'    => 'kesiswaan_galeri',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function ___check_data_validation()
    {
        $this->form_validation->set_rules('foto', 'Foto', 'trim|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|xss_clean');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|xss_clean');      
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get posted data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function ___get_posted_data()
    {
        $items[]    = 'id';
		$items[]    = 'kategori';
		$items[]    = 'deskripsi';
		$items[]    = 'note';
        $data = elements($items, $_POST);
        $data['tanggal'] = date('Y-m-d', strtotime($this->input->post('tanggal')));
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function status()
    {
        if (check_permission(EDIT)) {
            if ($this->input->post('data_arr')) {
                $data_arr = $this->input->post('data_arr');
                foreach ($data_arr as $obj) {
                    $check_exist = $this->galeri->get_single('fr_galleri', array('id' => $obj));
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
                    $this->galeri->update('fr_galleri', $data, array('id' => $obj));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'status',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Status data has been changed',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy()
    {
        if (check_permission(DELETE)) {
            $check_exist = $this->galeri->get_single('fr_galleri', array('id' => $this->input->post('id')));
            if ($check_exist) {
                $data = [
                    'is_deleted'    => 1,
                    'status'        => 0,
                    'deleted_at'    => date('Y-m-d H:i:s'),
                    'deleted_by'    => logged_in_user_id(),
                ];
                if ($check_exist->is_deleted) {
                    $this->galeri->delete('fr_galleri', array('id' => $this->input->post('id')));
                } else {
                    $this->galeri->update('fr_galleri', $data, array('id' => $this->input->post('id')));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
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
                    $check_exist = $this->galeri->get_single('fr_galleri', array('id' => $id[$count]))->is_deleted;
                    if ($check_exist) {
                        $this->galeri->delete('fr_galleri', array('id' => $id[$count]));
                    } else {
                        $this->galeri->update('fr_galleri', $data, array('id' => $id[$count]));
                    }
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'delete',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been deleted',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
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
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
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
                    $this->galeri->update('fr_galleri', $data, array('id' => $id[$count]));
                }
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'restore',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Your data has been restored',
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
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
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 04 August, 2022 12:59:23 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function import()
    {
        if (check_permission(ADD)) {
            $response = [
                'title' => 'Import Tanggal',
                'html'  => $this->load->view('galeri/import', '', true)
            ];
            echo json_encode($response);
        }
    }


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ upload data ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function upload()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    @$kategori = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    @$deskripsi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    @$tanggal = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $data[] = array(
                        'kategori' => @$kategori,
                        'deskripsi' => @$deskripsi,
                        'tanggal' => @$tanggal,
                        'status'        => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => logged_in_user_id(),
                    );
                }
            }
            
            $insert = $this->db->insert_batch('fr_galleri', $data);
            if ($insert) {
                $response = [
                    'status'    => 200,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'import',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Import data Tanggal has been success',
                    'html'      => $this->load->view('galeri/index', '', true)
                ];
            } else {
                $response = [
                    'status'    => 403,
                    'modular'   => 'kesiswaan',
                    'module'    => 'galeri',
                    'socket'    => 'kesiswaan_galeri',
                    'action'    => 'not_valid',
                    'user'      => $this->session->userdata('fullname'),
                    'message'   => 'Change status FAILED, Please try again',
                    'html'      => $this->load->view('galeri/index', '', true)
                ];
            }
            echo json_encode($response);
        }
    }
    

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Upload Image file foto ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM]
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
                    $config['width'] = '520';
                    $config['height'] = '520';
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //this is the thumbnail images
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $original.$rename_foto;
                    $config['new_image']	= $thumbnail.$rename_foto;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '260';
                    $config['height'] = '260';
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


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ autocomplete natural deskripsi  ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_deskripsi()
    {
        $response = $this->galeri->get_deskripsi();
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ autocomplete natural note  ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_note()
    {
        $response = $this->galeri->get_note();
        echo json_encode($response);
    }


    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ autocomplete natural kategori  ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM]
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_kategori()
    {
        $response = $this->galeri->get_kategori();
        echo json_encode($response);
    }


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>---------------------------------------------------[ ALFIRA END] ----------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<-----------
    // ---------->>>>>>>>>>>>>>>>>>>>------------------------------------------[ 04 August, 2022 12:59:23 PM ]--------------------------------------------------------<<<<<<<<<<<<<<<<<<<<<<<------------
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ data_json ]
    // ---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ 04 August, 2022 12:59:23 PM ]
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function data_json()
    {
        $list = $this->galeri->get_datatables();
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
            if (has_permission(VIEW, 'kesiswaan', 'galeri')) {
            $button_show =
            '<button id="button_show" data-id="' . $obj->id . '" data-url="kesiswaan/galeri/show"  type="button" class="btn btn-icon btn-outline-info waves-effect waves-classic">
                <i class="icon md-eye" aria-hidden="true"></i>
            </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button edit ]
            if (has_permission(VIEW, 'kesiswaan', 'galeri')) {
                $button_edit =
                '<button id="button_edit" data-id="' . $obj->id . '" data-url="kesiswaan/galeri/edit"  type="button" class="btn btn-icon btn-outline-success waves-effect waves-classic">
                    <i class="icon md-edit" aria-hidden="true"></i>
                </button>';
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button destroy ]
            if (has_permission(VIEW, 'kesiswaan', 'galeri')) {
                $button_destroy ='
                <button id="button_destroy" data-id="' . $obj->id . '" data-url="kesiswaan/galeri/destroy"  type="button" class="btn btn-icon btn-outline-danger waves-effect waves-classic">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>';
            }
            $no++;
            $row = array();
            if(!empty($_POST['export'])){
                $row[]  = $no;
                $row[]  = @$obj->nkategori;
                $row[]  = @$obj->deskripsi;
                $row[]  = @__date($obj->tanggal);
                $row[]  = @$obj->note;
                $row[] = @$status;
            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ EXPORT ELSE ]
            }else {
                $row[]  = $checkbox;
                $row[]  = $no;
                $row[]  = @$foto;
                $row[]  = @$obj->nkategori;
                $row[]  = @$obj->deskripsi;
                $row[]  = @__date($obj->tanggal);
                $row[]  = @$obj->note;
                $row[] = @$status;
                $row[] = @$button_show." ".@$button_edit." ".@$button_destroy;
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->galeri->count_all_dt(),
            "recordsFiltered" => $this->galeri->count_filtered(),
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