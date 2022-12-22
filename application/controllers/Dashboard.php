<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_Model', 'dashboard', TRUE);
    }


    public function index()
    {
        $this->load->view('layout/default');
    }

    public function menu_search()
    {
        $response = [
            'status' => 'success',
            'title' => 'Quick menu',
            'html' => $this->load->view('layout/menu', '', true),
        ];
        echo json_encode($response);
    }


    public function switch()
    {
        if($this->input->post('menu') == 'default'){
            $this->session->unset_userdata('___switch');
        }else{
            $this->session->set_userdata('___switch', $this->input->post('menu'));
        }
        $response = [
            'status'    => 200,
            'title' => 'Dashboard',
            'message' => 'Switch Menu to ' . $this->input->post('menu') . ' successfully'
        ]; 
        echo json_encode($response);
    }

    public function home()
    {
        if ($this->session->userdata('class')) {
            $this->path = $this->session->userdata('module') . '/' . $this->session->userdata('class') . '/index';
            $response = [
                'status' => 'success',
                'title' => 'Dashboard',
                'html' => $this->load->view($this->path, '', true),
            ];
        } else {
            $this->path = 'dashboard/index';
            $response = [
                'status' => 'success',
                'title' => 'Dashboard',
                'html' => $this->load->view($this->path, '', true),
            ];
        }
        echo json_encode($response);
    }

    public function filter()
    {
        $response = [
            'status' => 'success',
            'title' => 'Advance Filter',
            'html' => $this->load->view('layout/filter', '', true),
        ]; 
        echo json_encode($response);
    }

    public function get_user()
    {
        // Search term
        $response = $this->dashboard->getUsers();
        echo json_encode($response);
    }
}

/* End of file Dashboard.php */
