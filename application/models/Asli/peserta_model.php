<?php
class Peserta_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function get_peserta($slug = FALSE)
    {
        if ($slug === FALSE) {
            $query = $this->db->get('peserta');
            return $query->result_array();
        }
        $query = $this->db->get_where(
            'peserta',
            array('idPeserta' => $slug)
        );
        return $query->row_array();
    }
    public function set_peserta()
    {
        $this->load->helper('url');
        $data = array(
            'idPeserta' => $this->input->post('id'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        );
        return $this->db->insert('peserta', $data);
    }
    public function update_peserta()
    {
        $this->load->helper('url');
        $id = $this->input->post('id');
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        );
        $this->db->where('idPeserta', $id);
        return $this->db->update('peserta', $data);
    }

    public function delete_peserta($slug)
    {
        $this->db->delete('peserta', array('idPeserta' => $slug));
    }
}
