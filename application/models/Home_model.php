<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
	public function __construct()
	{
	    $this->load->database();
	}

	public function get_total_request() 
	{	
		$date = $this->input->get('dates');

		$this->db->group_by('depart_title');
		$this->db->select('depart_title, COUNT(depart_title) as total');
		$this->db->join('employments', 'employments.user_no = requests.user_no');
		$this->db->join('departments', 'departments.depart_no = employments.depart_no');

		if (empty($date)) {
			return $this->db->get_where('requests', array(
				'request_delete' => 0,
				'request_inactive' => 0
			))->result();
		} else {
			$dates = explode("_", $this->input->get('dates'));

			$this->db->where('request_encode_date >=', $dates[0].' 00:00:00');
			$this->db->where('request_encode_date <=', $dates[1].' 23:59:59');
			$this->db->where('request_delete =', 0);
			$this->db->where('request_inactive =', 0);
			return $this->db->get('requests')->result();
		}
	}

	public function get_seven_request()
	{
		$this->db->join('users', 'users.user_no = requests.user_no');
		$this->db->join('employments', 'employments.user_no = requests.user_no');
		$this->db->join('departments', 'departments.depart_no = employments.depart_no');
		return $this->db->get_where('requests', array(
			'request_delete' => 0,
			'request_inactive' => 0
		), 7)->result();
	}
}
