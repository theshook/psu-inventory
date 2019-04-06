<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserLogin_model extends CI_Model
{
  public function create_account($user_no)
  {
    $data = array(
      'user_no' => $user_no,
      'login_name' => $this->input->post('login_name'),
      'login_pword' => $this->input->post('login_pword')
    );

    return $this->db->insert('user_login', $data);
  }

  public function login($username, $password)
  {
    // Validate
    $this->db->join('users', 'users.user_no = user_login.user_no');
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
