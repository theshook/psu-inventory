<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_Categories extends CI_Controller
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
    $this->load->view('prod_categories/index');
    $this->load->view('templates/footer');
  }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'Product';

    $this->load->view('templates/header', $data);
    $this->load->view('prod_categories/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules('cat_name', 'Category Name', 'required|is_unique[categories.cat_name]', array(
      'required'      => 'You have not provided %s.',
      'is_unique'     => 'This %s already exists.'
    ));

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $this->Prod_Category_model->create_category();
      $this->session->set_flashdata('success', 'Category successfully created.');
      redirect('prod_categories');
    }
  }

  public function edit($cat_no)
  {
    $data['title'] = 'Product';
    $data['cat'] = $this->Prod_Category_model->get_category($cat_no);

    if (empty($data['cat'])) {
      show_404();
    }

    $this->load->view('templates/header', $data);
    $this->load->view('prod_categories/edit');
    $this->load->view('templates/footer');
  }

  public function update($cat_no)
  {
    $this->form_validation->set_rules(
      'cat_name',
      'Category Name',
      'required|min_length[2]|callback_check_catname_exists',
      array(
        'required'      => 'You have not provided %s.',
      )
    );

    if ($this->form_validation->run() === false) {
      $this->edit($cat_no);
    } else {
      $this->Prod_Category_model->update_category($cat_no);
      $this->session->set_flashdata('success', 'Unit information successfully updated.');
      redirect('prod_categories');
    }
  }

  public function soft_delete($cat_no)
  {
    $this->session->set_flashdata('success', 'Unit successfully deleted');
    $this->Prod_Category_model->soft_delete_category($cat_no);
    redirect('prod_categories');
  }

  public function check_catname_exists($cat_name)
  {
    $cat_no = $this->uri->segment(3);
    $result = $this->Prod_Category_model->check_catname_exists($cat_name, $cat_no);

    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_catname_exists', 'This category name already exists.');
      return false;
    }
  }

  // Ajax with datatables
  public function categories_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $categories = $this->Prod_Category_model->get_categories();
    $total_categories = $this->Prod_Category_model->get_total_categories();

    $data = array();

    foreach ($categories->result() as $r) {

      $data[] = array(
        $r->cat_no,
        $r->cat_name,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_categories,
      "recordsFiltered" => $total_categories,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }
}
