<?php
App::uses('BetDetail', 'Model');

/**
 * BetDetail Test Case
 *
 */
class BetDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bet_detail',
		'app.bet',
		'app.person'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BetDetail = ClassRegistry::init('BetDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BetDetail);

		parent::tearDown();
	}

}
