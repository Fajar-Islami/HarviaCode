<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta_training extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peserta_training_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'peserta_training/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'peserta_training/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'peserta_training/index.html';
            $config['first_url'] = base_url() . 'peserta_training/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Peserta_training_model->total_rows($q);
        $peserta_training = $this->Peserta_training_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'peserta_training_data' => $peserta_training,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('peserta_training/peserta_training_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Peserta_training_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idTraining' => $row->idTraining,
		'idPeserta' => $row->idPeserta,
		'statusPembayaran' => $row->statusPembayaran,
	    );
            $this->load->view('peserta_training/peserta_training_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_training'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('peserta_training/create_action'),
	    'idTraining' => set_value('idTraining'),
	    'idPeserta' => set_value('idPeserta'),
	    'statusPembayaran' => set_value('statusPembayaran'),
	);
        $this->load->view('peserta_training/peserta_training_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idPeserta' => $this->input->post('idPeserta',TRUE),
		'statusPembayaran' => $this->input->post('statusPembayaran',TRUE),
	    );

            $this->Peserta_training_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('peserta_training'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Peserta_training_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta_training/update_action'),
		'idTraining' => set_value('idTraining', $row->idTraining),
		'idPeserta' => set_value('idPeserta', $row->idPeserta),
		'statusPembayaran' => set_value('statusPembayaran', $row->statusPembayaran),
	    );
            $this->load->view('peserta_training/peserta_training_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_training'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idTraining', TRUE));
        } else {
            $data = array(
		'idPeserta' => $this->input->post('idPeserta',TRUE),
		'statusPembayaran' => $this->input->post('statusPembayaran',TRUE),
	    );

            $this->Peserta_training_model->update($this->input->post('idTraining', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('peserta_training'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Peserta_training_model->get_by_id($id);

        if ($row) {
            $this->Peserta_training_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('peserta_training'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_training'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idPeserta', 'idpeserta', 'trim|required');
	$this->form_validation->set_rules('statusPembayaran', 'statuspembayaran', 'trim|required');

	$this->form_validation->set_rules('idTraining', 'idTraining', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "peserta_training.xls";
        $judul = "peserta_training";
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
	xlsWriteLabel($tablehead, $kolomhead++, "IdPeserta");
	xlsWriteLabel($tablehead, $kolomhead++, "StatusPembayaran");

	foreach ($this->Peserta_training_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idPeserta);
	    xlsWriteLabel($tablebody, $kolombody++, $data->statusPembayaran);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=peserta_training.doc");

        $data = array(
            'peserta_training_data' => $this->Peserta_training_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('peserta_training/peserta_training_doc',$data);
    }

}

/* End of file Peserta_training.php */
/* Location: ./application/controllers/Peserta_training.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-27 05:41:52 */
/* http://harviacode.com */