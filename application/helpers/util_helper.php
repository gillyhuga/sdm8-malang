<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// =========================================================================================================================================== Var_dump
if (!function_exists('dd')) {
    function dd($data = false, $exit = true)
    {
        print '<pre>';
        if (!empty($data)) {
            print_r($data);
        } else {
            print_r('I`am over here faiz...!!!');
        }
        print '</pre>';
        if ($exit) {
            exit;
        }
    }
}


// =====> Login Verify <============================================================================================================================
if (!function_exists('logged_in_user_id')) {
    function logged_in_user_id()
    {
        $logged_in_id = 0;
        $CI = &get_instance();
        if ($CI->session->userdata('uuid') && $CI->session->userdata('role_id')) :
            $logged_in_id = $CI->session->userdata('uuid');
        endif;
        return $logged_in_id;
    }
}


// =====> decrypt table <============================================================================================================================
if (!function_exists('ara_decrypt')) {
    function ara_decrypt($data = null)
    {
        // decrypter
        $ciphering = "AES-128-CTR";
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';
        $options = 0;
        // Store the decryption key
        $decryption_key = "ZRi5FLRFEoDgBDdFs385N4RquRGtFK5S";
        // Use openssl_decrypt() function to decrypt the data
        return openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
    }
}


if (!function_exists('has_permission')) {
    function has_permission($action, $module_slug = null, $operation_slug = null)
    {
        $CI = &get_instance();
        $role_id = $CI->session->userdata('role_id');
        if ($module_slug == '') {
            $module_slug = $operation_slug;
        }
        $module_slug = 'my_' . $module_slug;
        $data = $CI->config->item($operation_slug, $module_slug);
        $result = @$data[$role_id];
        if (!empty($result)) {
            $array = explode('|', $result);
            return $array[$action];
        } else {
            return false;
        }
    }
}

if (!function_exists('password_hash_random')) {
    function password_hash_random($mypass)
    {
        $options = ['cost' => 12];
        $str_pass = password_hash($mypass, PASSWORD_BCRYPT, $options);
        return $str_pass;
    }
}

// =========================================================================================================================================== Password Encyrpt
if (!function_exists('get_starred')) {
    function get_starred($str)
    {
        $str_length = strlen($str);
        return substr($str, 0, 4) . str_repeat('*', $str_length - 4);
    }
}




if (!function_exists('password_hash_check')) {
    function password_hash_check($mypass)
    {
        $str_pass = password_verify($mypass, PASSWORD_BCRYPT);
        return $str_pass;
    }
}

if (!function_exists('is_superadmin')) {
    function is_superadmin()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('role_id') == 1) {
            $logged_in = true;
        } else {
            $logged_in = false;
        }
        return $logged_in;
    }
}


if (!function_exists('is_admin')) {
    function is_admin()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('role_id') == 1 or $CI->session->userdata('role_id') == 2) {
            $logged_in = true;
        } else {
            $logged_in = false;
        }
        return $logged_in;
    }
}

if (!function_exists('check_permission')) {
    function check_permission($action)
    {
        $CI = &get_instance();
        $role_id = $CI->session->userdata('role_id');
        $operation_slug = $CI->router->fetch_class();
        $module_slug = $CI->router->fetch_module();
        if ($module_slug == '') {
            $module_slug = $operation_slug;
        }
        $module_slug = 'my_' . $module_slug;
        $data = $CI->config->item($operation_slug, $module_slug);
        $result = $data[$role_id];
        if (empty($role_id)) {
            $response = [
                'status' => 440,
                'user' => $CI->session->userdata('fullname'),
                'message' => 'Unauthorized for access this module',
            ];
            echo json_encode($response);
        } else if (!empty($result)) {

            $array = explode('|', $result);
            if (!$array[$action]) {
                $response = [
                    'status' => 401,
                    'user' => $CI->session->userdata('fullname'),
                    'message' => 'Unauthorized for access this module ' . $CI->uri->segment(2),
                ];
                echo json_encode($response);
            } else {
                return true;
            }
        } else {
            $response = [
                'status' => 440,
                'user' => 'Hei, there!',
                'message' => 'Your Sesson has been expired!',
            ];
            echo json_encode($response);
        }
    }
}



// =========================================================================================================================================== start CSRF
if (!function_exists('get_csrf_token')) {
    function get_csrf_token()
    {
        $CI = &get_instance();
        if (!$CI->session->csrf_token) {
            $CI->session->csrf_token = hash('sha1', time());
        }
        return $CI->session->csrf_token;
    }
}

// =========================================================================================================================================== CSRF name token
if (!function_exists('get_csrf_name')) {
    function get_csrf_name()
    {
        return 'token';
    }
}

// =========================================================================================================================================== CSRF Verify
if (!function_exists('check_csrf')) {
    function check_csrf()
    {
        $CI = &get_instance();
        if ($CI->input->post('token') != $CI->session->csrf_token or !$CI->input->post('token') or !$CI->session->csrf_token) {
            $CI->session->unset_userdata('csrf_token');
            $response = [
                'status' => 401,
                'user' => $CI->session->userdata('fullname'),
                'message' => 'Token has been expired',
            ];
            echo json_encode($response);
        } else {
            return true;
        }
    }
}

// =========================================================================================================================================== CSRF TOKEN VALUE on FORM
if (!function_exists('csrf')) {
    function csrf()
    {
        return "<input type='hidden' name='" . get_csrf_name() . "' value='" . get_csrf_token() . "'>";
    }
}


