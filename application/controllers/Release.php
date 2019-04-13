<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Release extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Inventory';

    $this->load->view('templates/header', $data);
    $this->load->view('release/index');
    $this->load->view('templates/footer');
  }

  public function show($pro_no)
  {
    $data['title'] = 'Inventory';
    $data['release'] = $this->Release_model->get_release_inventory($pro_no);
    $this->load->view('templates/header', $data);
    $this->load->view('release/show', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Inventory';
    $data['products'] = $this->Product_model->get_products()->result();
    $this->load->view('templates/header', $data);
    $this->load->view('release/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules('release_quantity', 'Quantity', 'required|greater_than[0]|integer');
    $this->form_validation->set_rules('release_date', 'Release Date', 'required');
    $this->form_validation->set_rules('release_remark', 'Remarks', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->create();
    } else {
      $this->Release_model->create_release();
      $this->session->set_flashdata('success', 'Stock successfully created.');
      redirect('inventories');
    }
  }

  public function edit($release_no)
  {
    $data['title'] = 'Inventory';
    $data['products'] = $this->Product_model->get_products()->result();
    $data['supplier'] = $this->Supply_model->get_supplies()->result();
    $data['release'] = $this->Release_model->get_release($release_no);
    $this->load->view('templates/header', $data);
    $this->load->view('release/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($release_no)
  {
    $this->form_validation->set_rules('release_quantity', 'Quantity', 'required|greater_than[0]|integer');
    $this->form_validation->set_rules('release_date', 'Release Date', 'required');
    $this->form_validation->set_rules('release_remark', 'Remarks', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->edit($release_no);
    } else {
      $this->Release_model->update_release($release_no);
      $this->session->set_flashdata('success', 'Stock successfully updated.');
      redirect('release');
    }
  }

  public function soft_delete($release_no)
  {
    $this->session->set_flashdata('success', 'Release successfully deleted');
    $this->Release_model->soft_delete($release_no);
    redirect('release');
  }

  // Ajax with datatables
  public function releases_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $release = $this->Release_model->get_releases();
    $total_release = $this->Release_model->get_total_release();

    $data = array();
    foreach ($release->result() as $r) {

      $data[] = array(
        $r->pro_no,
        $r->pro_code,
        $r->pro_title,
        $r->unit_name,
        $r->release_quantity,
        date('M d, Y', strtotime($r->release_date)),
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_release,
      "recordsFiltered" => $total_release,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
