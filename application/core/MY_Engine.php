<?php


defined('BASEPATH') or exit('No direct script access allowed');

class MY_Engine extends MY_Controller
{

   
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function mydata($destination = false)
    {
        if (!empty($destination)) {
            $project = $this->db->get_where('projects', array('url' => $destination))->row();
        } else {
            $project = $this->db->get_where('projects', array('id' => $this->input->post('project')))->row();
        }

        $database = $project->db_name;
        $db_params = $this->load->database($database, true);
        $list_fields = $db_params->list_fields($this->input->post('table_name'));

        $root = $_SERVER["DOCUMENT_ROOT"];
        $this->path = strtolower($root . '/' . $project->url);
        if (!file_exists($this->path)) {
            $uold = umask(0);
            mkdir($this->path, 0777, true);
            umask($uold);
        }

        $database = $project->db_name;
        $db_params = $this->load->database($database, true);

        if (empty($_POST['new_module'])) {
            $xmodule = $_POST['module'];
            $id_module = $db_params->get_where('modules', array('module_slug' => $_POST['module']))->row();
            $fields = $db_params->get_where('operations', array('id_module' => $id_module->id))->result();
        } else {
            $xmodule = $_POST['new_module'];
        }

        if (!empty($fields)) {
            foreach ($fields as $obj) {
                $quick_link[] = $obj;
            }
        } else {
            $quick_link = '';
        }

        if(!empty($_POST['uuid'])){
            $uuid = 'uuid';
        }else{
            $uuid ='id';
        }


        foreach ($list_fields as $key => $obj) {
            $filter =['id','uuid'];
            if(@in_array($obj, $filter)) continue;
            if(@in_array($obj, $_POST['image'])) continue;
            $autofocus = $obj; break;
        }
        // verify folder module exist or not
        $this->dir = $this->path . '/application/modules/' . $xmodule;
        if (!empty($_POST['restful_api']) != 'no_api') {
            if (!file_exists($this->dir)) {
                $uold = umask(0);
                mkdir($this->dir . "/controllers/", 0777, true);
                mkdir($this->dir . "/models/", 0777, true);
                mkdir($this->dir . "/views/", 0777, true);
                umask($uold);
            }
        } else {
            if (!file_exists($this->dir)) {
                $uold = umask(0);
                mkdir($this->dir . "/controllers/", 0777, true);
                mkdir($this->dir . "/models/", 0777, true);
                mkdir($this->dir . "/views/", 0777, true);
                umask($uold);
            }
        }

        if (!file_exists($this->dir . '/views/' . strtolower($_POST['controller']))) {
            mkdir($this->dir . '/views/' . strtolower($_POST['controller']), 0777, true);
        }
        $controller = safe($this->input->post('controller'));
        $model = safe($this->input->post('model'));
        $create_controller = $this->dir . '/controllers/' . ucfirst($controller) . '.php';
        $create_model       = $this->dir . '/models/' . $model . '.php';
        $create_index       = $this->dir . '/views/' . strtolower($controller) . '/index.php';
        $create_indexe      = $this->dir . '/views/' . strtolower($controller) . '/indexe.php';
        $create_add         = $this->dir . '/views/' . strtolower($controller) . '/create.php';
        $create_edit        = $this->dir . '/views/' . strtolower($controller) . '/edit.php';
        $create_show        = $this->dir . '/views/' . strtolower($controller) . '/show.php';
        $create_import      = $this->dir . '/views/' . strtolower($controller) . '/import.php';
        $create_export      = $this->dir . '/views/' . strtolower($controller) . '/export.php';
        $create_filter      = $this->dir . '/views/' . strtolower($controller) . '/filter.php';

            // =============================================================================================================================== OpenSSl Encryption
            $simple_string = $this->input->post('table_name');
            $ciphering = "AES-128-CTR";
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "ZRi5FLRFEoDgBDdFs385N4RquRGtFK5S";
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
            // echo "Decrypted String: " . $encryption; die;
    
            // =============================================================================================================================== OpenSSl decrypted
            // Non-NULL Initialization Vector for decryption
            $decryption_iv = '1234567891011121';
            // Store the decryption key
            $decryption_key = "ZRi5FLRFEoDgBDdFs385N4RquRGtFK5S";
            // Use openssl_decrypt() function to decrypt the data
            $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);


        // check exist file in folder
        if (empty($_POST['can_create'])) {
            if (file_exists($create_add)) {
                unlink($create_add);
            }
        }

        if (empty($_POST['can_show'])) {
            if (file_exists($create_show)) {
                unlink($create_show);
            }
        }
        if (empty($_POST['can_update'])) {
            if (file_exists($create_edit)) {
                unlink($create_edit);
            }
        }
        if (empty($_POST['import'])) {
            if (file_exists($create_import)) {
                unlink($create_import);
            }
        }

        if (empty($_POST['export'])) {
            if (file_exists($create_export)) {
                unlink($create_export);
            }
        }

        $module = $xmodule;
        $controller = $_POST['controller'];
        $model = $_POST['model'];
        $table = $_POST['table_name'];
        $mymodel = strtolower(str_replace('_Model', '', $_POST['model']));
        $mytitle = ucwords(str_replace('_', ' ', $controller));
        if (!empty($_POST['uuid'])) {
            $myid = 'uuid';
        } else {
            $myid = 'id';
        }
        if ($_POST['image_resize']) {
            $original = explode('x', $_POST['image_resize']);
            $originalx = $original[0];
            $originaly = $original[1];
        } else {
            $originalx = '';
            $originaly = '';
        }
        if ($_POST['image_thumbnail']) {
            $thumbnail = explode('x', $_POST['image_thumbnail']);
            $thumbnailx = $thumbnail[0];
            $thumbnaily = $thumbnail[1];
        } else {
            $thumbnailx = '250';
            $thumbnaily = '250';
        }
        
        $data = [
            'path'                  => $this->path,
            'list_fields'           => $list_fields,
            'create_controller'     => $create_controller,
            'create_model'          => $create_model,
            'create_index'          => $create_index,
            'create_indexe'         => $create_indexe,
            'create_add'            => $create_add,
            'create_edit'           => $create_edit,
            'create_show'           => $create_show,
            'create_import'         => $create_import,
            'create_export'         => $create_export,
            'create_filter'         => $create_filter,
            'module'                => $module,
            'controller'            => $controller,
            'mytitle'               => $mytitle,
            'mycontroller'          => strtolower($controller),
            'model'                 => $model,
            'mymodel'               => $mymodel,
            'table'                 => $table,
            'image_thumbnail'       => [$thumbnailx, $thumbnaily],
            'image_resize'           => [$originalx, $originaly],
            'autofocus'             => $autofocus,
            'quick_link'            => $quick_link,
            'uuid'                  => $uuid,
            'filestore'             => $encryption
        ];
        return $data;
    }
}

/* End of file MY_Engine.php */
