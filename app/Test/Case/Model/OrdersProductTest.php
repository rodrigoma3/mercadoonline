<?php
App::uses('OrdersProduct', 'Model');

/**
 * OrdersProduct Test Case
 */
class OrdersProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.orders_product',
		'app.product',
		'app.order',
		'app.user',
		'app.situation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OrdersProduct = ClassRegistry::init('OrdersProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OrdersProduct);

		parent::tearDown();
	}

}
