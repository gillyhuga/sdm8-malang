
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Role_Model extends MY_Model
{
    var $table = 'roles';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'name','slug','is_default','is_superadmin','note','status'); 
    var $column_search_export = array('name','slug','is_default','is_superadmin','note','status');
    var $column_order = array(null,null,'name','slug','is_default','is_superadmin','note','status'); 
    var $column_search = array('name','slug','is_default','is_superadmin','note','status');
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('id,name,slug,is_default,is_superadmin,note,status');
        }else {
            $this->db->select('id,name,slug,is_default,is_superadmin,note,status');
        }
        $this->db->from('roles');
        if ($this->session->userdata('___status') != '') {
            $this->db->where('status', $this->session->userdata('___status'));
        }
        if ($this->session->userdata('___created_by') != '') {
            $this->db->where('created_by', $this->session->userdata('___created_by'));
        }
        if ($this->session->userdata('___modified_by') != '') {
            $this->db->where('modified_by', $this->session->userdata('___modified_by'));
        }
        if ($this->session->userdata('___deleted_by') != '') {
            $this->db->where('deleted_by', $this->session->userdata('___deleted_by'));
        }
        if ($this->session->userdata('___restored_by') != '') {
            $this->db->where('restored_by', $this->session->userdata('___restored_by'));
        }

        if ($this->session->userdata('___recycle_bin') != '') {
            if ($this->session->userdata('___recycle_bin') == 2) {
                $this->db->where('is_restored', 2);
            } else {
                $this->db->where('is_deleted', 1);
            }
        } else {
            $this->db->where('is_deleted', 0);
        }

        if ($this->session->userdata('___created_start') != '' ||  $this->session->userdata('___created_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___created_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___created_end')));

            if ($start == $end) {
                $this->db->like('created_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('created_at >= ', $start . ' 00:00:00');
                $this->db->where('created_at < ', $end . ' 23:59:59');
            }
        }

        if ($this->session->userdata('___modified_start') != '' ||  $this->session->userdata('___modified_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___modified_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___modified_end')));

            if ($start == $end) {
                $this->db->like('modified_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('modified_at >= ', $start . ' 00:00:00');
                $this->db->where('modified_at <', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___deleted_start') != '' ||  $this->session->userdata('___deleted_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___deleted_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___deleted_end')));

            if ($start == $end) {
                $this->db->like('deleted_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('deleted_at >= ', $start . ' 00:00:00');
                $this->db->where('deleted_at < ', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___restored_start') != '' ||  $this->session->userdata('___restored_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___restored_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___restored_end')));

            if ($start == $end) {
                $this->db->like('restored_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('restored_at >= ', $start . ' 00:00:00');
                $this->db->where('restored_at < ', $end . ' 23:59:59');
            }
        }
        
        
        if($this->session->userdata('___name') != ''){
            $this->db->where('name', $this->session->userdata('___name'));
        }
        
        if($this->session->userdata('___is_default') != ''){
            $this->db->where('is_default', $this->session->userdata('___is_default'));
        }
        
        if($this->session->userdata('___is_superadmin') != ''){
            $this->db->where('is_superadmin', $this->session->userdata('___is_superadmin'));
        }
        
        if($this->session->userdata('___note') != ''){
            $this->db->where('note', $this->session->userdata('___note'));
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
                $this->db->order_by('id', 'asc');
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
    
    
    function duplicate_check_name(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('name', $this->input->post('name'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('roles')->num_rows();            
    }
    
    
    public function get_filter_by_name() //3
    {
        $this->db->select('name');
        $this->db->like('name',  $this->input->get('term'), 'both');
        $this->db->order_by('name', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('roles')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->name,
            ];
        }
        return $data;
    }
    public function get_filter_by_note() //3
    {
        $this->db->select('note');
        $this->db->like('note',  $this->input->get('term'), 'both');
        $this->db->order_by('note', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('roles')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->note,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
