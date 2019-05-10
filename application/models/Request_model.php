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

  public function get_requests_by_department()
  {
    $this->db->join('users', 'users.user_no = requests.user_no');
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $this->db->group_by('requests.request_no');
    return $this->db
      ->get_where('requests', array(
        'request_inactive' => 0,
        'request_delete' => 0,
        'employments.depart_no' => $this->session->userdata('depart_no')
      ));
  }

  public function get_request($request_no)
  {
    $this->db->join('users', 'users.user_no = requests.user_no');
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $this->db->group_by('requests.request_no');
    return $this->db
      ->get_where('requests', array(
        'request_no' => $request_no,
        'request_inactive' => 0,
        'request_delete' => 0
      ))->result();
  }

  public function get_total_requests()
  {
    $query = $this->db->select('COUNT(*) as num')->get('requests');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function get_total_requests_by_department()
  {
    $this->db->join('users', 'users.user_no = requests.user_no');
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $query = $this->db->select('COUNT(*) as num')->get_where('requests', array(
        'request_inactive' => 0,
        'request_delete' => 0,
        'employments.depart_no' => $this->session->userdata('depart_no')
        ));
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
      'request_code' => $this->input->post('request_code'),
      'request_encode' => $this->session->userdata('user_no')
    );

    $this->db->insert('requests', $data);
    return $this->db->insert_id();
  }

  public function update_request($request_no)
  {
    $data = array(
      'user_no' => $this->session->userdata('user_no'),
      'depart_no' => $this->session->userdata('depart_no'),
      'request_purpose' => $this->input->post('request_purpose'),
      'request_code' => $this->input->post('request_code'),
      'request_encode' => $this->session->userdata('user_no')
    );
    $this->db->where('request_no', $request_no);
    $this->db->update('requests', $data);
    return $request_no;
  }

  public function soft_delete($request_no)
  {
    $this->db->where('request_no', $request_no);
    $this->db->set('request_delete', 1);
    $this->db->set('request_encode', $this->session->userdata('user_no'));
    return $this->db->update('requests');
  }
}
