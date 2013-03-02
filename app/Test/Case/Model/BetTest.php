<?php
App::uses('Bet', 'Model');

/**
 * Bet Test Case
 *
 */
class BetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bet',
		'app.bet_detail',
		'app.person'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bet = ClassRegistry::init('Bet');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bet);

		parent::tearDown();
	}

}
