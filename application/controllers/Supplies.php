<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplies extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Supply';

    $this->load->view('templates/header', $data);
    $this->load->view('supplies/index');
    $this->load->view('templates/footer');
  }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'Supply';

    $this->load->view('templates/header', $data);
    $this->load->view('supplies/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules(
      'sup_name',
      'Supplier Name',
      'required|is_unique[supplies.sup_name]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $this->create();
    } else {
      $this->Supply_model->create_supply();
      $this->session->set_flashdata('success', 'Supplies successfully created.');
      redirect('supplies');
    }
  }

  public function edit($sup_no)
  {
    $data['title'] = 'Supply';
    $data['supply'] = $this->Supply_model->get_supply($sup_no);
    $this->load->view('templates/header', $data);
    $this->load->view('supplies/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($sup_no)
  {
    $this->form_validation->set_rules(
      'sup_name',
      'Supplier Name',
      'required|callback_check_supname_exists'
    );

    if ($this->form_validation->run() === FALSE) {
      $this->edit($sup_no);
    } else {
      $this->Supply_model->update_supply($sup_no);
      $this->session->set_flashdata('success', 'Supplier information successfully updated.');
      redirect('supplies');
    }
  }

  public function soft_delete($sup_no)
  {
    $this->session->set_flashdata('success', 'Supplier successfully deleted');
    $this->Supply_model->soft_delete_supply($sup_no);
    redirect('supplies');
  }

  public function check_supname_exists($sup_name)
  {
    $sup_no = $this->uri->segment(3);
    $result = $this->Supply_model->check_supname_exists($sup_name, $sup_no);

    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_supname_exists', 'This Supplier already exists.');
      return false;
    }
  }

  // Ajax with datatables
  public function supplies_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $supplies = $this->Supply_model->get_supplies();
    $total_supplies = $this->Supply_model->get_total_supplies();

    $data = array();

    foreach ($supplies->result() as $r) {

      $data[] = array(
        $r->sup_no,
        $r->sup_name,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_supplies,
      "recordsFiltered" => $total_supplies,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
