<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_Item_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_request_item($request_no)
  {
    $this->db->join('requests', 'requests.request_no = request_items.request_no');
    $this->db->join('products', 'products.pro_no = request_items.pro_no');
    $this->db->join('units', 'units.unit_no = products.unit_no');
    $query = $this->db->get_where('request_items', array(
      'request_items.request_no' => $request_no,
      'ri_inactive' => 0,
      'ri_delete' => 0
      ));
    return $query->result();
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
        'request_no' => $request_no,
        'ri_encode' => $this->session->userdata('user_no')
      );
      $this->db->insert('request_items', $data);
    }

    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function update_request_items($request_no)
  {
    $pro_no = $this->input->post('prod_no[]');
    $ri_quantity = $this->input->post('ri_quantity[]');

    $this->db->trans_start();
    $this->Request_model->update_request($request_no);
    $this->soft_delete($request_no);
    for ($i = 0; $i < count($pro_no); $i++) {
      $data = array(
        'pro_no' => $pro_no[$i],
        'ri_quantity' => $ri_quantity[$i],
        'request_no' => $request_no,
        'ri_encode' => $this->session->userdata('user_no')
      );
      $this->db->insert('request_items', $data);
    }
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      return false;
    } else {
      return true;
    }
  }

  public function soft_delete($request_no)
  {
    $this->db->where('request_no', $request_no);
    $this->db->set('ri_delete', 1);
    $this->db->set('ri_encode', $this->session->userdata('user_no'));
    return $this->db->update('request_items');
  }
}
