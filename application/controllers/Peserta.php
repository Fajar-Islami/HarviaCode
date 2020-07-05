<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peserta_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'peserta/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'peserta/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'peserta/index.html';
            $config['first_url'] = base_url() . 'peserta/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Peserta_model->total_rows($q);
        $peserta = $this->Peserta_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'peserta_data' => $peserta,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('peserta/peserta_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Peserta_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idPeserta' => $row->idPeserta,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'hp' => $row->hp,
	    );
            $this->load->view('peserta/peserta_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('peserta/create_action'),
	    'idPeserta' => set_value('idPeserta'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'hp' => set_value('hp'),
	);
        $this->load->view('peserta/peserta_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
	    );

            $this->Peserta_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('peserta'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Peserta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta/update_action'),
		'idPeserta' => set_value('idPeserta', $row->idPeserta),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'hp' => set_value('hp', $row->hp),
	    );
            $this->load->view('peserta/peserta_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idPeserta', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
	    );

            $this->Peserta_model->update($this->input->post('idPeserta', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('peserta'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Peserta_model->get_by_id($id);

        if ($row) {
            $this->Peserta_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('peserta'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');

	$this->form_validation->set_rules('idPeserta', 'idPeserta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "peserta.xls";
        $judul = "peserta";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Hp");

	foreach ($this->Peserta_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=peserta.doc");

        $data = array(
            'peserta_data' => $this->Peserta_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('peserta/peserta_doc',$data);
    }

}

/* End of file Peserta.php */
/* Location: ./application/controllers/Peserta.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-17 10:18:55 */
/* http://harviacode.com */