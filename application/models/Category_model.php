<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getData()
	{
		$query = $this->db->get('categories');
		return $query->result_array();
	}

	public function create()
	{
		$data = array(
			'name' => $this->input->post('new-category')
		);

		return $this->db->insert('categories', $data);
	}
}
