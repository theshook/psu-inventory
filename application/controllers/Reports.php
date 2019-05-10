<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
  }

	public function property_acknowledgement() {
		$data['title'] = 'reports';
    $this->load->view('templates/header', $data);
    $this->load->view('report/property_acknowledgement');
    $this->load->view('templates/footer');
	}

  public function property_acknowledgement_show($user_no) {
    $data['title'] = 'reports';
    $data['accountable'] = $this->Report_model->get_property_acknowledgement_show($user_no)->result();
  	$data['total'] = $this->Report_model->get_property_acknowledgement_total_price($user_no)->result()[0];
  	$data['from'] = $this->UserModel->get_user($user_no);
    $this->load->view('templates/header', $data);
    $this->load->view('report/property_acknowledgement_show', $data);
    $this->load->view('templates/footer');
  }

  # Ajax for property_acknowledgement page
  public function property_acknowledgement_data() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $pa = $this->Report_model->get_property_acknowledgement_data();
    $total_pa = $this->Report_model->get_total_property_acknowledgement_data();

    $data = array();

    foreach ($pa->result() as $r) {

      $data[] = array(
        $r->user_no,
        $r->user_lname,
        $r->user_fname,
        $r->user_mname,
        $r->depart_code,
      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_pa,
      "recordsFiltered" => $total_pa,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function supply_availability_inquiry () {
    $data['title'] = 'reports';
    $data['categories'] = $this->Report_model->get_categories()->result();
    $data['products'] = $this->Report_model->get_products()->result();
    $data['release'] = $this->Report_model->get_products_release()->result();
    $this->load->view('templates/header', $data);
    $this->load->view('report/Supply Availability Inquiry/index');
    $this->load->view('templates/footer');
  }

  public function yearly_issued_summary () {
    $data['title'] = 'reports';
    $data['get_year'] = $this->Report_model->get_all_year()->result();
    $data['monthly'] = $this->Report_model->get_monthly_total_price()->result();
    $data['total'] = $this->Report_model->get_yearly_total_price()->result()[0];
    $this->load->view('templates/header', $data);
    $this->load->view('report/Yearly Summary/index');
    $this->load->view('templates/footer');
  }

  public function monthly_issued_summary () {
    $data['title'] = 'reports';
    $data['get_year'] = $this->Report_model->get_all_year()->result();
    $data['monthly'] = $this->Report_model->get_monthly_price()->result();
    $data['total'] = $this->Report_model->get_monthly_total_price()->result()[0];
    $this->load->view('templates/header', $data);
    $this->load->view('report/Monthly Summary/index');
    $this->load->view('templates/footer');
  }


}