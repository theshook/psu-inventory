<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Request';
    $this->load->view('templates/header', $data);
    $this->load->view('requests/index');
    $this->load->view('templates/footer');
  }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'Request';
    $data['products'] = $this->Product_model->get_products()->result();
    $this->load->view('templates/header', $data);
    $this->load->view('requests/create', $data);
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $result = $this->Request_Item_model->create_request_items();
    if ($result === FALSE) {
      $this->session->set_flashdata('success', 'Whooops request failed.');
      $this->create();
    } else {
      $this->session->set_flashdata('success', 'User successfully created.');
      redirect('requests');
    }
  }

  public function edit()
  { }

  public function update()
  { }

  public function soft_delete()
  { }

  // Ajax with datatables
  public function requests_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $requests = $this->Request_model->get_requests();
    $total_requests = $this->Request_model->get_total_requests();

    $data = array();

    foreach ($requests->result() as $r) {

      $data[] = array(
        $r->request_no,
        $r->user_lname . ', ' . $r->user_fname . ' ' . $r->user_mname[0],
        $r->depart_title,
        $r->request_code,
        $r->request_purpose,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_requests,
      "recordsFiltered" => $total_requests,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
