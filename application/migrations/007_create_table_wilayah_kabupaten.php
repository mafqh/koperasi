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
class Migration_create_table_wilayah_kabupaten extends CI_Migration {


	public function up()
	{ 
		$table = "wilayah_kabupaten";
		$fields = array(
			'id'		=> [
				'type'	=> 'VARCHAR(4)',
			],
			'provinsi_id'		=> [
				'type'	=> 'VARCHAR(2)',
			],
			'name'		=> [
				'type'	=> 'VARCHAR(50)',
			],
			'is_deleted' => [
				'type' => 'TINYINT(4)',
				'default'		=> '0'
			],

		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	}


	public function down()
	{
		$table = "wilayah_kabupaten";
		if ($this->db->table_exists($table))
		{
			$this->dbforge->drop_table($table);
		}
	}

}