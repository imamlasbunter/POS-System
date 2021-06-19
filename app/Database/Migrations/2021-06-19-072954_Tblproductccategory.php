<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblproductccategory extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'category' => [
				'type' => 'VARCHAR',
				'constraint' => '250'
			],
			'user_create' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'user_update' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'user_delete' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_productcategories');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_productcategories');
	}
}
