<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductunitsModel extends Model
{
	protected $table                = 'tbl_productunits';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'unit',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = true;

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		return $this->table('tbl_productunits')->like('unit', $keyword);
	}
}
