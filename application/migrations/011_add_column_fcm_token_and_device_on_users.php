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
class Migration_add_column_fcm_token_and_device_on_users extends CI_Migration {


	public function up()
	{ 
		$table = 'users';
		$fields = array(
			'nip' => array(
				'type' => 'VARCHAR(100)', 
				'null' => TRUE,
				'after'  => 'phone',
			),
			'nik' => array(
				'type' => 'VARCHAR(100)', 
				'null' => TRUE,
				'after'  => 'nip',
			),
			'provinsi_id' => array(
				'type' => 'INT(2)',
				'null' => TRUE,
				'unsigned' => TRUE,
				'after'  => 'phone',
			),
			'kabupaten_id' => array(
				'type' => 'INT(4)',
				'null' => TRUE,
				'unsigned' => TRUE,
				'after'  => 'provinsi_id',
			),
			'kecamatan_id' => array(
				'type' => 'INT(7)',
				'null' => TRUE,
				'unsigned' => TRUE,
				'after'  => 'kabupaten_id',
			),
			'kelurahan_id' => array(
				'type' => 'BIGINT(10)',
				'null' => TRUE,
				'unsigned' => TRUE,
				'after'  => 'kecamatan_id',
			),
		);
		$this->dbforge->add_column($table, $fields);
	}


	public function down()
	{
		$table = "users";
		$this->dbforge->drop_column($table, "nip");		
		$this->dbforge->drop_column($table, "nik");				
		$this->dbforge->drop_column($table, "provinsi_id");		
		$this->dbforge->drop_column($table, "kabupaten_id");		
		$this->dbforge->drop_column($table, "kecamatan_id");		
		$this->dbforge->drop_column($table, "kelurahan_id");	
	}

}

