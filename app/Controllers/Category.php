<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductcategoryModel;

class Category extends BaseController
{
	protected $productcategoryModel;
	public function __construct()
	{
		$this->productcategoryModel = new ProductcategoryModel();
		//$pager = \Config\Services::pager();
	}
	public function index()
	{

		$currentPage = $this->request->getVar('page_categories') ? $this->request->getVar('page_categories') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$productCategpries = $this->productcategoryModel->search($keyword);
		} else {
			$productCategpries = $this->productcategoryModel;
		}

		$data = [
			'title' => 'Product Categories',
			'h1' => 'Product Categories',
			'breadcrumb' => 'Product Categories',
			'productCategories' => $productCategpries->paginate(10, 'categories'),
			'pager' => $this->productcategoryModel->pager,
			'currentPage' => $currentPage
		];

		echo view('productCategories/v_productCategories_index', $data);
	}
	public function Search()
	{

		$currentPage = $this->request->getVar('page_categories') ? $this->request->getVar('page_categories') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$productCategpries = $this->productcategoryModel->search($keyword);
		} else {
			$productCategpries = $this->productcategoryModel;
		}

		$data = [
			'title' => 'Product Categories',
			'h1' => 'Product Categories',
			'breadcrumb' => 'Product Categories',
			'productCategories' => $productCategpries->paginate(10, 'categories'),
			'pager' => $this->productcategoryModel->pager,
			'currentPage' => $currentPage
		];

		echo view('productCategories/v_productCategories_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add|Product Category',
			'h1' => 'Add Product Category',
			'breadcrumb' => 'Product Category / Add Product Category',
			'validation' => \Config\Services::validation()
		];
		echo view('productCategories/v_productCategories_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/category/add')->withInput()->with('validation', $validation);
		} else {

			$data = [
				'category' => $this->request->getPost('category'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->productcategoryModel->save($data);
			return redirect()->to('/category');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Product Category',
			'h1' => 'Edit Product Category',
			'breadcrumb' => 'Product Category / Edit Product Category',
			'validation' => \Config\Services::validation(),
			'edit' => $this->productcategoryModel->find($id)
		];

		echo view('productCategories/v_productCategories_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/category/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'category' => $this->request->getPost('category'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->productcategoryModel->update($id, $data);
			return redirect()->to('/category');
		}
	}

	public function delete($id)
	{
		$this->productcategoryModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/category');
	}
}
