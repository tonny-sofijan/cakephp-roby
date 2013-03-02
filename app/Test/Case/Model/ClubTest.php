<?php
App::uses('Club', 'Model');

/**
 * Club Test Case
 *
 */
class ClubTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.club'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Club = ClassRegistry::init('Club');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Club);

		parent::tearDown();
	}

}
