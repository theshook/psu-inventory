<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_roles()
  {
    $this->db->order_by('role_name', 'ASC');
    return $this->db->get('roles');
  }
}
