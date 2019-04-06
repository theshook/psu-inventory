<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_departments()
  {
    $this->db->order_by('depart_code');
    return $this->db
      ->get_where('departments', array(
        'depart_inactive' => 0,
        'depart_delete' => 0
      ));
  }

  public function get_department($depart_no)
  {
    $query = $this->db->get_where('departments', array(
      'depart_no' => $depart_no,
      'depart_inactive' => 0,
      'depart_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_departments()
  {
    $query = $this->db->select('COUNT(*) as num')->get('departments');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_department()
  {
    $data = array(
      'depart_code' => $this->input->post('depart_code'),
      'depart_title' => $this->input->post('depart_title')
    );
    return $this->db->insert('departments', $data);
  }

  public function update_department($depart_no)
  {
    $data = array(
      'depart_code' => $this->input->post('depart_code'),
      'depart_title' => $this->input->post('depart_title')
    );
    $this->db->where('depart_no', $depart_no);
    $this->db->where('depart_inactive', 0);
    $this->db->where('depart_delete', 0);
    return $this->db->update('departments', $data);
  }

  public function soft_delete_department($depart_no)
  {
    $this->db->where('depart_no', $depart_no);
    $this->db->set('depart_delete', 1);
    return $this->db->update('departments');
  }

  public function check_departcode_exists($depart_code, $depart_no)
  {
    $this->db->where('depart_code', $depart_code);
    $this->db->where_not_in('depart_no', $depart_no);
    $query = $this->db->get('departments');
    return $query->num_rows();
  }

  // Database Seed
  function insert($options = array())
  {
    $this->db->insert('departments', $options);
  }
  function truncate()
  {
    $this->db->truncate('departments');
  }
  function get()
  {
    $query = $this->db->get('departments');
    return $query->result();
  }
}
