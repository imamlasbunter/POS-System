<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductitemsModel extends Model
{
	protected $table                = 'tbl_productitems';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'product_code',
		'product_name',
		'quantity',
		'minimum_quantity',
		'unit_id',
		'purchase_price',
		'last_purchase_price',
		'selling_price',
		'category_id',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = true;


	public function index()
	{
		$builder = $this->table('tbl_productitems');
		$builder->select('tbl_productitems.id, tbl_productitems.product_code,
		tbl_productitems.product_name,
		tbl_productitems.quantity,
		tbl_productitems.minimum_quantity,
		tbl_productitems.unit_id,
		tbl_productitems.purchase_price,
		tbl_productitems.last_purchase_price,
		tbl_productitems.selling_price,
		tbl_productitems.category_id, tbl_productunits.unit, tbl_productcategories.category');
		$builder->join('tbl_productunits', 'tbl_productunits.id = tbl_productitems.unit_id', 'left');
		$builder->join('tbl_productcategories', 'tbl_productcategories.id = tbl_productitems.category_id', 'left');

		//dd($builder);
		return $builder;
	}

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		// return $this->table('tbl_productitems')->like('product_code', $keyword)->orLike('product_name', $keyword);

		$builder = $this->table('tbl_productitems');
		$builder->select('tbl_productitems.id, tbl_productitems.product_code,
		tbl_productitems.product_name,
		tbl_productitems.quantity,
		tbl_productitems.minimum_quantity,
		tbl_productitems.unit_id,
		tbl_productitems.purchase_price,
		tbl_productitems.last_purchase_price,
		tbl_productitems.selling_price,
		tbl_productitems.category_id, tbl_productunits.unit, tbl_productcategories.category');
		$builder->join('tbl_productunits', 'tbl_productunits.id = tbl_productitems.unit_id', 'left');
		$builder->join('tbl_productcategories', 'tbl_productcategories.id = tbl_productitems.category_id', 'left');
		$builder->like('tbl_productitems.product_code', $keyword);
		$builder->Orlike('tbl_productitems.product_name', $keyword);
		return $builder;
	}
}
