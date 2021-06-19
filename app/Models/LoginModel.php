<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
	protected $table = 'tbl_users';
	protected $primaryKey = 'id';

	public function LoginCheck($username, $password)
	{

		return  $this->table('tbl_users')
			->where(array('username' => $username, 'password' => $password))
			->get()->getRowArray();

		//dd($return);
	}
}
