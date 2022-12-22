
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Operation_Model extends MY_Model
{
    var $table = 'operations';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'NE.module_name','OP.operation_name','OP.operation_slug','OP.order_menu','OP.is_menu_vissible','OP.is_view_vissible','OP.is_add_vissible','OP.is_edit_vissible','OP.is_delete_vissible','OP.status'); 
    var $column_search_export = array('NE.module_name','OP.operation_name','OP.operation_slug','OP.order_menu','OP.is_menu_vissible','OP.is_view_vissible','OP.is_add_vissible','OP.is_edit_vissible','OP.is_delete_vissible','OP.status');
    var $column_order = array(null,null,'NE.module_name','OP.operation_name','OP.operation_slug','OP.order_menu','OP.is_menu_vissible','OP.is_view_vissible','OP.is_add_vissible','OP.is_edit_vissible','OP.is_delete_vissible','OP.status'); 
    var $column_search = array('NE.module_name','OP.operation_name','OP.operation_slug','OP.order_menu','OP.is_menu_vissible','OP.is_view_vissible','OP.is_add_vissible','OP.is_edit_vissible','OP.is_delete_vissible','OP.status');
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('OP.id,NE.module_name AS module,OP.operation_name,OP.operation_slug,OP.order_menu,OP.is_menu_vissible,OP.is_view_vissible,OP.is_add_vissible,OP.is_edit_vissible,OP.is_delete_vissible,OP.status');
        }else {
            $this->db->select('OP.id,NE.module_name AS module,OP.operation_name,OP.operation_slug,OP.order_menu,OP.is_menu_vissible,OP.is_view_vissible,OP.is_add_vissible,OP.is_edit_vissible,OP.is_delete_vissible,OP.status');
        }
        $this->db->from('operations AS OP');
        $this->db->join('modules AS  NE', 'NE.id = OP.id_module', 'left');
        if ($this->session->userdata('___status') != '') {
            $this->db->where('OP.status', $this->session->userdata('___status'));
        }
        if ($this->session->userdata('___created_by') != '') {
            $this->db->where('OP.created_by', $this->session->userdata('___created_by'));
        }
        if ($this->session->userdata('___modified_by') != '') {
            $this->db->where('OP.modified_by', $this->session->userdata('___modified_by'));
        }
        if ($this->session->userdata('___deleted_by') != '') {
            $this->db->where('OP.deleted_by', $this->session->userdata('___deleted_by'));
        }
        if ($this->session->userdata('___restored_by') != '') {
            $this->db->where('OP.restored_by', $this->session->userdata('___restored_by'));
        }

        if ($this->session->userdata('___recycle_bin') != '') {
            if ($this->session->userdata('___recycle_bin') == 2) {
                $this->db->where('OP.is_restored', 2);
            } else {
                $this->db->where('OP.is_deleted', 1);
            }
        } else {
            $this->db->where('OP.is_deleted', 0);
        }

        if ($this->session->userdata('___created_start') != '' ||  $this->session->userdata('___created_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___created_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___created_end')));

            if ($start == $end) {
                $this->db->like('OP.created_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('OP.created_at >= ', $start . ' 00:00:00');
                $this->db->where('OP.created_at < ', $end . ' 23:59:59');
            }
        }

        if ($this->session->userdata('___modified_start') != '' ||  $this->session->userdata('___modified_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___modified_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___modified_end')));

            if ($start == $end) {
                $this->db->like('OP.modified_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('OP.modified_at >= ', $start . ' 00:00:00');
                $this->db->where('OP.modified_at <', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___deleted_start') != '' ||  $this->session->userdata('___deleted_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___deleted_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___deleted_end')));

            if ($start == $end) {
                $this->db->like('OP.deleted_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('OP.deleted_at >= ', $start . ' 00:00:00');
                $this->db->where('OP.deleted_at < ', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___restored_start') != '' ||  $this->session->userdata('___restored_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___restored_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___restored_end')));

            if ($start == $end) {
                $this->db->like('OP.restored_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('OP.restored_at >= ', $start . ' 00:00:00');
                $this->db->where('OP.restored_at < ', $end . ' 23:59:59');
            }
        }
        
        
        if($this->session->userdata('___id_module') != ''){
            $this->db->where('OP.id_module', $this->session->userdata('___id_module'));
        }
        
        if($this->session->userdata('___operation_name') != ''){
            $this->db->where('OP.operation_name', $this->session->userdata('___operation_name'));
        }
        
        if($this->session->userdata('___operation_slug') != ''){
            $this->db->where('OP.operation_slug', $this->session->userdata('___operation_slug'));
        }
        
        if($this->session->userdata('___order_menu') != ''){
            $this->db->where('OP.order_menu', $this->session->userdata('___order_menu'));
        }
        
        if($this->session->userdata('___is_menu_vissible') != ''){
            $this->db->where('OP.is_menu_vissible', $this->session->userdata('___is_menu_vissible'));
        }
        
        if($this->session->userdata('___is_view_vissible') != ''){
            $this->db->where('OP.is_view_vissible', $this->session->userdata('___is_view_vissible'));
        }
        
        if($this->session->userdata('___is_add_vissible') != ''){
            $this->db->where('OP.is_add_vissible', $this->session->userdata('___is_add_vissible'));
        }
        
        if($this->session->userdata('___is_edit_vissible') != ''){
            $this->db->where('OP.is_edit_vissible', $this->session->userdata('___is_edit_vissible'));
        }
        
        if($this->session->userdata('___is_delete_vissible') != ''){
            $this->db->where('OP.is_delete_vissible', $this->session->userdata('___is_delete_vissible'));
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
            $this->db->order_by('OP.id_module', 'asc');
            $this->db->order_by('OP.order_menu', 'asc');
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
    
    
    function duplicate_check_operation_name(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('id_module', $this->input->post('id_module'));
        $this->db->where('operation_name', $this->input->post('operation_name'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('operations')->num_rows();            
    }
    
    
    function duplicate_check_operation_slug(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('id_module', $this->input->post('id_module'));
        $this->db->where('operation_slug', $this->input->post('operation_slug'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('operations')->num_rows();            
    }
    
    
    function duplicate_check_order_menu(){           
        if($this->input->post('id')){
            $this->db->where_not_in('id', $this->input->post('id'));
        }
        $this->db->where('id_module', $this->input->post('id_module'));
        $this->db->where('order_menu', $this->input->post('order_menu'));
        $this->db->where('is_deleted', 0);
        return $this->db->get('operations')->num_rows();            
    }
    
    
    public function get_filter_by_id_module() //1
    {
        $this->db->select('id,module_name');
        $this->db->from('modules');
        $this->db->like('module_name', $this->input->get('q'));
        $this->db->limit(10);  
        $query = $this->db->get()->result_array();
        // Initialize Array with fetched data
        $data = array();
        foreach ($query as $obj) {
            $data[] = array("id" => $obj['id'], "text" => $obj['module_name']);
        }
        return $data;
    } 
    public function get_filter_by_operation_name() //3
    {
        $this->db->select('operation_name');
        $this->db->like('operation_name',  $this->input->get('term'), 'both');
        $this->db->order_by('operation_name', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('operations')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->operation_name,
            ];
        }
        return $data;
    }
    public function get_filter_by_operation_slug() //3
    {
        $this->db->select('operation_slug');
        $this->db->like('operation_slug',  $this->input->get('term'), 'both');
        $this->db->order_by('operation_slug', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('operations')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->operation_slug,
            ];
        }
        return $data;
    }
    public function get_filter_by_order_menu() //3
    {
        $this->db->select('order_menu');
        $this->db->like('order_menu',  $this->input->get('term'), 'both');
        $this->db->order_by('order_menu', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('operations')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->order_menu,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
