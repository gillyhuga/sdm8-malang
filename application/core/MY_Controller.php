<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $setting = array();
    public $config_path = 'application/config/custom.php';
    public $config_sidebar = 'application/views/layout/sidebar.php';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_Model', 'dashboard', true);
        if (!logged_in_user_id()) {
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 440,
                    'user' => 'Hei, there!',
                    'message' => 'Your session has been expired!, try to login again',
                ];
                echo json_encode($response);
            } else {
                redirect('welcome', 'refresh');
            }
            exit;
        }
        if ($this->session->userdata('lockscreen')) {
            redirect('lockscreen', 'refresh');
        }

        $setting = $this->db->get_where('settings', array('status' => 1))->row();

        if ($setting) {
            $this->setting = $setting;
            date_default_timezone_set('Asia/Jakarta');
        }
        $this->config->load('custom');
    }


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save session filter ]
    public function save_session_filter()
    {
        if($this->input->post('ss_filter')){
            $this->session->set_userdata('___ss_filter', true);
        }
        if ($this->input->post('___created_at') != '') {
            $dateranges = (explode('-', $this->input->post('___created_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];

            $this->session->set_userdata('___created_start', $start);
            $this->session->set_userdata('___created_end', $end);
        } else {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___created_start');
                $this->session->unset_userdata('___created_end');
            }
        }

        if ($this->input->post('___modified_at') != '') {
            $dateranges = (explode('-', $this->input->post('___modified_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];

            $this->session->set_userdata('___modified_start', $start);
            $this->session->set_userdata('___modified_end', $end);
        } else {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___modified_start');
                $this->session->unset_userdata('___modified_end');
            }
        }

        if ($this->input->post('___deleted_at') != '') {
            $dateranges = (explode('-', $this->input->post('___deleted_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];

            $this->session->set_userdata('___deleted_start', $start);
            $this->session->set_userdata('___deleted_end', $end);
        } else {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___deleted_start');
                $this->session->unset_userdata('___deleted_end');
            }
        }


        if ($this->input->post('___restored_at') != '') {
            $dateranges = (explode('-', $this->input->post('___restored_at')));
            $start = $dateranges[0];
            $end = $dateranges[1];

            $this->session->set_userdata('___restored_start', $start);
            $this->session->set_userdata('___restored_end', $end);
        } else {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___restored_start');
                $this->session->unset_userdata('___restored_end');
            }
        }

        $this->session->set_userdata('___status', $this->input->post('___status'));
        $this->session->set_userdata('___role_id', $this->input->post('___role_id'));
        $this->session->set_userdata('___recycle_bin', $this->input->post('___recycle_bin'));

        if ($this->input->post('___created_by') == 0) {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___created_by');
            }
        } else {
            $this->session->set_userdata('___created_by', $this->input->post('___created_by'));
        }

        if ($this->input->post('___modified_by') == 0) {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___modified_by');
            }
        } else {
            $this->session->set_userdata('___modified_by', $this->input->post('___modified_by'));
        }

        if ($this->input->post('___deleted_by') == 0) {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___deleted_by');
            }
        } else {
            $this->session->set_userdata('___deleted_by', $this->input->post('___deleted_by'));
        }

        if ($this->input->post('___restored_by') == 0) {
            if ($this->input->post('ss_filter') == 1) {
                $this->session->unset_userdata('___restored_by');
            }
        } else {
            $this->session->set_userdata('___restored_by', $this->input->post('___restored_by'));
        }
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ destroy session filter ]
    public function destroy_session_filter()
    {
        $this->session->unset_userdata('___ss_filter');
        $this->session->unset_userdata('___start');
        $this->session->unset_userdata('___end');
        $this->session->unset_userdata('___status');
        $this->session->unset_userdata('___role_id');
        $this->session->unset_userdata('___recycle_bin');
        $this->session->unset_userdata('___created_by');
        $this->session->unset_userdata('___modified_by');
        $this->session->unset_userdata('___deleted_by');
        $this->session->unset_userdata('___created_start');
        $this->session->unset_userdata('___created_end');
        $this->session->unset_userdata('___modified_start');
        $this->session->unset_userdata('___modified_end');
        $this->session->unset_userdata('___deleted_start');
        $this->session->unset_userdata('___deleted_end');
        $this->session->unset_userdata('___restored_start');
        $this->session->unset_userdata('___restored_end');
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ update configuration ]
    public function update_config()
    {
        $data = array();
        $this->db->select('P.*, M.module_slug, O.operation_slug');
        $this->db->from('privileges AS P');
        $this->db->join('operations AS O', 'O.id = P.operation_id', 'left');
        $this->db->join('modules AS M', 'M.id = O.id_module', 'left');
        $results = $this->db->get()->result();
        foreach ($results as $obj) {
            $data[] = $obj;
        }
        if (!is_array($data) && count($data) == 0) {
            return false;
        }

        @chmod($this->config_path, FILE_WRITE_MODE);
        // Is the config file writable?
        if (!is_really_writable($this->config_path)) {
            show_error($this->config_path . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        }

        // Read the config file as PHP
        require $this->config_path;

        // load the file helper
        $this->CI = &get_instance();
        $this->CI->load->helper('file');
        $config_file = '<?php ';
        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $config_file .= "\n";
                $config_file .= "\$config['my_$val->module_slug']['$val->operation_slug']['$val->role_id'] = '" . $val->is_menu . "|" . $val->is_add . "|" . $val->is_edit . "|" . $val->is_view . "|" . $val->is_delete . "';";
            }
        }

        if (!$fp = fopen($this->config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return false;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $config_file, strlen($config_file));
        flock($fp, LOCK_UN);
        fclose($fp);
        @chmod($this->config_path, FILE_READ_MODE);
        return true;
    }

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ create_new_sidebar ]
    public function create_sidebar()
    {
        // load the file helper
        $this->CI = &get_instance();
        $this->CI->load->helper('file');
        $module = $this->dashboard->get_list('modules', array('status' => 1), '', '', '', 'module_order', 'ASC');
        $string = "
<div class=\"site-menubar __sidebar\">
	<div class=\"site-menubar-body\">
		<div>
			<div>
				<ul class=\"site-menu\" data-plugin=\"menu\">
					<br>
					<li class=\"site-menu-item\">
						<a class=\"animsition-link\" href=\"dashboard/home\">
							<i class=\"site-menu-icon md-view-dashboard\" aria-hidden=\"true\"></i>
							<span class=\"site-menu-title\">Dashboard</span>
						</a>
                    </li>";
        $permission_check = "<?php if(";
        $last_key = sizeof($module);
        foreach ($module as $key => $obj) {
            if ($obj->module_slug == 'setting') {
                continue;
            }
            $check_sub_menu = $this->dashboard->get_list('operations', array('status' => 1, 'id_module' => $obj->id), '', '', '', 'order_menu', 'ASC');
            if (empty($check_sub_menu)) {
                continue;
            }
            if ($check_sub_menu) {
                $count = count($check_sub_menu) - 1;
                $permission_check = '';
                $permission_check .= "
                    <?php if(\$this->session->userdata('___switch') == '$obj->module_slug' OR \$this->session->userdata('___switch') == ''){ ?>
                        <?php if(";
                    foreach ($check_sub_menu as $key => $permission) {
                        if ($obj->id == $permission->id_module) {
                            if ($key == $count) {
                                $permission_check .= "has_permission(MENU, '$obj->module_slug', '$permission->operation_slug')){ ?>";
                            } else {
                                $permission_check .= "has_permission(MENU, '$obj->module_slug', '$permission->operation_slug') || ";
                            }
                        }
                    }
            }
            $string .=
                $permission_check;
                $string .= "
                            <li class=\"site-menu-item has-sub\">
                                <a href=\"#\">
                                    <i class=\"site-menu-icon md-$obj->module_icon\" aria-hidden=\"true\"></i>
                                    <span class=\"site-menu-title\">$obj->module_name</span>
                                    <span class=\"site-menu-arrow\"></span>
                                </a> ";
            if ($check_sub_menu) {
                $string .= "
                                <ul class=\"site-menu-sub\">";
                foreach ($check_sub_menu as $key => $value) {
                    $str = str_replace(' ', '_', $value->operation_slug);
                    $name_menu = str_replace('_', ' ', $value->operation_name);
                    $string .= "
                                    <?php if(has_permission(MENU, '$obj->module_slug', '$value->operation_slug')){ ?>
                                        <li class=\"site-menu-item active\">
                                            <a class=\"animsition-link\" href=\"$obj->module_slug/$str\">
                                                <span class=\"site-menu-title\">$name_menu</span>
                                            </a>
                                        </li>
                                    <?php } ?>";
                }
                $string .= "
                                </ul>";
            }

            $string .= "
                            </li> ";
            if ($check_sub_menu) {
                $string .= "
                        <?php } ?> 
                    <?php } ?> ";
            }
        }
        $string .= "
					</li>
				</ul>
            </div>
        </div>
    </div>
    <div class=\"site-menubar-footer\">
        <a href=\"javascript: void(0);\" id=\"button_edit\" data-url='<?= site_url('setting/index') ?>' data-id='<?= 1 ?>' class=\"fold-show\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Settings\">
            <span class=\"icon md-settings\" aria-hidden=\"true\"></span>
        </a>
        <a href=\"<?= site_url('lockscreen')?>\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Lock\">
            <span class=\"icon md-eye-off\" aria-hidden=\"true\"></span>
        </a>
        <a href=\"javascript: void(0);\" id=\"button_logout\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Logout\">
            <span class=\"icon md-power\" aria-hidden=\"true\"></span>
        </a>
    </div>
</div>
<div class=\"site-gridmenu\">
    <div>
        <div>
            <ul>";
        $count = sizeof($module) -1;
        foreach ($module as $key => $obj) {
            if($obj->module_name == 'Setting') continue;
            $menu = $obj->module_slug;
            if($count == $key) {
            $string .= "
                <li class=\"button_menu\" data-url=\"dashboard/switch\" data-menu=\"default\">
                    <a href=\"#\">
                        <i class=\"icon md-$obj->module_icon\"></i>
                        <span>Default</span>
                    </a>
                </li>";
            }else{
            $string .= "
                <li class=\"button_menu\" data-url=\"dashboard/switch\" data-menu=\"$menu\">
                    <a href=\"#\">
                        <i class=\"icon md-$obj->module_icon\"></i>
                        <span>$obj->module_name</span>
                    </a>
                </li>";
            }
         
        }
        $string .= "
            </ul>
        </div>
    </div>
</div>
        ";

        if (!$fp = fopen($this->config_sidebar, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return false;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $string, strlen($string));
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($this->config_sidebar, FILE_READ_MODE);

        return true;
    }
}

/* End of file MY_Controller.php */
