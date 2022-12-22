
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Module_Model extends MY_Model
{
    var $table = 'modules';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'module_name','module_slug','module_icon','module_order','note','status'); 
    var $column_search_export = array('module_name','module_slug','module_icon','module_order','note','status');
    var $column_order = array(null,null,'module_name','module_slug','module_icon','module_order','note','status'); 
    var $column_search = array('module_name','module_slug','module_icon','module_order','note','status');
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('id,module_name,module_slug,module_icon,module_order,note,status');
        }else {
            $this->db->select('id,module_name,module_slug,module_icon,module_order,note,status');
        }
        $this->db->from('modules');
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
        
        
        if($this->session->userdata('___module_name') != ''){
            $this->db->where('module_name', $this->session->userdata('___module_name'));
        }
        
        if($this->session->userdata('___module_slug') != ''){
            $this->db->where('module_slug', $this->session->userdata('___module_slug'));
        }
        
        if($this->session->userdata('___module_icon') != ''){
            $this->db->where('module_icon', $this->session->userdata('___module_icon'));
        }
        
        if($this->session->userdata('___module_order') != ''){
            $this->db->where('module_order', $this->session->userdata('___module_order'));
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
                $this->db->order_by('module_order', 'asc');
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
    
    
    function duplicate_check_module_name(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('module_name', $this->input->post('module_name'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('modules')->num_rows();            
    }
    
    
    function duplicate_check_module_slug(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('module_slug', $this->input->post('module_slug'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('modules')->num_rows();            
    }
    
    
    function duplicate_check_module_order(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('module_order', $this->input->post('module_order'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('modules')->num_rows();            
    }
    
    
    public function get_filter_by_module_name() //3
    {
        $this->db->select('module_name');
        $this->db->like('module_name',  $this->input->get('term'), 'both');
        $this->db->order_by('module_name', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('modules')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->module_name,
            ];
        }
        return $data;
    }
    public function get_filter_by_module_slug() //3
    {
        $this->db->select('module_slug');
        $this->db->like('module_slug',  $this->input->get('term'), 'both');
        $this->db->order_by('module_slug', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('modules')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->module_slug,
            ];
        }
        return $data;
    }
    public function get_filter_by_module_icon() //3
    {
        $this->db->select('module_icon');
        $this->db->like('module_icon',  $this->input->get('term'), 'both');
        $this->db->order_by('module_icon', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('modules')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->module_icon,
            ];
        }
        return $data;
    }
    public function get_filter_by_module_order() //3
    {
        $this->db->select('module_order');
        $this->db->like('module_order',  $this->input->get('term'), 'both');
        $this->db->order_by('module_order', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('modules')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->module_order,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
