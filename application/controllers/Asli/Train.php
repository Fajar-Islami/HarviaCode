<?php 
class Train extends CI_Controller { 
	public function __construct() { 
       parent::__construct(); 
       $this->load->model('train_model');} 
	public function index() { 
		$data['trains']= $this->train_model->get_trains();    
		$data['title'] = 'Trainings archive'; 
		$this->load->view('templates/header', $data);
		$this->load->view('trains/index', $data); 
		$this->load->view('templates/footer');
	}
	public function view($slug) { 
       $data['trains_item'] = $this->train_model->get_trains($slug);
	   if (empty($data['trains_item'])) { 
			show_404(); } 
		$data['title'] = $data['trains_item']['nama']; 
		$this->load->view('templates/header', $data); 
		$this->load->view('trains/view', $data); 
		$this->load->view('templates/footer');  

	}
	public function create(){
	$this->load->helper('form');
	$this->load->library('form_validation');
	$data['title'] = 'Input Data Training';
	$this->form_validation->set_rules('id', 'Id', 'required');
	$this->form_validation->set_rules('nama', 'Nama', 'required');
	$this->form_validation->set_rules('jenis');
	$this->form_validation->set_rules('tempat');
	$this->form_validation->set_rules('tglAkhir');
	$this->form_validation->set_rules('tglAwal');
	$this->form_validation->set_rules('kapasitas');
	if ($this->form_validation->run() === FALSE)
	{
		$this->load->view('templates/header', $data);	
		$this->load->view('trains/create');
		$this->load->view('templates/footer');		
	}
	else
	{
		$this->train_model->set_trains();
		$this->load->view('templates/header', $data);	
		$this->load->view('trains/success');
		$this->load->view('templates/footer');
	}
}

	public function update($slug){
	$this->load->helper('form');
	$this->load->library('form_validation');
	$data['title'] = 'Update Data Training';
	$data['slug'] = $slug;
	$this->form_validation->set_rules('id', 'Id', 'required');
	$this->form_validation->set_rules('nama', 'Nama', 'required');
	$this->form_validation->set_rules('jenis');
	$this->form_validation->set_rules('tempat');
	$this->form_validation->set_rules('tglAkhir');
	$this->form_validation->set_rules('tglAwal');
	$this->form_validation->set_rules('kapasitas');
	if ($this->form_validation->run() === FALSE)
	{
		$data['trains_item'] = $this->train_model->get_trains($slug);
		$this->load->view('templates/header', $data);				
		$this->load->view('trains/update',$data);
		$this->load->view('templates/footer');		
	}
	else
	{
		$this->train_model->update_trains();
		$this->load->view('templates/header', $data);				
		$this->load->view('trains');
		$this->load->view('templates/footer');
	}
	}

   public function delete($slug){
	if (!empty($slug))
	{
	 $this->train_model->delete_trains($slug);
	}
	$data['trains'] = $this->train_model->get_trains();
	$data['title'] = 'Trainings archive'; 
	$this->load->view('templates/header', $data);	
	$this->load->view('trains/index',$data);
	$this->load->view('templates/footer');		
   }

}
