<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    $data['title'] = 'Home';
    $this->load->view('templates/header', $data);
    $this->load->view('home');
    $this->load->view('templates/footer');
  }
}
