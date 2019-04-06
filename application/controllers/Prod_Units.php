<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_Units extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Product';

    $this->load->view('templates/header', $data);
    $this->load->view('prod_units/index');
    $this->load->view('templates/footer');
  }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'Product';

    $this->load->view('templates/header', $data);
    $this->load->view('prod_units/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules('unit_name', 'Unit Name', 'required|is_unique[units.unit_name]', array(
      'required'      => 'You have not provided %s.',
      'is_unique'     => 'This %s already exists.'
    ));

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $this->Prod_Unit_model->create_unit();
      $this->session->set_flashdata('success', 'Unit successfully created.');
      redirect('prod_units');
    }
  }

  public function edit($unit_no)
  {
    $data['title'] = 'Product';
    $data['unit'] = $this->Prod_Unit_model->get_unit($unit_no);

    if (empty($data['unit'])) {
      show_404();
    }

    $this->load->view('templates/header', $data);
    $this->load->view('prod_units/edit');
    $this->load->view('templates/footer');
  }

  public function update($unit_no)
  {
    $this->form_validation->set_rules(
      'unit_name',
      'Unit Name',
      'required|min_length[2]|callback_check_unitname_exists',
      array(
        'required'      => 'You have not provided %s.',
      )
    );

    if ($this->form_validation->run() === false) {
      $this->edit($unit_no);
    } else {
      $this->Prod_Unit_model->update_unit($unit_no);
      $this->session->set_flashdata('success', 'Unit information successfully updated.');
      redirect('prod_units');
    }
  }

  public function soft_delete($unit_no)
  {
    $this->session->set_flashdata('success', 'Unit successfully deleted');
    $this->Prod_Unit_model->soft_delete_unit($unit_no);
    redirect('prod_units');
  }

  public function check_unitname_exists($unit_name)
  {
    $depart_no = $this->uri->segment(3);
    $result = $this->Prod_Unit_model->check_unitname_exists($unit_name, $depart_no);

    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_unitname_exists', 'This Unit name already exists.');
      return false;
    }
  }

  // Ajax with datatables
  public function units_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $units = $this->Prod_Unit_model->get_units();
    $total_units = $this->Prod_Unit_model->get_total_units();

    $data = array();

    foreach ($units->result() as $r) {

      $data[] = array(
        $r->unit_no,
        $r->unit_name,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_units,
      "recordsFiltered" => $total_units,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
