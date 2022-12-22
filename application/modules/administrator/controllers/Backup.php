<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Backup extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_Model', 'backup', true);
    }

    public function index()
    {
        $this->destroy_session_filter();
        if (check_permission(MENU)) {
                $response = [
                    'title' => 'Backup Database',
                    'html' => $this->load->view('backup/index', '', true),
                ];
            echo json_encode($response);
        }
    }

    public function post()
    {
        if (IS_LIVE == true) {
            $this->backup->account_logs($this->session->userdata('uuid'));
            $this->load->dbutil();
            $conf = array(
                'format' => 'zip',
                'filename' => 'database-backup.sql',
            );
            $backup = $this->dbutil->backup($conf);
            $this->load->helper('download');
            force_download('database-backup.zip', $backup);
            create_log('Has been taken database backup');
        }
    }
}

/* End of file Backup.php */
