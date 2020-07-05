<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Training extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Training_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'training/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'training/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'training/index.html';
            $config['first_url'] = base_url() . 'training/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Training_model->total_rows($q);
        $training = $this->Training_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'training_data' => $training,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('training/training_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Training_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idTraining' => $row->idTraining,
		'nama' => $row->nama,
		'jenis' => $row->jenis,
		'tempat' => $row->tempat,
		'tglMulai' => $row->tglMulai,
		'tglAkhir' => $row->tglAkhir,
		'kapasitas' => $row->kapasitas,
	    );
            $this->load->view('training/training_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('training'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('training/create_action'),
	    'idTraining' => set_value('idTraining'),
	    'nama' => set_value('nama'),
	    'jenis' => set_value('jenis'),
	    'tempat' => set_value('tempat'),
	    'tglMulai' => set_value('tglMulai'),
	    'tglAkhir' => set_value('tglAkhir'),
	    'kapasitas' => set_value('kapasitas'),
	);
        $this->load->view('training/training_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tglMulai' => $this->input->post('tglMulai',TRUE),
		'tglAkhir' => $this->input->post('tglAkhir',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->Training_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('training'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Training_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('training/update_action'),
		'idTraining' => set_value('idTraining', $row->idTraining),
		'nama' => set_value('nama', $row->nama),
		'jenis' => set_value('jenis', $row->jenis),
		'tempat' => set_value('tempat', $row->tempat),
		'tglMulai' => set_value('tglMulai', $row->tglMulai),
		'tglAkhir' => set_value('tglAkhir', $row->tglAkhir),
		'kapasitas' => set_value('kapasitas', $row->kapasitas),
	    );
            $this->load->view('training/training_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('training'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idTraining', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tglMulai' => $this->input->post('tglMulai',TRUE),
		'tglAkhir' => $this->input->post('tglAkhir',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->Training_model->update($this->input->post('idTraining', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('training'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Training_model->get_by_id($id);

        if ($row) {
            $this->Training_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('training'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('training'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('tglMulai', 'tglmulai', 'trim|required');
	$this->form_validation->set_rules('tglAkhir', 'tglakhir', 'trim|required');
	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');

	$this->form_validation->set_rules('idTraining', 'idTraining', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "training.xls";
        $judul = "training";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "TglMulai");
	xlsWriteLabel($tablehead, $kolomhead++, "TglAkhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas");

	foreach ($this->Training_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglMulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglAkhir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kapasitas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=training.doc");

        $data = array(
            'training_data' => $this->Training_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('training/training_doc',$data);
    }

}

/* End of file Training.php */
/* Location: ./application/controllers/Training.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-27 04:39:06 */
/* http://harviacode.com */