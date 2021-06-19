<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductunitsModel;

class Units extends BaseController
{
	protected $unitsModel;
	public function __construct()
	{
		$this->unitsModel = new ProductunitsModel();
		//$pager = \Config\Services::pager();
	}
	public function index()
	{

		$currentPage = $this->request->getVar('page_units') ? $this->request->getVar('page_units') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$productUnits = $this->unitsModel->search($keyword);
		} else {
			$productUnits = $this->unitsModel;
		}

		$data = [
			'title' => 'Product Units',
			'h1' => 'Product Units',
			'breadcrumb' => 'Product Units',
			'productUnits' => $productUnits->paginate(10, 'units'),
			'pager' => $this->unitsModel->pager,
			'currentPage' => $currentPage
		];

		echo view('productUnits/v_productUnits_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add|Product Units',
			'h1' => 'Add Product Units',
			'breadcrumb' => 'Product Units / Add Product Units',
			'validation' => \Config\Services::validation()
		];
		echo view('productUnits/v_productUnits_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'unit' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a unit name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/units/add')->withInput()->with('validation', $validation);
		} else {

			$data = [
				'unit' => $this->request->getPost('unit'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->unitsModel->save($data);
			return redirect()->to('/units');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Product Units',
			'h1' => 'Edit Product Units',
			'breadcrumb' => 'Product Units / Edit Product Units',
			'validation' => \Config\Services::validation(),
			'edit' => $this->unitsModel->find($id)
		];

		echo view('productUnits/v_productUnits_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'unit' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a unit name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/unit/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'unit' => $this->request->getPost('unit'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->unitsModel->update($id, $data);
			return redirect()->to('/units');
		}
	}

	public function delete($id)
	{
		$this->unitsModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/units');
	}
}
