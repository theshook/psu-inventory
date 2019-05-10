<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventories extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Inventory';

    $this->load->view('templates/header', $data);
    $this->load->view('inventories/index');
    $this->load->view('templates/footer');
  }

  public function show($pro_no)
  {
    $data['title'] = 'Inventory';
    $data['stocks'] = $this->Inventory_model->get_stock_inventory($pro_no);
    $data['release'] = $this->Release_model->get_release_inventory($pro_no);
    $this->load->view('templates/header', $data);
    $this->load->view('inventories/show', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Inventory';
    $data['products'] = $this->Product_model->get_products()->result();
    $data['supplier'] = $this->Supply_model->get_supplies()->result();
    $this->load->view('templates/header', $data);
    $this->load->view('inventories/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules(
      'invent_refno',
      'Reference Number',
      'required|min_length[2]|is_unique[inventory.invent_refno]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules('invent_quantity', 'Quantity', 'required|greater_than[0]|integer');
    $this->form_validation->set_rules('invent_date', 'Date Receive', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->create();
    } else {
      $this->Inventory_model->create_inventory();
      $this->session->set_flashdata('success', 'Stock successfully created.');
      redirect('inventories');
    }
  }

  public function edit($invent_no)
  {
    $data['title'] = 'Inventory';
    $data['products'] = $this->Product_model->get_products()->result();
    $data['supplier'] = $this->Supply_model->get_supplies()->result();
    $data['inventory'] = $this->Inventory_model->get_inventory($invent_no);
    $this->load->view('templates/header', $data);
    $this->load->view('inventories/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($invent_no)
  {
    $this->form_validation->set_rules(
      'invent_refno',
      'Reference Number',
      'required|min_length[2]',
      array(
        'required'      => 'You have not provided %s.',
      )
    );
    $this->form_validation->set_rules('invent_quantity', 'Quantity', 'required|greater_than[0]|integer');
    $this->form_validation->set_rules('invent_date', 'Date Receive', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->edit($invent_no);
    } else {
      $this->Inventory_model->update_inventory($invent_no);
      $this->session->set_flashdata('success', 'Stock successfully updated.');
      redirect('inventories');
    }
  }

  public function soft_delete($invent_no)
  {
    $this->session->set_flashdata('success', 'Department successfully deleted');
    $this->Inventory_model->soft_delete($invent_no);
    redirect('inventories');
  }

  public function stocks($pro_no)
  {
    $inventories = $this->Inventory_model->get_total_stock_inventory($pro_no)->result();
    $release = $this->Release_model->get_total_release_inventory_ajax($pro_no)->result();
    if ($release) {
      $inventories[0]->invent_quantity -= $release[0]->release_quantity;
    } 
    echo json_encode($inventories);
    exit();
  }

  // Ajax with datatables
  public function inventories_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $inventories = $this->Inventory_model->get_inventories();
    $total_inventories = $this->Inventory_model->get_total_inventories();
    $releases = $this->Release_model->get_releases_no_waiting();

    $data = array();
    foreach ($inventories->result() as $r) {

      $data[] = array(
        $r->pro_no,
        $r->pro_code,
        $r->pro_title,
        $r->unit_name,
        $r->invent_quantity,
      );
    }

    foreach ($data as $key => $d) {
      foreach ($releases->result() as $i => $r) {
        if ($data[$key][0] == $r->pro_no) {
          $data[$key][4] -= $r->release_quantity;
        }
      }
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_inventories,
      "recordsFiltered" => $total_inventories,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
