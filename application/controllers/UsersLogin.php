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
          'user_mname' => $user->user_mname,
          'depart_no' => $user->depart_no,
          'depart_code' => $user->depart_code,
          'depart_title' => $user->depart_title,
          'login_name' => $username,
          'role_id' => $user->role_id,
          'role_code' => $user->role_code,
          'role_name' => $user->role_name,
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
    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
    $data['title'] = 'User';
    $user_no = $this->uri->segment(3);

    $data['user'] = $this->UserModel->get_user($user_no);
    $data['roles'] = $this->Roles_model->get_roles()->result();

    if (empty($data['user'])) {
      show_404();
    } else {
      $data['user_login'] = $this->UserLogin_model->get_user_account($user_no);
      if (empty($data['user_login'])) {
        $data['action'] = 'store';
      } else {
        $data['action'] = 'update';
      }
      $this->load->view('templates/header', $data);
      $this->load->view('userslogin/create', $data);
      $this->load->view('templates/footer');
    }
  }

  public function store($user_no)
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
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

  public function update($user_no)
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
    $this->form_validation->set_rules('old_pword', 'Old Password', 'required|callback_check_account_exists');
    $this->form_validation->set_rules('login_pword', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[login_pword]');

    if ($this->form_validation->run() === false) {
      $this->create();
    } else {
      $old_pword = $this->input->post('old_pword');
      $this->UserLogin_model->update_account($user_no);
      $this->session->set_flashdata('success', 'User account successfully updated.');
      redirect('users');
    }
  }

  public function soft_delete()
  { }

  public function check_account_exists($old_pword)
  {
    // Get the user number based on url
    $user_no = $this->uri->segment(3);
    $result = $this->UserLogin_model->check_account_exists($old_pword, $user_no);
    if ($result == 1) {
      return true;
    } else {
      $this->session->set_flashdata('error', 'Failed to change password');
      $this->form_validation->set_message('check_account_exists', 'Failed to change password');
      return false;
    }
  }
}
