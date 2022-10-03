<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_create_table_api_limits
 *
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 */
class Migration_create_table_menu_function extends CI_Migration {


	public function up()
	{ 
		$table = "menu_function";
		$fields = array(
			'id'           => [
				'type'           => 'BIGINT(20)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'menu_id'          => [
				'type' => 'BIGINT(20)',
			],
			'function_id'      => [
				'type' => 'BIGINT(20)',
			],

		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	}


	public function down()
	{
		$table = "menu_function";
		if ($this->db->table_exists($table))
		{
			$this->dbforge->drop_table($table);
		}
	}

}