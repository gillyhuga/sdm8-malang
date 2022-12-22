<?php

defined('BASEPATH') or exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;

class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ciqrcode');
        // $uuid4 = Uuid::uuid4();
        // echo $uuid4->toString() . "\n"; // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
    }
  

    // =====> get all data from table  <============================================================================================================================
    public function get_list($table_name, $index_array, $columns = null, $limit = null, $offset = 0, $order_field = null, $order_type = null)
    {
        if ($columns) {
            $this->db->select($columns);
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        if ($order_type) {
            $this->db->order_by($order_field, $order_type);
        } else {
            $this->db->order_by('id', 'DESC');
        }
        return $this->db->get_where($table_name, $index_array)->result();
    }



    // =====> get single data from table  <============================================================================================================================
    public function get_single($table_name, $index_array, $columns = null)
    {
        if ($columns) {
            $this->db->select($columns);
        }
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $row = $this->db->get_where($table_name, $index_array)->row();
        return $row;
    }

    public function insert($table_name, $data_array)
    {
        $this->db->insert($table_name, $data_array);
        return $this->db->insert_id();
    }

    public function account_logs($uuid)
    {
        $data = array();

        if ($this->input->post('email')) {
            if ($this->input->post('type') == 'reset') {
                $data = [
                    'uuid' => $uuid,
                    'type' => 1,
                    'old' => 'reset',
                    'new' => $this->input->post('email'),
                ];
            } else {
                $data = [
                    'uuid' => $uuid,
                    'type' => 1,
                    'old' => 'edit',
                    'new' => $this->input->post('email'),
                ];
            }
        }

        if ($this->input->post('password')) {
            if ($this->input->post('type') == 'reset') {
                $data = [
                    'uuid' => $uuid,
                    'type' => 2,
                    'old' => 'Reset',
                    'new' => get_starred($this->input->post('password')),
                ];
            } else {
                $data = [
                    'uuid' => $uuid,
                    'type' => 2,
                    'old' => 'Edit',
                    'new' => get_starred($this->input->post('password')),
                ];
            }
        }

        if ($this->input->post('new_permission')) {
            $data = [
                'uuid' => $uuid,
                'type' => 3,
                'old' => $this->input->post('old_permission'),
                'new' => $this->input->post('new_permission'),
            ];
        }

        if ($this->input->post('backup_database')) {
            $data = [
                'uuid' => $uuid,
                'type' => 4,
            ];
        }

        if ($this->input->post('mytoken')) {
            if ($this->input->post('type') == 'reset') {
                $data = [
                    'uuid' => $uuid,
                    'type' => 5,
                    'old' => 'Reset',
                    'new' => $this->input->post('mytoken'),
                ];
            } else {
                $data = [
                    'uuid' => $uuid,
                    'type' => 5,
                    'old' => 'Edit',
                    'new' => $this->input->post('mytoken'),
                ];
            }
        }

        if ($this->input->post('status')) {
            $data = [
                'uuid' => $uuid,
                'type' => 6,
                'old' => 'Status User',
                'new' => $this->input->post('status'),
            ];
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $this->db->insert('account_logs', $data);
        $uuid = $this->db->insert_id();
        return $uuid;
    }


    // =====> STORE <===========================================================================================================================
    public function save($table_name, $data)
    {
        if ($data['id']) {
            $this->db->where('id', $data['id']);
            $this->db->update($table_name, $data);
            return $data['id'];
        } else {
            $this->db->insert($table_name, $data);
            return $this->db->insert_id();
        }
    }

    public function store_qrcode($table_name, $data_array)
    {
        if ($data_array['uuid']) {
            $this->db->where('uuid', $data_array['uuid']);
            $this->db->update($table_name, $data_array);
            return $data_array['uuid'];
        } else {
            $uuid4 = Uuid::uuid4();
            $params['data'] = $uuid4->toString();
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . 'assets/backend/uploads/qrcode/' . $uuid4->toString() . '.png';
            $this->ciqrcode->generate($params);
            $data_array['uuid'] = $uuid4->toString();
            $this->db->insert($table_name, $data_array);
            return $data_array['uuid'];
        }
    }

    public function generate_uuid($uuid)
    {
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'assets/backend/uploads/qrcode/' . $uuid . '.png';
        return $this->ciqrcode->generate($params);
    }

    
    public function store($table_name, $data_array)
    {
        if ($data_array['uuid']) {
            $this->db->where('uuid', $data_array['uuid']);
            $this->db->update($table_name, $data_array);
            return $data_array['uuid'];
        } else {
            $uuid4 = Uuid::uuid4();
            $data_array['uuid'] = $uuid4->toString();
            $this->db->insert($table_name, $data_array);
            return $data_array['uuid'];
        }
    }

    public function uuid_gen()
    {
        $uuid4 = Uuid::uuid4();
        return $uuid4->toString();
    }

    public function password_hash_random()
    {
        $options = ['cost' => 12];
        $str_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
        return $str_pass;
        // $check = password_verify($pass, $str_pass);
    }
    
    public function create_new_user($uuid, $fullname = false, $photo = false)
    {
        $data = array();
        if (!empty($this->input->post('uuid'))) {
            $data['photo'] = $photo;
            $data['fullname'] = $fullname;
            $data['username'] = preg_replace('/\s+/', '', strtolower($fullname));
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            $this->session->set_userdata('photo', $data['photo']);
            $this->session->set_userdata('fullname', $data['fullname']);
        } else {
            $data['uuid'] = $uuid;
            $data['role_id'] = $this->input->post('role');
            $data['email'] = strtolower($this->input->post('email'));
            $data['fullname'] = $fullname;
            $data['photo'] = $photo;
            $data['filestore'] = $this->input->post('filestore');
            $data['url'] = $this->input->post('url');
            $data['mytoken'] = mt_rand(100000, 999999);
            $data['username'] = preg_replace('/\s+/', '', strtolower($fullname));
            $data['password'] = $this->password_hash_random();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status'] = 1; // by default would not be able to login
            $data['is_deleted'] = 0;
        }
        if (!empty($this->input->post('uuid'))) {
            $this->db->update('users', $data, array('uuid' => $this->input->post('uuid')));
            $this->account_logs($this->input->post('uuid'));
            return $this->input->post('uuid');
        } else {
            $this->db->insert('users', $data);
            $uuid = $this->db->insert_id();
            $this->account_logs($uuid);
            return $uuid;
        }

    }

    
    // =====> DESTROY <===========================================================================================================================
    public function delete($table_name, $index_array)
    {
        $this->db->delete($table_name, $index_array);
        return $this->db->affected_rows();
    }

    // =====> UPDATE <===========================================================================================================================
    public function update($table_name, $data_array, $index_array)
    {
        $this->db->update($table_name, $data_array, $index_array);
        return $this->db->affected_rows();
    }
}

/* End of file MY_Model.php */
