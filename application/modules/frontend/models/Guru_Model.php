
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Guru_Model extends MY_Model
{
    var $table = 'fr_guru';
    var $data_order = array();
    var $data_search = array();
    var $column_order = array(null,null,'foto','nama','bidang_ilmu','note','status'); 
    var $column_search = array('foto','nama','bidang_ilmu','note','status');
    public function __construct()
    {
        parent::__construct();
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ _get_datatables_query ]
    private function _get_datatables_query()
    {
        $this->db->select('id,foto,nama,bidang_ilmu,note,status');
        $this->db->from('fr_guru');
        if ($this->session->userdata('___ss_filter')) {
            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ status ]
            if ($this->session->userdata('___status') != '') {
                $this->db->where('status', $this->session->userdata('___status'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ created_by ]
            if ($this->session->userdata('___created_by') != '') {
                $this->db->where('created_by', $this->session->userdata('___created_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ modified_by ]
            if ($this->session->userdata('___modified_by') != '') {
                $this->db->where('modified_by', $this->session->userdata('___modified_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ deleted_by ]
            if ($this->session->userdata('___deleted_by') != '') {
                $this->db->where('deleted_by', $this->session->userdata('___deleted_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ restored_by ]
            if ($this->session->userdata('___restored_by') != '') {
                $this->db->where('restored_by', $this->session->userdata('___restored_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ ___recycle_bin ]
            if ($this->session->userdata('___recycle_bin') != '') {
                if ($this->session->userdata('___recycle_bin') == 2) {
                    $this->db->where('is_restored', 2);
                } else {
                    $this->db->where('is_deleted', 1);
                }
            } else {
                $this->db->where('is_deleted', 0);
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ created_at ]
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

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ modified_at ]
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

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ deleted_at ]
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

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ restored_at ]
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
        }else{
            $this->db->where('is_deleted', 0);
        }
        $i = 0;

        //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ check_export order and search ]
        $this->data_search = $this->column_search;
        $this->data_order = $this->column_order;
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
            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ order by ]
            
                $this->db->order_by('id', 'desc');
        }
    }


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ get_datatables ]
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ count_filtered ]
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ count_all_dt ]
    public function count_all_dt()
    {
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results();
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