if (!function_exists('check_admin')) {
    function check_admin()
    {
        $CI = &get_instance();
        $role_id = $CI->session->userdata('role_id');
        if ($role_id != 1 and $role_id != 2) {
            $response = [
                'status' => 401,
                'user' => $CI->session->userdata('fullname'),
                'message' => 'Unauthorized for access this module' . $CI->uri->segment(2),
            ];
            echo json_encode($response);
        } else {
            return true;
        }
    }
}


if (!function_exists('safe')) {
    function safe($string)
    {
        return strip_tags(trim($string));
    }
}

if (!function_exists('createFile')) {
    function createFile($string, $path)
    {
        $create = fopen($path, "w") or die("Change your permision folder for application and myRobot folder to 777");
        fwrite($create, $string);
        fclose($create);
        return $path;
    }
}

if (!function_exists('__user_email')) {
    function __user_email($uuid)
    {
        $CI = &get_instance();
        $data = $CI->db->get_where('users', array('uuid' => $uuid))->row();
        return $data->email;
    }
}

function __rupiah($angka)
{
    $hasil = 'Rp. ' . number_format($angka, 0, ",", ".");
    return $hasil;
}

if (!function_exists('random_code')) {
    function random_code($length)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }
}

if (!function_exists('generate_key')) {
    function generate_key($length, $mode = '')
    {
        // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_';
        if($mode == 2){
            $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'; 
            $long = strlen($characters);
        }else if ($mode == 3){
            $characters = '0123456789abcdefghjkmnopqrstuvwxyz';
            $long = strlen($characters);
        }else if($mode == 4){
            $characters = 'abcdefghjkmnopqrstuvwxyz';
            $long = strlen($characters);
        }else if($mode == 5){
            $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
            $long = strlen($characters);
        }else{
            $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz';
            $long = strlen($characters);
        }
        $result = '';
        for ($i = 0; $i < $length; $i++){
            $result .= $characters[mt_rand(0, $long)];
        }
        return $result;
    }
}
if (!function_exists('create_log')) {

    function create_log($log = null)
    {
        $CI = &get_instance();
        $data = array();
        $data['uuid']       = $CI->session->userdata('uuid');    
        $data['role']       = $CI->session->userdata('role_permission');
        $data['fullname']   = $CI->session->userdata('fullname');
        $data['email']      = $CI->session->userdata('email');
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['modular']    = $log['modular'];
        $data['module']     = $log['module'];
        $data['action']     = $log['action'];
        $data['response']   = $log['status'];
        $data['activity']   = json_encode($_POST);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $CI->db->insert('activitylogs', $data);
    }
}

if (!function_exists('sanitize')) {
    function sanitize($title)
    {
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
    
        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');
    
        return $title;
    }
}



// =========================================================================================================================================== show date full name month
if (!function_exists('__date')) {
    function __date($date)
    {
        // array hari dan bulan
        $Bulan = array(
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember",
        );

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $tanggalku = $tgl . ' ' . $Bulan[(int) $bulan - 1] . ' ' . $tahun;
        $result = $tanggalku;
        return $result;
    }
}

// =========================================================================================================================================== Convert date to time
if (!function_exists('__time')) {
    function __time($date)
    {
        $waktu = substr($date, 11, 5);
        $time = '<strong>' . $waktu . ' WIB</strong>';
        $result = $time;
        return $result;
    }
}

// =========================================================================================================================================== show Date and time
if (!function_exists('__datetime')) {
    function __datetime($date)
    {
        if (empty($date)) {
            return '-';
        }
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array(
            "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
            "Jul", "Agu", "Sept", "Okt", "Nov", "Des",
        );

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $tanggalku = $tgl . " " . $Bulan[(int) $bulan - 1] . " " . $tahun;
        $time = '<strong>' . $waktu . ' WIB</strong>';
        $result = $Hari[$hari] . ", $tanggalku $time ";
        return $result;
    }
}

if (!function_exists('___datetime')) {
    function ___datetime($date)
    {
        if (empty($date)) {
            return '-';
        }
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array(
            "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
            "Jul", "Agu", "Sept", "Okt", "Nov", "Des",
        );

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $tanggalku = $tgl . " " . $Bulan[(int) $bulan - 1] . " " . $tahun;
        $result = $tanggalku ."-". $waktu ." WIB";
        return $result;
    }
}

if (!function_exists('get_operation_by_module')) {
    function get_operation_by_module($id_module)
    {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('operations');
        $CI->db->where('id_module', $id_module);
        return $CI->db->get()->result();
    }
}

if (!function_exists('get_permission_by_operation')) {
    function get_permission_by_operation($role_id, $operation_id)
    {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('privileges');
        $CI->db->where('role_id', $role_id);
        $CI->db->where('operation_id', $operation_id);
        return $CI->db->get()->row();
    }
}




function cutText($str, $limit, $brChar = ' ', $pad = '...') 
{
    if (empty($str) || strlen($str) <= $limit) {
        return $str;
    }

    $output = substr($str, 0, ($limit+1));
    $brCharPos = strrpos($output, $brChar);
    $output = substr($output, 0, $brCharPos);
    $output = preg_replace('#\W+$#', '', $output);
    $output .= $pad;
    
    return $output;
}