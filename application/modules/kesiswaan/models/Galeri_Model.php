
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class  Galeri_Model extends MY_Model
{
    var $table = 'fr_galleri';
    var $data_order = array();
    var $data_search = array();
    var $column_order_export = array(null,null,'VF.nama','FR.deskripsi','FR.tanggal','FR.note','FR.status'); 
    var $column_search_export = array('VF.nama','FR.deskripsi','FR.tanggal','FR.note','FR.status');
    var $column_order = array(null,null,'FR.foto','VF.nama','FR.deskripsi','FR.tanggal','FR.note','FR.status'); 
    var $column_search = array('FR.foto','VF.nama','FR.deskripsi','FR.tanggal','FR.note','FR.status');
    public function __construct()
    {
        parent::__construct();
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ _get_datatables_query ]
    private function _get_datatables_query()
    {
        if(!empty($_POST['export'])){
            $this->db->select('FR.id,VF.nama AS nkategori,FR.deskripsi,FR.tanggal,FR.note,FR.status');
        }else {
            $this->db->select('FR.id,FR.foto,VF.nama AS nkategori,FR.deskripsi,FR.tanggal,FR.note,FR.status');
        }
        $this->db->from('fr_galleri AS FR');
        $this->db->join('fr_kategori_berita AS  VF', 'VF.id = FR.kategori', 'left');
        if ($this->session->userdata('___ss_filter')) {
            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ status ]
            if ($this->session->userdata('___status') != '') {
                $this->db->where('FR.status', $this->session->userdata('___status'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ created_by ]
            if ($this->session->userdata('___created_by') != '') {
                $this->db->where('FR.created_by', $this->session->userdata('___created_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ modified_by ]
            if ($this->session->userdata('___modified_by') != '') {
                $this->db->where('FR.modified_by', $this->session->userdata('___modified_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ deleted_by ]
            if ($this->session->userdata('___deleted_by') != '') {
                $this->db->where('FR.deleted_by', $this->session->userdata('___deleted_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ restored_by ]
            if ($this->session->userdata('___restored_by') != '') {
                $this->db->where('FR.restored_by', $this->session->userdata('___restored_by'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ ___recycle_bin ]
            if ($this->session->userdata('___recycle_bin') != '') {
                if ($this->session->userdata('___recycle_bin') == 2) {
                    $this->db->where('FR.is_restored', 2);
                } else {
                    $this->db->where('FR.is_deleted', 1);
                }
            } else {
                $this->db->where('FR.is_deleted', 0);
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ created_at ]
            if ($this->session->userdata('___created_start') != '' ||  $this->session->userdata('___created_end') != '') {
                $start = date('Y-m-d', strtotime($this->session->userdata('___created_start')));
                $end = date('Y-m-d', strtotime($this->session->userdata('___created_end')));

                if ($start == $end) {
                    $this->db->like('FR.created_at', date('Y-m-d', strtotime($start)));
                } else {
                    $this->db->where('FR.created_at >= ', $start . ' 00:00:00');
                    $this->db->where('FR.created_at < ', $end . ' 23:59:59');
                }
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ modified_at ]
            if ($this->session->userdata('___modified_start') != '' ||  $this->session->userdata('___modified_end') != '') {
                $start = date('Y-m-d', strtotime($this->session->userdata('___modified_start')));
                $end = date('Y-m-d', strtotime($this->session->userdata('___modified_end')));

                if ($start == $end) {
                    $this->db->like('FR.modified_at', date('Y-m-d', strtotime($start)));
                } else {
                    $this->db->where('FR.modified_at >= ', $start . ' 00:00:00');
                    $this->db->where('FR.modified_at <', $end . ' 23:59:59');
                }
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ deleted_at ]
            if ($this->session->userdata('___deleted_start') != '' ||  $this->session->userdata('___deleted_end') != '') {
                $start = date('Y-m-d', strtotime($this->session->userdata('___deleted_start')));
                $end = date('Y-m-d', strtotime($this->session->userdata('___deleted_end')));

                if ($start == $end) {
                    $this->db->like('FR.deleted_at', date('Y-m-d', strtotime($start)));
                } else {
                    $this->db->where('FR.deleted_at >= ', $start . ' 00:00:00');
                    $this->db->where('FR.deleted_at < ', $end . ' 23:59:59');
                }
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ restored_at ]
            if ($this->session->userdata('___restored_start') != '' ||  $this->session->userdata('___restored_end') != '') {
                $start = date('Y-m-d', strtotime($this->session->userdata('___restored_start')));
                $end = date('Y-m-d', strtotime($this->session->userdata('___restored_end')));

                if ($start == $end) {
                    $this->db->like('FR.restored_at', date('Y-m-d', strtotime($start)));
                } else {
                    $this->db->where('FR.restored_at >= ', $start . ' 00:00:00');
                    $this->db->where('FR.restored_at < ', $end . ' 23:59:59');
                }
            }
            if($this->session->userdata('___kategori') != ''){
                $this->db->where('FR.kategori', $this->session->userdata('___kategori'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ deskripsi ]
            if($this->session->userdata('___deskripsi') != ''){
                $this->db->like('FR.deskripsi', $this->session->userdata('___deskripsi'));
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ date tanggal]
            if($this->session->userdata('___start_tanggal') != '' ){
                $start = date('Y-m-d', strtotime($this->session->userdata('___start_tanggal')));
                $end = date('Y-m-d', strtotime($this->session->userdata('___end_tanggal')));
                if ($start == $end) {
                    $this->db->like('tanggal', $start);
                } else {
                    $this->db->where('tanggal >= ', $start);
                    $this->db->where('tanggal <= ', $end);
                }
            }

            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ note ]
            if($this->session->userdata('___note') != ''){
                $this->db->like('FR.note', $this->session->userdata('___note'));
            }
        }else{
            $this->db->where('FR.is_deleted', 0);
        }
        $i = 0;

        //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ check_export order and search ]
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
            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ order by ]
            
            $this->db->order_by('FR.id', 'desc');
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

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ autocomplete deskripsi ]
    public function get_deskripsi()
    {
        $this->db->distinct();
        $this->db->select('deskripsi');
        $this->db->like('deskripsi',  $this->input->get('term'), 'both');
        $this->db->order_by('deskripsi', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('fr_galleri')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->deskripsi,
            ];
        }
        return $data;
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ autocomplete note ]
    public function get_note()
    {
        $this->db->distinct();
        $this->db->select('note');
        $this->db->like('note',  $this->input->get('term'), 'both');
        $this->db->order_by('note', 'asc');
        $this->db->limit(10);
        $query =  $this->db->get('fr_galleri')->result();
        $data = array();
        foreach ($query as $obj) {
            $data[] = [
                'label' => $obj->note,
            ];
        }
        return $data;
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 from join kategori ]
    public function get_kategori()
    {
        $this->db->select('id,nama');
        $this->db->from('fr_kategori_berita');
        $this->db->like('nama', $this->input->get('q'));
        $this->db->limit(10);  
        $query = $this->db->get()->result_array();
        // Initialize Array with fetched data
        $data = array();
        foreach ($query as $obj) {
            $data[] = array("id" => $obj['id'], "text" => $obj['nama']);
        }
        return $data;
    }
}


############################################### Cretated by Faizal Harwin #####################################################
####### *ALFIRA* ######################## Thank to My beloved wife and daughter ############################### *HAUARA* ######
############################################# Thank Your For Suporting Us #####################################################
###############################################################################################################################
