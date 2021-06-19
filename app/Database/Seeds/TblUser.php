<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblUser extends Seeder
{
	public function run()
	{
		// membuat data
		$tbl_user_data = [
			[
				'username' => 'admin',
				'password'  => 'admin123',
				'name' => 'System',
				'email' => 'admin@gamil.com',
				'level' => 1,
				'user_create' => 'System'
			],
		];

		foreach ($tbl_user_data as $data) {
			// insert semua data ke tabel
			$this->db->table('tbl_users')->insert($data);
		}
	}
}
