<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_Unit_model extends CI_Model
{
  public function get_units()
  {
    $this->db->order_by('unit_name');
    return $this->db
      ->get_where('units', array(
        'unit_inactive' => 0,
        'unit_delete' => 0
      ));
  }

  public function get_unit($unit_no)
  {
    $query = $this->db->get_where('units', array(
      'unit_no' => $unit_no,
      'unit_inactive' => 0,
      'unit_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_units()
  {
    $query = $this->db->select('COUNT(*) as num')->get('units');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_unit()
  {
    $data = array(
      'unit_name' => $this->input->post('unit_name')
    );
    return $this->db->insert('units', $data);
  }

  public function update_unit($unit_no)
  {
    $data = array(
      'unit_name' => $this->input->post('unit_name')
    );
    $this->db->where('unit_no', $unit_no);
    return $this->db->update('units', $data);
  }

  public function soft_delete_unit($unit_no)
  {
    $this->db->where('unit_no', $unit_no);
    $this->db->set('unit_delete', 1);
    return $this->db->update('units');
  }

  public function check_unitname_exists($unit_name, $unit_no)
  {
    $this->db->where('unit_name', $unit_name);
    $this->db->where_not_in('unit_no', $unit_no);
    $query = $this->db->get('units');
    return $query->num_rows();
  }
}
