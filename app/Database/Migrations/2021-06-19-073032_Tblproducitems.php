<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Tblproductitems extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'product_code' => [
				'type' => 'VARCHAR',
				'constraint' => '25'
			],
			'product_name' => [
				'type' => 'VARCHAR',
				'constraint' => '200'

			],
			'quantity' => [
				'type' => 'BIGINT',
				'default' => 0
			],
			'minimum_quantity' => [
				'type' => 'BIGINT',
				'default' => 0
			],
			'unitid' => [
				'type' => 'BIGINT'

			],
			'purchase_price' => [
				'type' => 'bigint'
			],
			'last_purchase_price' => [
				'type' => 'bigint'
			],
			'selling_price' => [
				'type' => 'bigint'
			],
			'category_id' => [
				'type' => 'bigint'
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
		$this->forge->createTable('tbl_productitems');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_productitems');
	}
}
