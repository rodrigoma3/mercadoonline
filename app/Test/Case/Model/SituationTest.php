<?php
App::uses('Situation', 'Model');

/**
 * Situation Test Case
 */
class SituationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.situation',
		'app.order',
		'app.user',
		'app.product',
		'app.manufacturer',
		'app.category',
		'app.section',
		'app.department',
		'app.unit',
		'app.orders_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Situation = ClassRegistry::init('Situation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Situation);

		parent::tearDown();
	}

}
