
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Activitylog_Model extends MY_Model
{
    var $table = 'activitylogs';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'uuid','role','fullname','email','ip_address','user_agent','modular','module','action','response','activity',); 
    var $column_search_export = array('uuid','role','fullname','email','ip_address','user_agent','modular','module','action','response','activity',);
    var $column_order = array(null,null,'uuid','role','fullname','email','ip_address','modular','module','action','response',); 
    var $column_search = array('uuid','role','fullname','email','ip_address','modular','module','action','response',);
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('id,uuid,role,fullname,email,ip_address,user_agent,modular,module,action,response,activity');
        }else {
            $this->db->select('id,uuid,role,fullname,email,ip_address,modular,module,action,response');
        }
        $this->db->from('activitylogs');
        
        if($this->session->userdata('___uuid') != ''){
            $this->db->where('uuid', $this->session->userdata('___uuid'));
        }
        
        if($this->session->userdata('___role') != ''){
            $this->db->where('role', $this->session->userdata('___role'));
        }
        
        if($this->session->userdata('___fullname') != ''){
            $this->db->where('fullname', $this->session->userdata('___fullname'));
        }
        
        if($this->session->userdata('___email') != ''){
            $this->db->where('email', $this->session->userdata('___email'));
        }
        
        if($this->session->userdata('___modular') != ''){
            $this->db->where('modular', $this->session->userdata('___modular'));
        }
        
        if($this->session->userdata('___module') != ''){
            $this->db->where('module', $this->session->userdata('___module'));
        }
        
        if($this->session->userdata('___action') != ''){
            $this->db->where('action', $this->session->userdata('___action'));
        }
        
        if($this->session->userdata('___response') != ''){
            $this->db->where('response', $this->session->userdata('___response'));
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
                $this->db->order_by('id', 'desc');
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
        return $this->db->count_all_results();
    }
    
    
    public function get_filter_by_uuid() //3
    {
        $this->db->select('uuid');
        $this->db->like('uuid',  $this->input->get('term'), 'both');
        $this->db->order_by('uuid', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->uuid,
            ];
        }
        return $data;
    }
    public function get_filter_by_role() //3
    {
        $this->db->select('role');
        $this->db->like('role',  $this->input->get('term'), 'both');
        $this->db->order_by('role', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->role,
            ];
        }
        return $data;
    }
    public function get_filter_by_fullname() //3
    {
        $this->db->select('fullname');
        $this->db->like('fullname',  $this->input->get('term'), 'both');
        $this->db->order_by('fullname', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->fullname,
            ];
        }
        return $data;
    }
    public function get_filter_by_email() //3
    {
        $this->db->select('email');
        $this->db->like('email',  $this->input->get('term'), 'both');
        $this->db->order_by('email', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->email,
            ];
        }
        return $data;
    }
    public function get_filter_by_modular() //3
    {
        $this->db->select('modular');
        $this->db->like('modular',  $this->input->get('term'), 'both');
        $this->db->order_by('modular', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->modular,
            ];
        }
        return $data;
    }
    public function get_filter_by_module() //3
    {
        $this->db->select('module');
        $this->db->like('module',  $this->input->get('term'), 'both');
        $this->db->order_by('module', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->module,
            ];
        }
        return $data;
    }
    public function get_filter_by_action() //3
    {
        $this->db->select('action');
        $this->db->like('action',  $this->input->get('term'), 'both');
        $this->db->order_by('action', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->action,
            ];
        }
        return $data;
    }
    public function get_filter_by_response() //3
    {
        $this->db->select('response');
        $this->db->like('response',  $this->input->get('term'), 'both');
        $this->db->order_by('response', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('activitylogs')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->response,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
