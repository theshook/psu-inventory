<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserLogin_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_user_account($user_no)
  {
    $this->db->join('user_login', 'user_login.user_no = users.user_no');
    $query = $this->db->get_where('users', array(
      'users.user_no' => $user_no,
      'user_encode_delete' => NULL
    ));
    return $query->result();
  }

  public function create_account($user_no)
  {
    $data = array(
      'user_no' => $user_no,
      'login_name' => $this->input->post('login_name'),
      'login_pword' => md5($this->input->post('login_pword')),
      'login_encode' => $this->session->userdata('user_no')
    );

    return $this->db->insert('user_login', $data);
  }

  public function update_account($user_no)
  {
    $data = array(
      'login_pword' => md5($this->input->post('login_pword')),
      'login_encode' => $this->session->userdata('user_no')
    );

    $this->db->where('user_no', $user_no);
    return $this->db->update('user_login', $data);
  }

  public function check_account_exists($old_pword, $user_no)
  {
    $this->db->where('login_pword', md5($old_pword));
    $this->db->where('user_no', $user_no);
    $query = $this->db->get('user_login');
    return $query->num_rows();
  }

  public function login($username, $password)
  {
    // Validate
    $this->db->join('users', 'users.user_no = user_login.user_no');
    $this->db->join('employments', 'employments.user_no = users.user_no');
    $this->db->join('departments', 'departments.depart_no = employments.depart_no');
    $this->db->where('login_name', $username);
    $this->db->where('login_pword', $password);
    $result = $this->db->get('user_login');

    if ($result->num_rows() == 1) {
      return $result->row(0);
    } else {
      return false;
    }
  }
}
