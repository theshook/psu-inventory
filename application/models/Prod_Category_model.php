<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_Category_model extends CI_Model
{
  public function get_categories()
  {
    $this->db->order_by('cat_name');
    return $this->db
      ->get_where('categories', array(
        'cat_inactive' => 0,
        'cat_delete' => 0
      ));
  }

  public function get_category($cat_no)
  {
    $query = $this->db->get_where('categories', array(
      'cat_no' => $cat_no,
      'cat_inactive' => 0,
      'cat_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_categories()
  {
    $query = $this->db->select('COUNT(*) as num')->get('categories');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_category()
  {
    $data = array(
      'cat_name' => $this->input->post('cat_name'),
      'cat_encode' => $this->session->userdata('user_no')
    );
    return $this->db->insert('categories', $data);
  }

  public function update_category($cat_no)
  {
    $data = array(
      'cat_name' => $this->input->post('cat_name'),
      'cat_encode' => $this->session->userdata('user_no')
    );
    $this->db->where('cat_no', $cat_no);
    return $this->db->update('categories', $data);
  }

  public function soft_delete_category($cat_no)
  {
    $this->db->where('cat_no', $cat_no);
    $this->db->set('cat_delete', 1);
    $this->db->set('cat_encode', $this->session->userdata('user_no'));
    return $this->db->update('categories');
  }

  public function check_catname_exists($cat_name, $cat_no)
  {
    $this->db->where('cat_name', $cat_name);
    $this->db->where_not_in('cat_no', $cat_no);
    $query = $this->db->get('categories');
    return $query->num_rows();
  }
}
