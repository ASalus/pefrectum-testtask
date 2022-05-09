<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('shoppingList_model');
	}

	public function index()
	{
		$data['title'] = 'Shopping List';

		$this->load->view('templates/header', $data)
			->load->view('pages/list', $data)
			->load->view('templates/footer');
	}

	public function getList($status = null, $category = null)
	{
		$data['items'] = $this->shoppingList_model->getData($status, $category);
		echo json_encode($data['items']);
		// echo json_encode([$status, $category]);
	}

	public function update($id)
	{
		$this->shoppingList_model->update($id);
	}

	public function delete($id)
	{
		$this->shoppingList_model->delete($id);
		echo '<div class="p-4 mb-4 text-sm text-green-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-green-800" role="alert">
		<span class="font-medium">Item has been deleted</span></div>';
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Item Name', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo
			'<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">' . validation_errors() . '</span></div>';
		} else {
			$this->shoppingList_model->create();
			echo '<div class="p-4 mb-4 text-sm text-green-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-green-800" role="alert">
			<span class="font-medium">Success</span></div>';
		}
	}
}
