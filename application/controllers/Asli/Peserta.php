<?php
class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('peserta_model');
    }
    public function index()
    {
        $data['peserta'] = $this->peserta_model->get_peserta();
        $data['title'] = 'Peserta archive';
        $this->load->view('templates/header', $data);
        $this->load->view('peserta/index', $data);
        $this->load->view('templates/footer');
    }
    public function view($slug)
    {
        $data['peserta_item'] = $this->peserta_model->get_peserta($slug);
        if (empty($data['peserta_item'])) {
            show_404();
        }
        $data['title'] = $data['peserta_item']['nama'];
        $this->load->view('templates/header', $data);
        $this->load->view('peserta/view', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Input Data Peserta';
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat');
        $this->form_validation->set_rules('hp');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('peserta/create');
            $this->load->view('templates/footer');
        } else {
            $this->peserta_model->set_peserta();
            $this->load->view('templates/header', $data);
            $this->load->view('peserta/success');
            $this->load->view('templates/footer');
        }
    }

    public function update($slug)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Update Data Peserta';
        $data['slug'] = $slug;
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat');
        $this->form_validation->set_rules('hp');
        if ($this->form_validation->run() === FALSE) {
            $data['peserta_item'] = $this->peserta_model->get_peserta($slug);
            $this->load->view('templates/header', $data);
            $this->load->view('peserta/update', $data);
            $this->load->view('templates/footer');
        } else {
            $this->peserta_model->update_peserta();
            $this->load->view('templates/header', $data);
            $this->load->view('peserta');
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug)
    {
        if (!empty($slug)) {
            $this->peserta_model->delete_peserta($slug);
        }
        $data['peserta'] = $this->peserta_model->get_peserta();
        $data['title'] = 'Peserta archive';
        $this->load->view('templates/header', $data);
        $this->load->view('peserta/index', $data);
        $this->load->view('templates/footer');
    }
}
