<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    // Fetch users
    function getUsers()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->like('email', $this->input->get('q'));
        $this->db->limit(10);  
        $query = $this->db->get()->result_array();
        
        // Initialize Array with fetched data
        $data = array();
        foreach ($query as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['email']);
        }
        return $data;
    }
}

/* End of file Dashboard_Model.php */
