<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_Model', 'home', TRUE);
    }

    public function index()
    {
        $this->session->unset_userdata('no_ajax');
        $this->session->unset_userdata('no_ajax_url');
        $this->load->view('default');
    }

    public function page()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['visi_misi'] = $this->home->get_list('fr_visi_misi',  array('status' => 1));
            $this->data['kata_sambutan'] = $this->home->get_single('fr_kata_sambutan',  array('id' => 1));
            $this->data['slider'] = $this->home->get_list('fr_slider', array('status' => 1), '', '', '', 'order_menu', 'ASC');
            $this->data['guru_staf'] = $this->home->get_list('fr_guru', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['testimonial'] = $this->home->get_list('fr_testimonial', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['berita'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['_setting'] = $this->home->get_single('settings', array('id' => 1));
            $response = [
                'status' => 'success',
                'title' => 'Home Menu',
                'html' => $this->load->view('home/index', $this->data, true),
            ];
            echo json_encode($response);
        }
    }

    public function sambutan()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['kata_sambutan'] = $this->home->get_single('fr_kata_sambutan',  array('id' => 1));
            $response = [
                'status' => 'success',
                'title' => 'Home Kata Sambutan',
                'html' => $this->load->view('home/kata_sambutan', $this->data, true),
            ];
            echo json_encode($response);
        }
    }



    public function budaya_sekolah()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['budaya_sekolah'] = $this->home->get_list('fr_budaya_sekolah', array('status' => 1), '', '', '', 'id', 'ASC');
            $response = [
                'status' => 'success',
                'title' => 'Home Budaya Sekolah',
                'html' => $this->load->view('home/budaya_sekolah', $this->data, true),
            ];
            echo json_encode($response);
        }
    }

    public function agenda()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
            $response = [
                'status' => 'success',
                'title' => 'Home Agenda',
                'html' => $this->load->view('home/agenda', $this->data, true),
            ];
            echo json_encode($response);
        }
    }

    public function profil()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $response = [
                'status' => 'success',
                'title' => 'Home Profil',
                'html' => $this->load->view('home/profil', '', true),
            ];
            echo json_encode($response);
        }
    }


    public function visi_misi()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['visi_misi'] = $this->home->get_list('fr_visi_misi',  array('status' => 1));
            $response = [
                'status' => 'success',
                'title' => 'Home Visi dan Misi',
                'html' => $this->load->view('home/visi_misi', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    public function berita()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['berita'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['latest'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '5', 'id', 'ASC');
            $this->data['kategori'] = $this->home->get_list('fr_kategori_berita', array('kategori' => 1), '', '', '5', 'id', 'ASC');
            $response = [
                'status' => 'success',
                'title' => 'Home Berita',
                'html' => $this->load->view('home/berita', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    public function berita_detail()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['berita'] = $this->home->get_single('fr_berita', array('id' => $this->input->post('id')));
            $response = [
                'status' => 'success',
                'title' => 'Home Berita Detail',
                'html' => $this->load->view('home/berita_detail', $this->data, true),
            ];
            echo json_encode($response);
        }
    }

    public function guru()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['guru'] = $this->home->get_list('fr_guru', array('status' => 1), '', '', '', 'id', 'ASC');

            $response = [
                'status' => 'success',
                'title' => 'Home Guru',
                'html' => $this->load->view('home/guru', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    public function galleri()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['galleri'] = $this->home->get_list('fr_galleri', array('status' => 1), '', '', '', 'id', 'ASC');

            $response = [
                'status' => 'success',
                'title' => 'Home Galleri',
                'html' => $this->load->view('home/galleri', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    public function ebook_list()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['ebooks'] = $this->home->get_list('ebooks', array('status' => 1), '', '', '', 'id', 'ASC');

            $response = [
                'status' => 'success',
                'title' => 'Home Guru',
                'html' => $this->load->view('home/ebooks', $this->data, true),
            ];
            echo json_encode($response);
        }
    }

    public function ebook_detail()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $this->data['ebook'] = $this->home->get_single('ebooks',  array('id' => $this->input->post('id')));
            $response = [
                'status' => 'success',
                'title' => 'Home Guru',
                'html' => $this->load->view('home/ebook', $this->data, true),
            ];
            echo json_encode($response);
        }
    }


    public function galeri()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $response = [
                'status' => 'success',
                'title' => 'Home Galeri',
                'html' => $this->load->view('home/galeri', '', true),
            ];
            echo json_encode($response);
        }
    }

    public function sekapur_sirih()
    {
        if (!$this->input->is_ajax_request()) {
            $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            $this->session->set_userdata('no_ajax', '1');
            $this->session->set_userdata('no_ajax_url', $url);
            $this->load->view('default');
        } else {
            $response = [
                'status' => 'success',
                'title' => 'Home Sekapur Sirih',
                'html' => $this->load->view('home/sekapur_sirih', '', true),
            ];
            echo json_encode($response);
        }
    }
}

/* End of file Home.php */
