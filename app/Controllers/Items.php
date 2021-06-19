<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductitemsModel;
use App\Models\ProductcategoryModel;
use App\Models\ProductunitsModel;

class Items extends BaseController
{
	protected $itemsModel;
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->unitsModel = new ProductunitsModel();
		$this->categoryModel = new ProductcategoryModel();
	}
	public function index()
	{

		$currentPage = $this->request->getVar('page_items') ? $this->request->getVar('page_items') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$items = $this->itemsModel->search($keyword);
		} else {
			$items = $this->itemsModel->index();
		}
		//dd($items);

		$data = [
			'title' => 'Product Items',
			'h1' => 'Product Items',
			'breadcrumb' => 'Product Items',
			'items' => $items->paginate(10, 'items'),
			'pager' => $this->itemsModel->pager,
			'currentPage' => $currentPage
		];

		echo view('productItems/v_productItems_index', $data);
	}

	public function add()
	{
		$units = $this->unitsModel->findAll();
		$category = $this->categoryModel->findAll();
		$data = [
			'title' => 'Add|Product Items',
			'h1' => 'Add Product Items',
			'breadcrumb' => 'Product Items / Add Product Items',
			'validation' => \Config\Services::validation(),
			'units' => $units,
			'category' => $category
		];
		echo view('productItems/v_productItems_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'product_code' => [
				'rules' => 'required|is_unique[tbl_productItems.product_code]',
				'errors' => [
					'required' => 'Please provide a product code.',
					'is_unique' => 'Product code has been registered'
				]
			],
			'product_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a product name.'
				]
			],
			'quantity' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a quantity product.',
					'numeric' => 'Please provide a numeric'
				]
			],
			'minimum_quantity' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a minimum quantity product.',
					'numeric' => 'Please provide a numeric'
				]
			],
			'unit_id' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a product unit.'
				]
			],
			'purchase_price' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a purchase price.',
					'numeric' => 'Please provide a numeric'
				]
			],
			'last_purchase_price' => [
				'rules' => 'numeric',
				'errors' => [
					'numeric' => 'Please provide a numeric'
				]
			],
			'selling_price' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a selling price.',
					'numeric' => 'Please provide a numeric'
				]
			],
			'category_id' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/items/add')->withInput()->with('validation', $validation);
		} else {

			$data = [
				'product_code' => $this->request->getPost('product_code'),
				'product_name' => $this->request->getPost('product_name'),
				'quantity' => $this->request->getPost('quantity'),
				'minimum_quantity' => $this->request->getPost('minimum_quantity'),
				'unit_id' => $this->request->getPost('unit_id'),
				'purchase_price' => $this->request->getPost('purchase_price'),
				'last_purchase_price' => $this->request->getPost('last_purchase_price'),
				'selling_price' => $this->request->getPost('selling_price'),
				'category_id' => $this->request->getPost('category_id'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->itemsModel->save($data);
			return redirect()->to('/items');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Product Items',
			'h1' => 'Edit Product Items',
			'breadcrumb' => 'Product Items / Edit Product Items',
			'validation' => \Config\Services::validation(),
			'edit' => $this->itemsModel->find($id),
			'units' => $this->unitsModel->findAll(),
			'category' => $this->categoryModel->findAll()

		];

		echo view('productItems/v_productItems_edit', $data);
	}

	public function update()
	{
		$id = $this->request->getPost('id');
		$product_code = $this->itemsModel->find($id);

		if ($product_code['product_code'] == $this->request->getPost('product_code')) {
			$check = $this->validate([
				'product_code' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product code.'
					]
				],
				'product_name' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				],
				'quantity' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'minimum_quantity' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'unit_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				],
				'purchase_price' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'last_purchase_price' => [
					'rules' => 'numeric',
					'errors' => [
						'numeric' => 'Please provide a numeric'
					]
				],
				'selling_price' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'category_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				]
			]);
		} else {
			$check = $this->validate([
				'product_code' => [
					'rules' => 'required|is_unique[tbl_productItems.product_code]',
					'errors' => [
						'required' => 'Please provide a product code.',
						'is_unique' => 'Product code has been registered'
					]
				],
				'product_name' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				],
				'quantity' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'minimum_quantity' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'unit_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				],
				'purchase_price' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'last_purchase_price' => [
					'rules' => 'numeric',
					'errors' => [
						'numeric' => 'Please provide a numeric'
					]
				],
				'selling_price' => [
					'rules' => 'required|numeric',
					'errors' => [
						'required' => 'Please provide a product name.',
						'numeric' => 'Please provide a numeric'
					]
				],
				'category_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Please provide a product name.'
					]
				]
			]);
		}


		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/items/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'product_code' => $this->request->getPost('product_code'),
				'product_name' => $this->request->getPost('product_name'),
				'quantity' => $this->request->getPost('quantity'),
				'minimum_quantity' => $this->request->getPost('minimum_quantity'),
				'unit_id' => $this->request->getPost('unit_id'),
				'purchase_price' => $this->request->getPost('purchase_price'),
				'last_purchase_price' => $this->request->getPost('last_purchase_price'),
				'selling_price' => $this->request->getPost('selling_price'),
				'category_id' => $this->request->getPost('category_id'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->itemsModel->update($id, $data);
			return redirect()->to('/items');
		}
	}

	public function delete($id)
	{
		$this->itemsModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/items');
	}
}
