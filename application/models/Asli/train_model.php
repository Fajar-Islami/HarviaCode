<?php 
class Train_model extends CI_Model { 
	public function __construct() { 
       $this->load->database();
	}
	public function get_trains($slug = FALSE) {
	 if ($slug === FALSE) { 
		  $query = $this->db->get('training'); 
		  return $query->result_array(); 
	}
	 $query = $this->db->get_where('training',  
			  array('idTraining' => $slug));
	 return $query->row_array(); 
	}
	public function set_trains(){
	$this->load->helper('url');
	$data = array('idTraining' => $this->input->post('id'),
	      'nama' => $this->input->post('nama'),
	      'jenis' => $this->input->post('jenis'),
	      'tempat' => $this->input->post('tempat'),
	      'tglMulai' => $this->input->post('tglMulai'),
	      'tglAkhir' => $this->input->post('tglAkhir'),
	      'kapasitas' => $this->input->post('kapasitas')
		);
	return $this->db->insert('training', $data);
	}
	public function update_trains()
	{
	$this->load->helper('url');
	$id= $this->input->post('id');
	$data = array(
		'nama' => $this->input->post('nama'),
		'jenis' => $this->input->post('jenis'),
		'tempat' => $this->input->post('tempat'),
		'tglMulai' => $this->input->post('tglMulai'),
		'tglAkhir' => $this->input->post('tglAkhir'),
		'kapasitas' => $this->input->post('kapasitas')
		);
	$this->db->where('idTraining', $id);
	return $this->db->update('training', $data);
	}

	public function delete_trains($slug)
	{
		$this->db->delete('training', array('idTraining' => $slug)); 	
	}

} 
?>