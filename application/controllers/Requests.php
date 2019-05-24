<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
  }
  public function index()
  {
    $data['title'] = 'Request';
    $this->load->view('templates/header', $data);
    $this->load->view('requests/index');
    $this->load->view('templates/footer');
  }

  public function show($request_no)
  {
    $data['title'] = 'Request';
    $data['request_items'] = $this->Request_Item_model->get_request_item($request_no);
    $data['request'] = $this->Request_model->get_request($request_no);
    $data['approved'] = $this->Request_Item_model->get_approved($request_no);
    //$data['release'] = $this->Release_model->get_released($request_no);
    $this->load->view('templates/header', $data);
    $this->load->view('requests/show', $data);
    $this->load->view('templates/footer');
  }

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
    $this->form_validation->set_rules('request_purpose', 'Purpose', 'required');
    $this->form_validation->set_rules('request_code', 'Request Code', 'required');
    $this->form_validation->set_rules('ri_quantity[]', 'Quantity', 'required|greater_than[0]|integer');
    if ($this->form_validation->run() === FALSE) {
      $this->create();
    } else {
      $result = $this->Request_Item_model->create_request_items();
      if ($result === FALSE) {
        $this->session->set_flashdata('error', 'Whooops request failed.');
        $this->create();
      } else {
        $this->session->set_flashdata('success', 'Request successfully created.');
        redirect('requests');
      }
    }
  }

  public function edit($request_no)
  {
    $data['title'] = 'Request';
    $data['request_items'] = $this->Request_Item_model->get_request_item($request_no);
    $data['request'] = $this->Request_model->get_request($request_no);
    $data['products'] = $this->Product_model->get_products()->result();
    $this->load->view('templates/header', $data);
    $this->load->view('requests/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($request_no)
  {
    $this->form_validation->set_rules('request_purpose', 'Purpose', 'required');
    $this->form_validation->set_rules('ri_quantity[]', 'Quantity', 'required|greater_than[0]|integer');
    if ($this->form_validation->run() === FALSE) {
      $this->create();
    } else {

      $result = $this->Request_Item_model->update_request_items($request_no);
      if ($result === FALSE) {
        $this->session->set_flashdata('error', 'Whooops request failed.');
        $this->create();
      } else {
        $this->session->set_flashdata('success', 'Request successfully created.');
        redirect('requests');
      }
    }
  }

  public function soft_delete($request_no)
  {
    $result_req = $this->Request_model->soft_delete($request_no);
    $result_ri = $this->Request_Item_model->soft_delete($request_no);
    if ($result_req != FALSE && $result_ri != FALSE) {
      $this->session->set_flashdata('success', 'Request successfully deleted.');
    } else {
      $this->session->set_flashdata('error', 'Whooops request failed.');
    }
    redirect('requests');
  }

  public function approve($request_no, $ri_no)
  {
    $result_ri = $this->Request_Item_model->approve_ri($ri_no);
    if ($result_ri != FALSE) {
      $this->session->set_flashdata('success', 'Request successfully approved.');
    } else {
      $this->session->set_flashdata('error', 'Whooops something went wrong.');
    }
    redirect('requests/show/' . $request_no);
  }

  public function deny($request_no, $ri_no)
  {
    $result_ri = $this->Request_Item_model->deny_ri($ri_no);
    if ($result_ri != FALSE) {
      $this->session->set_flashdata('success', 'Request denied.');
    } else {
      $this->session->set_flashdata('error', 'Whooops something went wrong.');
    }
    redirect('requests/show/' . $request_no);
  }

  // Ajax with datatables
  public function requests_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    if ($this->session->userdata('role_id') != 4) :
      $requests = $this->Request_model->get_requests();
      $total_requests = $this->Request_model->get_total_requests();
    else :
      $requests = $this->Request_model->get_requests_by_department();
      $total_requests = $this->Request_model->get_total_requests_by_department();
    endif;

    $data = array();

    foreach ($requests->result() as $r) {

      $data[] = array(
        $r->request_no,
        $r->user_no,
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
