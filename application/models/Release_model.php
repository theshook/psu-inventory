<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Release_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_releases()
  {
    $this->db->order_by('release_date', 'DESC');
    // $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    // $this->db->select('SUM(release_quantity) AS release_quantity, release_inventory.pro_no, pro_code, pro_title, unit_name, release_date', FALSE);
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0
      ));
  }

  public function get_releases_no_waiting()
  {
    $this->db->order_by('release_date', 'DESC');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'release_status' => 'Release'
      ));
  }

  public function get_total_release_inventory($pro_no)
  {
    $this->db->order_by('release_date', 'DESC');
    // $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    // $this->db->select('SUM(release_quantity) AS release_quantity', FALSE);
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'release_inventory.pro_no' => $pro_no
      ));
  }

  public function get_total_release_inventory_ajax($pro_no)
  {
    $this->db->order_by('release_date', 'DESC');
    $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->select('SUM(release_quantity) AS release_quantity, release_inventory.pro_no', FALSE);
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'release_inventory.pro_no' => $pro_no
      ));
  }

  public function get_release_inventory($pro_no)
  {
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $query = $this->db->get_where('release_inventory', array(
      'release_inventory.pro_no' => $pro_no,
      'release_inactive' => 0,
      'release_delete' => 0
    ));

    return $query->result();
  }

  public function get_release($release_no)
  {
	$this->db->join('accountables', 'accountables.release_no = release_inventory.release_no');
	$this->db->join('users', 'users.user_no = accountables.user_no');
	$this->db->join('employments', 'employments.user_no = users.user_no');
	$this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $query = $this->db->get_where('release_inventory', array(
      'release_inventory.release_no' => $release_no,
      'release_inactive' => 0,
      'release_delete' => 0
    ));

    return $query->result();
  }

  public function get_total_release()
  {
    $query = $this->db->select('COUNT(*) as num')->get('release_inventory');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function get_released ($request_no)
  {
    
  }

/*************************************************************** Equipments ***********************************************/
  public function get_releases_equipments()
  {
    $this->db->order_by('release_date', 'DESC');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'pro_isEquipment' => 1
      ));
  }

  public function get_total_release_equipments()
  {
    $query = $this->db->select('COUNT(*) as num')->get('release_inventory');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }
/**************************************************************************************************************************/

/*************************************************************** Consumables ***********************************************/
  public function get_releases_consumables()
  {
    $this->db->order_by('release_date', 'DESC');
    $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    return $this->db
      ->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'pro_isEquipment' => 0
      ));
  }

  public function get_total_release_consumables()
  {
    $query = $this->db->select('COUNT(*) as num')->get('release_inventory');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }
/**************************************************************************************************************************/

  public function create_release()
  {
    $data = array(
        'pro_no' => $this->input->post('pro_no'),
        'release_quantity' => $this->input->post('release_quantity'),
        'release_date' => $this->input->post('release_date'),
        'release_remark' => $this->input->post('release_remark'),
        'release_encode' => $this->session->userdata('user_no'),
      );

    $this->db->insert('release_inventory', $data);
    $insert_id = $this->db->insert_id();
	
    $acc = array(
        'user_no' => $this->input->post('user_no'),
        'release_no' => $insert_id,
        'acc_encode' => $this->session->userdata('user_no'),
      );

    return $this->db->insert('accountables', $acc);
  }

  public function update_release($release_no)
  {
    $data = $this->input->post(null, true);
    $data['release_encode'] = $this->session->userdata('user_no');

    $this->db->where('release_no', $release_no);
    $this->db->where('release_inactive', 0);
    $this->db->where('release_delete', 0);
    return $this->db->update('release_inventory', $data);
  }

  public function soft_delete($release_no)
  {
    $this->db->where('release_no', $release_no);
    $this->db->set('release_delete', 1);
    $this->db->set('release_encode', $this->session->userdata('user_no'));
    return $this->db->update('release_inventory');
  }

  public function release_product($release_no)
  {
    $this->db->where('release_no', $release_no);
    $this->db->set('release_status', 'Release');
    return $this->db->update('release_inventory');
  }

  public function check_departcode_exists($depart_code, $depart_no)
  {
    $this->db->where('depart_code', $depart_code);
    $this->db->where_not_in('depart_no', $depart_no);
    $query = $this->db->get('departments');
    return $query->num_rows();
  }
}
