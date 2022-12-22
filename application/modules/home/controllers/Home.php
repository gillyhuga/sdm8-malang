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
        $this->data['visi_misi'] = $this->home->get_list('fr_visi_misi',  array('status' => 1));
        $this->data['kata_sambutan'] = $this->home->get_single('fr_kata_sambutan',  array('id' => 1));
        $this->data['slider'] = $this->home->get_list('fr_slider', array('status' => 1), '', '', '', 'order_menu', 'ASC');
        $this->data['guru_staf'] = $this->home->get_list('fr_guru', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['testimonial'] = $this->home->get_list('fr_testimonial', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['berita'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['_setting'] = $this->home->get_single('settings', array('id' => 1));
        $this->template->title('Beranda');
        $this->template->view('index', $this->data);
    }

    public function sambutan_kepala()
    {
        $this->data['kata_sambutan'] = $this->home->get_single('fr_kata_sambutan',  array('id' => 1));
        $this->template->title('Kata Sambutan');
        $this->template->view('kata_sambutan', $this->data);
    }

    public function profil()
    {
        $this->data['profil'] = $this->home->get_single('fr_kata_sambutan',  array('id' => 1));
        $this->template->title('Profil');
        $this->template->view('profil', $this->data);
    }

    public function budaya_sekolah()
    {
        $this->data['budaya_sekolah'] = $this->home->get_list('fr_budaya_sekolah', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Budaya Sekolah');
        $this->template->view('budaya_sekolah', $this->data);
    }

    public function visi_misi()
    {
        $this->data['visi_misi'] = $this->home->get_list('fr_visi_misi',  array('status' => 1));
        $this->template->title('Visi Misi');
        $this->template->view('visi_misi', $this->data);
    }

    public function guru()
    {
        $this->data['guru'] = $this->home->get_list('fr_guru', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Guru dan Staf Pendidik');
        $this->template->view('guru', $this->data);
    }

    public function ebook()
    {
        $this->data['ebooks'] = $this->home->get_list('ebooks', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Ebook');
        $this->template->view('ebooks', $this->data);
    }

    public function ebook_detail($id = false)
    {
        $this->data['ebook'] = $this->home->get_single('ebooks',  array('id' => $id));
        $this->template->title('Ebook Detail');
        $this->template->view('ebook', $this->data);
    }

    public function agenda()
    {
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Agenda');
        $this->template->view('agenda', $this->data);
    }

    public function berita()
    {
        $this->data['berita'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['latest'] = $this->home->get_list('fr_berita', array('status' => 1), '', '', '5', 'id', 'ASC');
        $this->data['kategori'] = $this->home->get_list('fr_kategori_berita', array('kategori' => 1), '', '', '5', 'id', 'ASC');
        $this->template->title('Berita');
        $this->template->view('berita', $this->data);
    }

    public function berita_detail($id = false)
    {
        $this->data['berita'] = $this->home->get_single('fr_berita', array('id' => $id));
        $this->template->title('Berita Detail');
        $this->template->view('berita_detail', $this->data);
    }


    public function galeri()
    {
        $this->data['test'] = $this->home->get_list('fr_galleri', array('status' => 1), '', '', '','id', 'ASC');
        $this->template->title('Galeri');
        $this->template->view('galleri', $this->data);
    }

    public function news($id = false)
    {
        $this->template->title('News Detail');
        $this->template->view('news');
    }


    public function alquran()
    {
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Alquran');
        $this->template->view('alquran', $this->data);
    }

  
    public function ismubaris()
    {
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Ismubaris');
        $this->template->view('ismubaris', $this->data);
    }

    public function komite()
    {
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Komite Sekolah');
        $this->template->view('komite', $this->data);
    }

    public function alumni()
    {
        $this->data['agenda'] = $this->home->get_list('fr_agenda', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->template->title('Alumni');
        $this->template->view('alumni', $this->data);
    }



}

/* End of file Home.php */
