<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingList_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getData($status, $category)
	{
		if (($status == 'null') && ($category == 'null')) {
			$query = $this->db
				->select('shopping_list.id ,shopping_list.name as item_name, shopping_list.status, shopping_list.created_at')
				->from('shopping_list')
				->select('categories.name as category_name')
				->join('categories', ' categories.id = shopping_list.category_id ', 'left')
				->order_by('shopping_list.id', 'desc')
				->get();
			return $query->result_array();
		} elseif (($status == 'null') && ($category != 'null')) {
			$query = $this->db
				->select('shopping_list.id ,shopping_list.name as item_name, shopping_list.status, shopping_list.created_at')
				->select('categories.name as category_name')
				->join('categories', ' categories.id = shopping_list.category_id ', 'left')
				->order_by('shopping_list.id', 'desc')
				->get_where('shopping_list', array('category_id' => $category));
			return $query->result_array();
		} elseif (($status != 'null') && ($category == 'null')) {
			$query = $this->db
				->select('shopping_list.id ,shopping_list.name as item_name, shopping_list.status, shopping_list.created_at')
				->select('categories.name as category_name')
				->join('categories', ' categories.id = shopping_list.category_id ', 'left')
				->order_by('shopping_list.id', 'desc')
				->get_where('shopping_list', array('status' => $status));
			return $query->result_array();
		}

		$query = $this->db
			->select('shopping_list.id ,shopping_list.name as item_name, shopping_list.status, shopping_list.created_at')
			->select('categories.name as category_name')
			->join('categories', ' categories.id = shopping_list.category_id ', 'left')
			->order_by('shopping_list.id', 'desc')
			->where('status', $status)
			->get_where('shopping_list', array('category_id' => $category));

		return $query->row_array();
	}

	public function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category')
		);

		return $this->db->insert('shopping_list', $data);
	}

	public function delete($id)
	{

		$this->db->where('id', $id)
			->delete('shopping_list');
		return true;
	}

	public function update($id)
	{
		if ($this->input->post('status') == 'true') {
			$data = array(
				'status' => 1,
			);
		} else {
			$data = array(
				'status' => 0,
			);
		}
		$this->db->where('id', $id);
		$this->db->update('shopping_list', $data);
	}
}
