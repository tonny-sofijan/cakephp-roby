<?php
/**
 * BetFixture
 *
 */
class BetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created_date' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'home' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'away' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'handicap1' => array('type' => 'float', 'null' => true, 'default' => null),
		'handicap2' => array('type' => 'float', 'null' => true, 'default' => null),
		'loss1' => array('type' => 'float', 'null' => true, 'default' => null),
		'loss2' => array('type' => 'float', 'null' => true, 'default' => null),
		'result1' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'result2' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'bet_note' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created_date' => 1355470239,
			'home' => 1,
			'away' => 1,
			'handicap1' => 1,
			'handicap2' => 1,
			'loss1' => 1,
			'loss2' => 1,
			'result1' => 1,
			'result2' => 1,
			'bet_note' => 'Lorem ipsum dolor sit amet'
		),
	);

}
