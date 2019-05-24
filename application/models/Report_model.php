<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
	public function __construct() {
		$this->load->database();
	}

	public function get_property_acknowledgement_data()
  {
  	$this->db->group_by('employments.user_no');
  	$this->db->order_by('user_lname');
  	$this->db->join('release_inventory', 'release_inventory.release_no = accountables.release_no');
  	// $this->db->join('products', 'products.pro_no = release_inventory.pro_no');
  	// $this->db->join('units', 'units.unit_no = products.unit_no');
  	$this->db->join('employments', 'employments.user_no = accountables.user_no');
  	$this->db->join('users', 'users.user_no = employments.user_no');
  	$this->db->join('departments', 'departments.depart_no = employments.depart_no');
    return $this->db
      ->get_where('accountables', array(
        'acc_inactive' => 0,
        'acc_delete' => 0,
        'release_status' => 'Release'
      ));
  }

  public function get_property_acknowledgement_show($user_no)
  {
  	$this->db->group_by('release_inventory.release_no');
  	$this->db->order_by('user_lname');
  	$this->db->join('release_inventory', 'release_inventory.release_no = accountables.release_no');
  	$this->db->join('products', 'products.pro_no = release_inventory.pro_no');
  	$this->db->join('units', 'units.unit_no = products.unit_no');
  	$this->db->join('employments', 'employments.user_no = accountables.user_no');
  	$this->db->join('users', 'users.user_no = employments.user_no');
  	$this->db->join('departments', 'departments.depart_no = employments.depart_no');
    return $this->db
      ->get_where('accountables', array(
        'acc_inactive' => 0,
        'acc_delete' => 0,
        'users.user_no' => $user_no,
        'release_status' => 'Release'
      ));
  }
  
  public function get_property_acknowledgement_total_price($user_no)
  {
	 $this->db->group_by('employments.user_no');
  	$this->db->order_by('user_lname');
  	$this->db->join('release_inventory', 'release_inventory.release_no = accountables.release_no');
  	$this->db->join('products', 'products.pro_no = release_inventory.pro_no');
  	$this->db->join('units', 'units.unit_no = products.unit_no');
  	$this->db->join('employments', 'employments.user_no = accountables.user_no');
  	$this->db->join('users', 'users.user_no = employments.user_no');
  	$this->db->join('departments', 'departments.depart_no = employments.depart_no');
	$this->db->select('SUM(pro_price * release_quantity) AS amount', FALSE);
    return $this->db
      ->get_where('accountables', array(
        'acc_inactive' => 0,
        'acc_delete' => 0,
        'users.user_no' => $user_no,
        'release_status' => 'Release'
      ));
  }

  public function get_total_property_acknowledgement_data()
  {
  	$this->db->join('employments', 'employments.user_no = accountables.user_no');
  	$this->db->join('users', 'users.user_no = employments.user_no');
  	$this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $query = $this->db->select('COUNT(*) as num')->get_where('accountables', array('acc_inactive' => 0, 'acc_delete' => 0));
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function get_categories() {
    return $this->db->get_where('categories', array(
      'cat_delete' => 0
    ));
  }

  public function get_products() {

    $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'products.cat_no = categories.cat_no');
    $this->db->join('inventory', 'inventory.pro_no = products.pro_no');
    $this->db->join('release_inventory', 'release_inventory.pro_no = products.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $this->db->select('inventory.pro_no, pro_code, pro_title, unit_name, SUM(invent_quantity) AS quantity');

    if ($this->input->get('dates')) {
      $dates = explode("_", $this->input->get('dates'));
      $this->db->where('release_date >=', $dates[0]);
      $this->db->where('release_date <=', $dates[1]);
    }

    if ($this->input->get('cat_no') == 'null') {
     return $this->db->get_where('categories', array(
        'cat_inactive' => 0,
        'cat_delete' => 0
     ));
    } else {
     return $this->db->get_where('categories', array(
        'cat_inactive' => 0,
        'cat_delete' => 0,
        'products.cat_no' => $this->input->get('cat_no')
     ));
    }
  }

  public function get_products_release() {
      $this->db->group_by('release_inventory.pro_no');
      $this->db->select('pro_no, SUM(release_quantity) AS total_release');
     return $this->db->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0
     ));
  }

  public function get_all_year() {
    $this->db->group_by('year');
    $this->db->select('YEAR(release_date) as year');
    return $this->db->get_where('release_inventory', array(
      'release_inactive' => 0,
      'release_delete' => 0
    ));
  }

  public function get_all_month() {
    $this->db->group_by('month');
    $this->db->select('MONTH(release_date) as month');
    return $this->db->get_where('release_inventory', array(
      'release_inactive' => 0,
      'release_delete' => 0
    ));
  }

  public function get_monthly_total_price () {

    $this->db->group_by('month');
    $this->db->join('products', 'release_inventory.pro_no = products.pro_no');
    $this->db->select('YEAR(release_date), MONTH(release_date) as month, release_quantity, pro_price, SUM(release_quantity * pro_price) as amount');
    if ($this->input->get('month')) {
      return $this->db->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'YEAR(release_date)' => $this->input->get('year'),
        'MONTH(release_date)' => $this->input->get('month')
      ));
    } else {
      return $this->db->get_where('release_inventory', array(
        'release_inactive' => 0,
        'release_delete' => 0,
        'YEAR(release_date)' => $this->input->get('year'),
      ));
    }
  }

  public function get_yearly_total_price() {
    if ($this->input->get('year') != 'null') {
      $this->db->where('YEAR(release_date) = '.$this->input->get('year').'');
    }

    $this->db->group_by('year');
    $this->db->join('products', 'release_inventory.pro_no = products.pro_no');
    $this->db->select('YEAR(release_date) as year, MONTH(release_date) as month, release_quantity, pro_price, SUM(release_quantity * pro_price) as amount');
    return $this->db->get_where('release_inventory', array(
      'release_inactive' => 0,
      'release_delete' => 0
    ));
  }

  public function get_monthly_price () {
    $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'release_inventory.pro_no = products.pro_no');
    $this->db->select('YEAR(release_date) as year, 
      MONTH(release_date) as month, 
      pro_title,
      release_quantity, 
      pro_price, 
      SUM(release_quantity * pro_price) as amount');

    return $this->db->get_where('release_inventory', array(
      'release_inactive' => 0,
      'release_delete' => 0,
      'YEAR(release_date)' => $this->input->get('year'),
      'MONTH(release_date)' => $this->input->get('month')
    ));
  }

  public function get_monthly_price_w_unit () {
    $this->db->group_by('release_inventory.pro_no');
    $this->db->join('products', 'release_inventory.pro_no = products.pro_no');
    $this->db->join('units', 'products.unit_no = units.unit_no');
    $this->db->select('YEAR(release_date) as year, 
      MONTH(release_date) as month, 
      products.pro_no,
      pro_title,
      release_quantity, 
      pro_price, 
      unit_name,
      SUM(release_quantity * pro_price) as amount');

    return $this->db->get_where('release_inventory', array(
      'release_inactive' => 0,
      'release_delete' => 0,
      'YEAR(release_date)' => $this->input->get('year'),
      'MONTH(release_date)' => $this->input->get('month')
    ));
  }


}