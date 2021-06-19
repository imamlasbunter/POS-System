<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{


		$data = [
			'title' => 'Dashboard',
			'h1' => 'Dashboard',
			'breadcrumb' => 'Dashboard',
		];
		echo view('v_dashboard', $data);
	}
}
