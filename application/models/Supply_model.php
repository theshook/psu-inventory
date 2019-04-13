<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supply_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_supplies()
  {
    $this->db->order_by('sup_name');
    return $this->db
      ->get_where('supplies', array(
        'sup_inactive' => 0,
        'sup_delete' => 0
      ));
  }

  public function get_supply($sup_no)
  {
    $query = $this->db->get_where('supplies', array(
      'sup_no' => $sup_no,
      'sup_inactive' => 0,
      'sup_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_supplies()
  {
    $query = $this->db->select('COUNT(*) as num')->get('supplies');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_supply()
  {
    $data = array(
      'sup_name' => $this->input->post('sup_name'),
      'sup_encode' => $this->session->userdata('user_no')
    );

    if ($this->db->insert('supplies', $data) === FALSE) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function update_supply($sup_no)
  {
    $data = array(
      'sup_name' => $this->input->post('sup_name'),
      'sup_encode' => $this->session->userdata('user_no')
    );
    $this->db->where('sup_no', $sup_no);
    $this->db->where('sup_inactive', 0);
    $this->db->where('sup_delete', 0);
    return $this->db->update('supplies', $data);
  }

  public function soft_delete_supply($sup_no)
  {
    $this->db->where('sup_no', $sup_no);
    $this->db->set('sup_delete', 1);
    $this->db->set('sup_encode', $this->session->userdata('user_no'));
    return $this->db->update('supplies');
  }

  public function check_supname_exists($sup_name, $sup_no)
  {
    $this->db->where('sup_name', $sup_name);
    $this->db->where_not_in('sup_no', $sup_no);
    $query = $this->db->get('supplies');
    return $query->num_rows();
  }
}
