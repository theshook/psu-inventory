<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsersLogin extends CI_Controller
{

  public function login()
  {
    $this->form_validation->set_rules('login_name', 'Username', 'required');
    $this->form_validation->set_rules('login_pword', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('userslogin/login');
      $this->load->view('templates/footer');
    } else {
      $username = $this->input->post('login_name');
      $password = md5($this->input->post('login_pword'));

      $user = $this->UserLogin_model->login($username, $password);

      if ($user) {
        // create session
        $user_data = array(
          'user_no' => $user->user_no,
          'user_fname' => $user->user_fname,
          'user_lname' => $user->user_lname,
          'depart_code' => $user->depart_code,
          'login_name' => $username,
          'logged_in' => true
        );

        $this->session->set_userdata($user_data);
        $this->session->set_flashdata('success', 'You are now logged in.');
        redirect('/');
      } else {
        $this->session->set_flashdata('error', 'Username or Password is incorrect.');
        redirect('userslogin/login');
      }
    }
  }

  public function logout()
  {
    // Unset user data
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_no');
    $this->session->unset_userdata('login_name');

    $this->session->set_flashdata('user_registered', 'You are now logged out.');
    redirect('userslogin/login');
  }

  public function index()
  { }

  public function show()
  { }

  public function create()
  {
    $data['title'] = 'User';
    $user_no = $this->uri->segment(3);

    $data['user'] = $this->UserModel->get_user($user_no);
    if (empty($data['user'])) {
      show_404();
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('userslogin/create', $data);
      $this->load->view('templates/footer');
    }
  }

  public function store($user_no)
  {
    $this->form_validation->set_rules(
      'login_name',
      'Username',
      'required|min_length[2]|is_unique[user_login.login_name]',
      array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules('login_pword', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[login_pword]');

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $this->UserLogin_model->create_account($user_no);
      $this->session->set_flashdata('success', 'User account successfully created.');
      redirect('users');
    }
  }

  public function edit()
  { }

  public function update()
  { }

  public function soft_delete()
  { }
}
