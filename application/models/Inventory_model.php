<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_inventories()
  {
    $this->db->order_by('invent_date', 'DESC');
    $this->db->group_by('inventory.pro_no');
    $this->db->join('products', 'products.pro_no = inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->select('SUM(invent_quantity) AS invent_quantity, inventory.pro_no, pro_code, pro_title, unit_name, invent_date', FALSE);
    return $this->db
      ->get_where('inventory', array(
        'invent_inactive' => 0,
        'invent_delete' => 0
      ));
  }

  public function get_total_stock_inventory($pro_no)
  {
    $this->db->order_by('invent_date', 'DESC');
    $this->db->group_by('inventory.pro_no');
    $this->db->join('products', 'products.pro_no = inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->select('SUM(invent_quantity) AS invent_quantity, inventory.pro_no', FALSE);
    return $this->db
      ->get_where('inventory', array(
        'invent_inactive' => 0,
        'invent_delete' => 0,
        'inventory.pro_no' => $pro_no
      ));
  }

  public function get_stock_inventory($pro_no)
  {
    $this->db->join('products', 'products.pro_no = inventory.pro_no');
    $this->db->join('supplies', 'inventory.sup_no = supplies.sup_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $query = $this->db->get_where('inventory', array(
      'inventory.pro_no' => $pro_no,
      'invent_inactive' => 0,
      'invent_delete' => 0
    ));

    return $query->result();
  }

  public function get_inventory($invent_no)
  {
    $query = $this->db->get_where('inventory', array(
      'invent_no' => $invent_no,
      'invent_inactive' => 0,
      'invent_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_inventories()
  {
    $query = $this->db->select('COUNT(*) as num')->get('inventory');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_inventory()
  {
    $data = $this->input->post(null, true);
    $data['invent_encode'] = $this->session->userdata('user_no');
    return $this->db->insert('inventory', $data);
  }

  public function update_inventory($invent_no)
  {
    $data = $this->input->post(null, true);
    $data['invent_encode'] = $this->session->userdata('user_no');

    $this->db->where('invent_no', $invent_no);
    $this->db->where('invent_inactive', 0);
    $this->db->where('invent_delete', 0);
    return $this->db->update('inventory', $data);
  }

  public function soft_delete($invent_no)
  {
    $this->db->where('invent_no', $invent_no);
    $this->db->set('invent_delete', 1);
    $this->db->set('invent_encode', $this->session->userdata('user_no'));
    return $this->db->update('inventory');
  }

  public function check_departcode_exists($depart_code, $depart_no)
  {
    $this->db->where('depart_code', $depart_code);
    $this->db->where_not_in('depart_no', $depart_no);
    $query = $this->db->get('departments');
    return $query->num_rows();
  }
}
