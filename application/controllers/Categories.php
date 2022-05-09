<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}

	public function getCategories()
	{
		$data['categories'] = $this->category_model->getData();
		echo json_encode($data['categories']);
	}

	public function create()
	{
		$this->form_validation->set_rules('new-category', 'New Category', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo
			'<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">' . validation_errors() . '</span></div>';
		} else {
			$this->category_model->create();
			echo '<div class="p-4 mb-4 text-sm text-green-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-green-800" role="alert">
			<span class="font-medium">Success</span></div>';
		}
	}
}
