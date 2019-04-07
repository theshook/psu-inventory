<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departments extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // initiate faker
    $this->faker = Faker\Factory::create();

    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
  }

  public function index()
  {
    $data['title'] = 'Department';

    $this->load->view('templates/header', $data);
    $this->load->view('department/index');
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Department';

    $this->load->view('templates/header', $data);
    $this->load->view('department/create');
    $this->load->view('templates/footer');
  }

  public function store()
  {
    $this->form_validation->set_rules(
      'depart_code',
      'Department Code',
      'required|min_length[2]|is_unique[departments.depart_code]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules('depart_title', 'Department Title', 'required');

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $this->Department_model->create_department();
      $this->session->set_flashdata('success', 'Department successfully created.');
      redirect('departments');
    }
  }

  public function edit($depart_no)
  {
    $data['title'] = 'Department';
    $data['depart'] = $this->Department_model->get_department($depart_no);

    if (empty($data['depart'])) {
      show_404();
    }

    $this->load->view('templates/header', $data);
    $this->load->view('department/edit');
    $this->load->view('templates/footer');
  }

  public function update($depart_no)
  {
    $this->form_validation->set_rules(
      'depart_code',
      'Department Code',
      'required|min_length[2]|callback_check_departcode_exists',
      array(
        'required'      => 'You have not provided %s.',
      )
    );
    $this->form_validation->set_rules('depart_title', 'Department Title', 'required');

    if ($this->form_validation->run() === false) {
      $this->edit($depart_no);
    } else {
      $this->Department_model->update_department($depart_no);
      $this->session->set_flashdata('success', 'Department information successfully updated.');
      redirect('departments');
    }
  }

  public function soft_delete($depart_no)
  {
    $this->session->set_flashdata('success', 'Department successfully deleted');
    $this->Department_model->soft_delete_department($depart_no);
    redirect('departments');
  }

  // Ajax with datatables
  public function departments_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $departmets = $this->Department_model->get_departments();
    $total_departments = $this->Department_model->get_total_departments();

    $data = array();

    foreach ($departmets->result() as $r) {

      $data[] = array(
        $r->depart_no,
        $r->depart_code,
        $r->depart_title,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_departments,
      "recordsFiltered" => $total_departments,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function check_departcode_exists($depart_code)
  {
    $depart_no = $this->uri->segment(3);
    $result = $this->Department_model->check_departcode_exists($depart_code, $depart_no);

    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_departcode_exists', 'This Department Code already exists.');
      return false;
    }
  }

  function seed()
  {
    $this->_truncate_db();
    $this->_seed_departments(25);
  }

  function _seed_departments($limit)
  {
    for ($i = 0; $i < $limit; $i++) {
      $data = array(
        'depart_code' => strtoupper($this->faker->unique()->word),
        'depart_title' => $this->faker->unique()->name,
      );
      $this->Department_model->insert($data);
    }
    $this->session->set_flashdata('message', 'Database Seeds Successfully 25 Records Added In Database');
    redirect('departments/index', 'location');
  }

  private function _truncate_db()
  {
    $this->Department_model->truncate();
  }
}
