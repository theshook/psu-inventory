<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }
  public function get_requests()
  {
    $this->db->join('users', 'users.user_no = requests.user_no');
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $this->db->group_by('requests.request_no');
    return $this->db
      ->get_where('requests', array(
        'request_inactive' => 0,
        'request_delete' => 0
      ));
  }

  public function get_total_requests()
  {
    $query = $this->db->select('COUNT(*) as num')->get('requests');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_request()
  {
    $data = array(
      'user_no' => $this->session->userdata('user_no'),
      'depart_no' => $this->session->userdata('depart_no'),
      'request_purpose' => $this->input->post('request_purpose'),
    );

    $this->db->insert('requests', $data);
    return $this->db->insert_id();
  }
}
