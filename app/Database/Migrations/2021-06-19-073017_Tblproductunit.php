<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblproductunit extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'unit' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
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
		$this->forge->createTable('tbl_productunits');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_productunits');
	}
}
