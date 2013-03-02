<?php
/**
 * BetDetailFixture
 *
 */
class BetDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'bet_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'person_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'club_to_bet' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'amount_of_bet' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'win_loss' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'bet_id' => 1,
			'person_id' => 1,
			'club_to_bet' => 1,
			'amount_of_bet' => 1,
			'win_loss' => 1
		),
	);

}
