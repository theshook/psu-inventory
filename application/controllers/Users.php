<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    // initiate faker
    $this->faker = Faker\Factory::create();
  }

  public function index()
  {
    $data['title'] = 'Users';
    $this->load->view('templates/header', $data);
    $this->load->view('users/index', array());
    $this->load->view('templates/footer');
  }

  public function show($user_no)
  {
    $data['title'] = 'Users';
    $data['user'] = $this->UserModel->get_user($user_no);
    $data['departs'] = $this->Department_model->get_departments()->result();

    $this->load->view('templates/header', $data);
    $this->load->view('users/show', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Users';
    $data['departs'] = $this->Department_model->get_departments()->result();
    $this->form_validation->set_rules(
      'user_id',
      'User ID',
      'required|min_length[5]|is_unique[users.user_id]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules('user_lname', 'Last Name', 'required');
    $this->form_validation->set_rules('user_fname', 'First Name', 'required');
    $this->form_validation->set_rules('user_mname', 'Middle Name', 'required');
    $this->form_validation->set_rules('employ_start', 'Employment Start', 'required');
    $this->form_validation->set_rules('employ_rate', 'Rate', 'required|integer|is_natural_no_zero');

    if (!$this->input->post('present') == 1) {
      $this->form_validation->set_rules('employ_end', 'Employment End', 'required');
    }

    if ($this->form_validation->run() === false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/create', $data);
      $this->load->view('templates/footer');
    } else {
      $this->UserModel->create_user();
      $this->session->set_flashdata('success', 'User successfully created.');
      redirect('users');
    }
  }

  public function edit($id)
  {
    $data['title'] = 'Users';

    $data['user'] = $this->UserModel->get_user($id);
    $data['departs'] = $this->Department_model->get_departments()->result();
    if (empty($data['user'])) {
      show_404();
    }

    $this->load->view('templates/header', $data);
    $this->load->view('users/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update($user_no)
  {
    $this->form_validation->set_rules(
      'user_id',
      'User ID',
      'required|min_length[5]|callback_check_userid_exists',
      array(
        'required'      => 'You have not provided %s.',
      )
    );
    $this->form_validation->set_rules('user_lname', 'Last Name', 'required');
    $this->form_validation->set_rules('user_fname', 'First Name', 'required');
    $this->form_validation->set_rules('user_mname', 'Middle Name', 'required');

    if ($this->form_validation->run() === false) {
      $this->edit($user_no);
    } else {
      $this->UserModel->update_user($user_no);
      $this->session->set_flashdata('success', 'User information successfully updated.');
      redirect('users');
    }
  }

  public function soft_delete($user_no)
  {
    $this->session->set_flashdata('success', 'User information successfully deleted.');
    $this->UserModel->soft_delete_user($user_no);
    redirect('users');
  }

  public function check_userid_exists($user_id)
  {
    // Get the user number based on url
    $user_no = $this->uri->segment(3);
    $result = $this->UserModel->check_userid_exists($user_id, $user_no);
    if ($result == 0) {
      return true;
    } else {
      $this->form_validation->set_message('check_userid_exists', 'This User ID already exists.');
      return false;
    }
  }

  // Ajax with datatables
  public function users_page()
  {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $users = $this->UserModel->get_users();
    $total_users = $this->UserModel->get_total_users();

    $data = array();

    foreach ($users->result() as $r) {

      $data[] = array(
        $r->user_no,
        $r->user_id,
        $r->user_lname,
        $r->user_fname,
        $r->user_mname
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_users,
      "recordsFiltered" => $total_users,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  // Seed User table
  function seed()
  {
    $this->_truncate_db();
    $this->_seed_users(25);
  }

  function _seed_users($limit)
  {
    // create a bunch of base buyer accounts
    for ($i = 0; $i < $limit; $i++) {


      $data = array(
        'user_id' => $this->faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'user_fname' => $this->faker->firstName,
        'user_lname' => $this->faker->lastName,
        'user_mname' => $this->faker->city,
      );

      $data_employment = array(
        'user_no' => $i + 1,
        'depart_no' => $this->faker->numberBetween($min = 1, $max = 25),
        'employ_start' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'employ_end' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'employ_rate' => $this->faker->numberBetween($min = 80, $max = 400)
      );

      $this->Seed_model->insert($data, $data_employment);
    }
    $this->session->set_flashdata('message', 'Database Seeds Successfully 25 Records Added In Database');
    redirect('users/index', 'location');
  }

  private function _truncate_db()
  {
    $this->Seed_model->truncate();
  }
}
