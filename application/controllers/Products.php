<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
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
    $data['title'] = 'Product';

    $this->load->view('templates/header', $data);
    $this->load->view('products/index');
    $this->load->view('templates/footer');
  }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'Product';
    $data['categories'] = $this->Prod_Category_model->get_categories()->result();
    $data['units'] = $this->Prod_Unit_model->get_units()->result();

    $this->load->view('templates/header', $data);
    $this->load->view('products/create', $data);
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules(
      'pro_code',
      'Product Code',
      'required|min_length[2]|is_unique[products.pro_code]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules('pro_title', 'Product Title', 'required|is_unique[products.pro_title]');
    $this->form_validation->set_rules('pro_price', 'Product Price', 'required');

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $this->Product_model->create_product();
      $this->session->set_flashdata('success', 'Product successfully created.');
      redirect('products');
    }
  }

  public function edit($pro_no)
  {
    $data['title'] = 'Product';
    $data['product'] = $this->Product_model->get_product($pro_no);
    $data['categories'] = $this->Prod_Category_model->get_categories()->result();
    $data['units'] = $this->Prod_Unit_model->get_units()->result();

    $this->load->view('templates/header', $data);
    $this->load->view('products/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($pro_no)
  {
    $this->form_validation->set_rules(
      'pro_code',
      'Product Code',
      'required|min_length[2]|callback_check_procode_exists',
      array(
        'required'      => 'You have not provided %s.',
      )
    );
    $this->form_validation->set_rules('pro_title', 'Product Title', 'required');
    $this->form_validation->set_rules('pro_price', 'Product Price', 'required');

    if ($this->form_validation->run() === false) {
      $this->edit($pro_no);
    } else {
      $this->Product_model->update_product($pro_no);
      $this->session->set_flashdata('success', 'Product information successfully updated.');
      redirect('products');
    }
  }

  public function soft_delete($pro_code)
  {
    $this->session->set_flashdata('success', 'Product successfully deleted');
    $this->Product_model->soft_delete_product($pro_code);
    redirect('products');
  }

  public function check_procode_exists($pro_code)
  {
    $pro_no = $this->uri->segment(3);
    $result = $this->Product_model->check_procode_exists($pro_code, $pro_no);

    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_procode_exists', 'This Product Code already exists.');
      return false;
    }
  }

  // Ajax with datatables
  public function products_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $products = $this->Product_model->get_products();
    $total_products = $this->Product_model->get_total_products();

    $data = array();

    foreach ($products->result() as $r) {

      $data[] = array(
        $r->pro_no,
        $r->pro_code,
        $r->pro_title,
        $r->pro_price,
        $r->unit_name,
        ($r->pro_isEquipment) ? 'Equipment' : 'Consumable',
        $r->cat_name,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_products,
      "recordsFiltered" => $total_products,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
