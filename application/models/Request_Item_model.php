<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_Item_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function create_request_items()
  {
    $pro_no = $this->input->post('prod_no[]');
    $ri_quantity = $this->input->post('ri_quantity[]');

    $this->db->trans_start();

    $request_no = $this->Request_model->create_request();

    for ($i = 0; $i < count($pro_no); $i++) {
      $data = array(
        'pro_no' => $pro_no[$i],
        'ri_quantity' => $ri_quantity[$i],
        'request_no' => $request_no
      );
      $this->db->insert('request_items', $data);
    }

    $this->db->trans_complete();

    return $this->db->trans_status();
  }
}
