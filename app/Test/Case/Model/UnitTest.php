<?php
App::uses('Unit', 'Model');

/**
 * Unit Test Case
 */
class UnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unit',
		'app.product',
		'app.manufacturer',
		'app.category',
		'app.section',
		'app.department',
		'app.order',
		'app.user',
		'app.situation',
		'app.orders_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Unit = ClassRegistry::init('Unit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Unit);

		parent::tearDown();
	}

}
