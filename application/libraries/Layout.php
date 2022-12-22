<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout
{

    private $obj;
    private $layout_view;

    public function __construct()
    {
        $this->obj = &get_instance();
        $this->layout_view = "layout/default.php";
        if (isset($this->obj->layout_view))
            $this->layout_view = $this->obj->layout_view;
    }

    function view($view, $data = null, $return = false)
    {
        $data['content_for_layout'] = $this->obj->load->view($view, $data, true);
        $data['title_for_layout'] = $this->title;
        $output = $this->obj->load->view($this->layout_view, $data, $return);
        return $output;
    }
 
}
