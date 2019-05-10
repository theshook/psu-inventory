<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_products()
  {
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->join('categories', 'categories.cat_no = products.cat_no');
    $this->db->order_by('pro_code');
    return $this->db
      ->get_where('products', array(
        'pro_inactive' => 0,
        'pro_delete' => 0
      ));
  }

  public function get_product($pro_no)
  {
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->join('categories', 'categories.cat_no = products.cat_no');
    $query = $this->db->get_where('products', array(
      'pro_no' => $pro_no,
      'pro_inactive' => 0,
      'pro_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_products()
  {
    $query = $this->db->select('COUNT(*) as num')->get('products');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_product()
  {
    $data = array(
      'cat_no' => $this->input->post('cat_no'),
      'unit_no' => $this->input->post('unit_no'),
      'pro_code' => $this->input->post('pro_code'),
      'pro_title' => $this->input->post('pro_title'),
      'pro_price' => $this->input->post('pro_price'),
      'pro_isEquipment' => $this->input->post('pro_isEquipment'),
      'pro_encode' => $this->session->userdata('user_no')
    );

    return $this->db->insert('products', $data);
  }

  public function update_product($pro_no)
  {
    $data = array(
      'cat_no' => $this->input->post('cat_no'),
      'unit_no' => $this->input->post('unit_no'),
      'pro_code' => $this->input->post('pro_code'),
      'pro_title' => $this->input->post('pro_title'),
      'pro_price' => $this->input->post('pro_price'),
      'pro_isEquipment' => $this->input->post('pro_isEquipment'),
      'pro_encode' => $this->session->userdata('user_no')
    );
    $this->db->where('pro_no', $pro_no);
    return $this->db->update('products', $data);
  }

  public function soft_delete_product($pro_no)
  {
    $this->db->where('pro_no', $pro_no);
    $this->db->set('pro_delete', 1);
    $this->db->set('pro_encode', $this->session->userdata('user_no'));
    return $this->db->update('products');
  }

  public function check_procode_exists($pro_code, $pro_no)
  {
    $this->db->where('pro_code', $pro_code);
    $this->db->where_not_in('pro_no', $pro_no);
    $query = $this->db->get('products');
    return $query->num_rows();
  }
}
