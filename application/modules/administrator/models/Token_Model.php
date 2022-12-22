
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Token_Model extends MY_Model
{
    var $table = 'users';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'US.photo','US.fullname','TO.name','US.email','US.token_reset_at','US.token_reset_by','US.status'); 
    var $column_search_export = array('US.photo','US.fullname','TO.name','US.email','US.token_reset_at','US.token_reset_by','US.status');
    var $column_order = array(null,null,'US.photo','US.fullname','TO.name','US.email','US.token_reset_at','US.token_reset_by','US.status'); 
    var $column_search = array('US.photo','US.fullname','TO.name','US.email','US.token_reset_at','US.token_reset_by','US.status');
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('US.id,US.uuid,US.photo,US.fullname,TO.name AS role_name,US.email,US.mytoken,US.token_reset_at,US.token_reset_by,US.status');
        }else {
            $this->db->select('US.id,US.uuid,US.photo,US.fullname,TO.name AS role_name,US.email,US.mytoken,US.token_reset_at,US.token_reset_by,US.status');
        }
        $this->db->from('users AS US');
        $this->db->join('roles AS  TO', 'TO.id = US.role_id', 'left');
        if ($this->session->userdata('___status') != '') {
            $this->db->where('US.status', $this->session->userdata('___status'));
        }
        if ($this->session->userdata('___created_by') != '') {
            $this->db->where('US.created_by', $this->session->userdata('___created_by'));
        }
        if ($this->session->userdata('___modified_by') != '') {
            $this->db->where('US.modified_by', $this->session->userdata('___modified_by'));
        }
        if ($this->session->userdata('___deleted_by') != '') {
            $this->db->where('US.deleted_by', $this->session->userdata('___deleted_by'));
        }
        if ($this->session->userdata('___restored_by') != '') {
            $this->db->where('US.restored_by', $this->session->userdata('___restored_by'));
        }

        if ($this->session->userdata('___recycle_bin') != '') {
            if ($this->session->userdata('___recycle_bin') == 2) {
                $this->db->where('US.is_restored', 2);
            } else {
                $this->db->where('US.is_deleted', 1);
            }
        } else {
            $this->db->where('US.is_deleted', 0);
        }

        if ($this->session->userdata('___created_start') != '' ||  $this->session->userdata('___created_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___created_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___created_end')));

            if ($start == $end) {
                $this->db->like('US.created_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('US.created_at >= ', $start . ' 00:00:00');
                $this->db->where('US.created_at < ', $end . ' 23:59:59');
            }
        }

        if ($this->session->userdata('___modified_start') != '' ||  $this->session->userdata('___modified_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___modified_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___modified_end')));

            if ($start == $end) {
                $this->db->like('US.modified_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('US.modified_at >= ', $start . ' 00:00:00');
                $this->db->where('US.modified_at <', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___deleted_start') != '' ||  $this->session->userdata('___deleted_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___deleted_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___deleted_end')));

            if ($start == $end) {
                $this->db->like('US.deleted_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('US.deleted_at >= ', $start . ' 00:00:00');
                $this->db->where('US.deleted_at < ', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___restored_start') != '' ||  $this->session->userdata('___restored_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___restored_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___restored_end')));

            if ($start == $end) {
                $this->db->like('US.restored_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('US.restored_at >= ', $start . ' 00:00:00');
                $this->db->where('US.restored_at < ', $end . ' 23:59:59');
            }
        }
        
        
        if($this->session->userdata('___fullname') != ''){
            $this->db->where('US.fullname', $this->session->userdata('___fullname'));
        }
        
        if($this->session->userdata('___username') != ''){
            $this->db->where('US.username', $this->session->userdata('___username'));
        }
        
        if($this->session->userdata('___role_id') != ''){
            $this->db->where('US.role_id', $this->session->userdata('___role_id'));
        }
        
        if($this->session->userdata('___email') != ''){
            $this->db->where('US.email', $this->session->userdata('___email'));
        }
        
        if ($this->session->userdata('___token_reset_at_start') != '' ||  $this->session->userdata('___token_reset_at_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___token_reset_at_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___token_reset_at_end')));

            if ($start == $end) {
                $this->db->like('US.token_reset_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('US.token_reset_at >= ', $start . ' 00:00:00');
                $this->db->where('US.token_reset_at <', $end . ' 23:59:59');
            }
        }
        if($this->session->userdata('___token_reset_by') != ''){
            $this->db->where('US.token_reset_by', $this->session->userdata('___token_reset_by'));
        }
        
        $i = 0;
        if(!empty($_POST['export'])){
            $this->data_search = $this->column_search_export;
            $this->data_order = $this->column_order_export;
        }else{
            $this->data_search = $this->column_search;
            $this->data_order = $this->column_order;
        }
        foreach ($this->data_search as $item) {
            if ($_POST['search']['value']) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->data_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->data_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('US.id', 'desc');
        }
    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    
    public function count_all_dt()
    {
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results();
    }
    
    
    public function get_filter_by_fullname() //3
    {
        $this->db->select('fullname');
        $this->db->like('fullname',  $this->input->get('term'), 'both');
        $this->db->order_by('fullname', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('users')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->fullname,
            ];
        }
        return $data;
    }
    public function get_filter_by_username() //3
    {
        $this->db->select('username');
        $this->db->like('username',  $this->input->get('term'), 'both');
        $this->db->order_by('username', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('users')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->username,
            ];
        }
        return $data;
    }
    public function get_filter_by_role_id() //1
    {
        $this->db->select('id,name');
        $this->db->from('roles');
        $this->db->like('name', $this->input->get('q'));
        $this->db->limit(10);  
        $query = $this->db->get()->result_array();
        // Initialize Array with fetched data
        $data = array();
        foreach ($query as $obj) {
            $data[] = array("id" => $obj['id'], "text" => $obj['name']);
        }
        return $data;
    } 
    public function get_filter_by_email() //3
    {
        $this->db->select('email');
        $this->db->like('email',  $this->input->get('term'), 'both');
        $this->db->order_by('email', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('users')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->email,
            ];
        }
        return $data;
    }
    public function get_filter_by_token_reset_by() //3
    {
        $this->db->select('token_reset_by');
        $this->db->like('token_reset_by',  $this->input->get('term'), 'both');
        $this->db->order_by('token_reset_by', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('users')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->token_reset_by,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
