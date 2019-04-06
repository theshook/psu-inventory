<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  public function get_users()
  {
    return $this->db
      ->get_where('users', array(
        'user_encode_delete' => NULL,
        'user_inactive' => 0,
        'user_delete' => 0
      ));
  }

  public function get_user($user_no)
  {
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $query = $this->db->get_where('users', array(
      'users.user_no' => $user_no,
      'user_encode_delete' => NULL
    ));
    return $query->result();
  }

  public function get_total_users()
  {
    $query = $this->db->select('COUNT(*) as num')->get('users');
    $result = $query->row();

    if (isset($result)) return $result->num;
    return 0;
  }

  public function create_user()
  {
    $data = array(
      'user_id' => $this->input->post('user_id'),
      'user_lname' => $this->input->post('user_lname'),
      'user_fname' => $this->input->post('user_fname'),
      'user_mname' => $this->input->post('user_mname')
    );
    $this->db->insert('users', $data);

    $user_no = $this->db->insert_id();

    return $this->Employment_model->create_user_employ($user_no);
  }

  public function update_user($user_no)
  {
    $data = array(
      'user_id' => $this->input->post('user_id'),
      'user_lname' => $this->input->post('user_lname'),
      'user_fname' => $this->input->post('user_fname'),
      'user_mname' => $this->input->post('user_mname')
    );
    $this->db->where('user_no', $user_no);
    $this->db->where('user_encode_delete', NULL);
    $this->db->where('user_inactive', 0);
    $this->db->where('user_delete', 0);
    $this->db->update('users', $data);
    return $this->Employment_model->update_user_employ($user_no);
  }

  public function soft_delete_user($user_no)
  {
    $this->db->where('user_no', $user_no);
    $this->db->set('user_encode_delete', 'NOW()', FALSE);
    return $this->db->update('users');
  }

  public function check_userid_exists($user_id, $user_no)
  {
    $this->db->where('user_id', $user_id);
    $this->db->where_not_in('user_no', $user_no);
    $query = $this->db->get('users');
    return $query->num_rows();
  }
}
