<?php

class Employment_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function create_user_employ($user_no)
  {
    $data = array(
      'user_no' => $user_no,
      'depart_no' => $this->input->post('depart'),
      'employ_start' => $this->input->post('employ_start'),
      'employ_end' => ($this->input->post('present') == 1) ? NULL : $this->input->post('employ_end'),
      'employ_rate' => $this->input->post('employ_rate'),
      'employ_encode' => $this->session->userdata('user_no')
    );

    return $this->db->insert('employments', $data);
  }

  public function update_user_employ($user_no)
  {
    $data = array(
      'depart_no' => $this->input->post('depart'),
      'employ_start' => $this->input->post('employ_start'),
      'employ_end' => ($this->input->post('present') == 1) ? NULL : $this->input->post('employ_end'),
      'employ_rate' => $this->input->post('employ_rate'),
      'employ_encode' => $this->session->userdata('user_no')
    );
    $this->db->where('user_no', $user_no);
    return $this->db->update('employments', $data);
  }

  public function check_userno_exists($user_no)
  {
    $this->db->where('user_no', $user_no);
    $query = $this->db->get('users');
    return $query->num_rows();
  }
}
