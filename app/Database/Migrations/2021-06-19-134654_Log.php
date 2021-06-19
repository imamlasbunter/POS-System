<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'bigint',
				'unsigned' => true,
				'auto_increment' => true

			],

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('log');
	}

	public function down()
	{
		$this->forge->dropTable('log');
	}
}
