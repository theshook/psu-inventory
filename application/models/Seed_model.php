<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seed_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  function insert($options = array(), $options2 = array())
  {
    $this->db->insert('users', $options);
    $this->db->insert('employments', $options2);
  }
  function truncate()
  {
    $this->db->truncate('users');
    $this->db->truncate('employments');
  }
  function get()
  {
    $query = $this->db->get('users');
    return $query->result();
  }
}
