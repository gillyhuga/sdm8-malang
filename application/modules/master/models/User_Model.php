
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  User_Model extends MY_Model
{
    var $table = 'admin';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'AD.photo','XY.name','AD.email','AD.nama','AD.jenis_kelamin','AD.hp','AD.alamat','AD.status'); 
    var $column_search_export = array('AD.photo','XY.name','AD.email','AD.nama','AD.jenis_kelamin','AD.hp','AD.alamat','AD.status');
    var $column_order = array(null,null,'AD.photo','XY.name','AD.email','AD.nama','AD.jenis_kelamin','AD.hp','AD.status'); 
    var $column_search = array('AD.photo','XY.name','AD.email','AD.nama','AD.jenis_kelamin','AD.hp','AD.status');
    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('AD.id,AD.uuid,AD.photo,XY.name AS role,AD.email,AD.nama,AD.jenis_kelamin,AD.hp,AD.alamat,AD.status');
        }else {
            $this->db->select('AD.id,AD.uuid,AD.photo,XY.name AS role,AD.email,AD.nama,AD.jenis_kelamin,AD.hp,AD.status');
        }
        $this->db->from('admin AS AD');
        $this->db->join('roles AS  XY', 'XY.id = AD.role', 'left');
        if($this->session->userdata('role_id') != 1){
            $this->db->where_not_in('AD.role' , 1);
        }
        if ($this->session->userdata('___status') != '') {
            $this->db->where('AD.status', $this->session->userdata('___status'));
        }
        if ($this->session->userdata('___created_by') != '') {
            $this->db->where('AD.created_by', $this->session->userdata('___created_by'));
        }
        if ($this->session->userdata('___modified_by') != '') {
            $this->db->where('AD.modified_by', $this->session->userdata('___modified_by'));
        }
        if ($this->session->userdata('___deleted_by') != '') {
            $this->db->where('AD.deleted_by', $this->session->userdata('___deleted_by'));
        }
        if ($this->session->userdata('___restored_by') != '') {
            $this->db->where('AD.restored_by', $this->session->userdata('___restored_by'));
        }

        if ($this->session->userdata('___recycle_bin') != '') {
            if ($this->session->userdata('___recycle_bin') == 2) {
                $this->db->where('AD.is_restored', 2);
            } else {
                $this->db->where('AD.is_deleted', 1);
            }
        } else {
            $this->db->where('AD.is_deleted', 0);
        }

        if ($this->session->userdata('___created_start') != '' ||  $this->session->userdata('___created_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___created_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___created_end')));

            if ($start == $end) {
                $this->db->like('AD.created_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('AD.created_at >= ', $start . ' 00:00:00');
                $this->db->where('AD.created_at < ', $end . ' 23:59:59');
            }
        }

        if ($this->session->userdata('___modified_start') != '' ||  $this->session->userdata('___modified_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___modified_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___modified_end')));

            if ($start == $end) {
                $this->db->like('AD.modified_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('AD.modified_at >= ', $start . ' 00:00:00');
                $this->db->where('AD.modified_at <', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___deleted_start') != '' ||  $this->session->userdata('___deleted_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___deleted_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___deleted_end')));

            if ($start == $end) {
                $this->db->like('AD.deleted_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('AD.deleted_at >= ', $start . ' 00:00:00');
                $this->db->where('AD.deleted_at < ', $end . ' 23:59:59');
            }
        }
        if ($this->session->userdata('___restored_start') != '' ||  $this->session->userdata('___restored_end') != '') {
            $start = date('Y-m-d', strtotime($this->session->userdata('___restored_start')));
            $end = date('Y-m-d', strtotime($this->session->userdata('___restored_end')));

            if ($start == $end) {
                $this->db->like('AD.restored_at', date('Y-m-d', strtotime($start)));
            } else {
                $this->db->where('AD.restored_at >= ', $start . ' 00:00:00');
                $this->db->where('AD.restored_at < ', $end . ' 23:59:59');
            }
        }
        
        
        if($this->session->userdata('___role') != ''){
            $this->db->where('AD.role', $this->session->userdata('___role'));
        }
        
        if($this->session->userdata('___email') != ''){
            $this->db->where('AD.email', $this->session->userdata('___email'));
        }
        
        if($this->session->userdata('___nama') != ''){
            $this->db->where('AD.nama', $this->session->userdata('___nama'));
        }
        
        if($this->session->userdata('___jenis_kelamin') != ''){
            $this->db->where('AD.jenis_kelamin', $this->session->userdata('___jenis_kelamin'));
        }
        
        if($this->session->userdata('___hp') != ''){
            $this->db->where('AD.hp', $this->session->userdata('___hp'));
        }
        
        if($this->session->userdata('___alamat') != ''){
            $this->db->where('AD.alamat', $this->session->userdata('___alamat'));
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
            $this->db->order_by('AD.id', 'desc');
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
    
    
    public function get_filter_by_role() //1
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
        $query =  $this->db->get('admin')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->email,
            ];
        }
        return $data;
    }
    public function get_filter_by_nama() //3
    {
        $this->db->select('nama');
        $this->db->like('nama',  $this->input->get('term'), 'both');
        $this->db->order_by('nama', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('admin')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->nama,
            ];
        }
        return $data;
    }
    public function get_filter_by_hp() //3
    {
        $this->db->select('hp');
        $this->db->like('hp',  $this->input->get('term'), 'both');
        $this->db->order_by('hp', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('admin')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->hp,
            ];
        }
        return $data;
    }
    public function get_filter_by_alamat() //3
    {
        $this->db->select('alamat');
        $this->db->like('alamat',  $this->input->get('term'), 'both');
        $this->db->order_by('alamat', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('admin')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->alamat,
            ];
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
