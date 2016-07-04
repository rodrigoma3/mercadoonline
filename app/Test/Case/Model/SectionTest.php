<?php
App::uses('Section', 'Model');

/**
 * Section Test Case
 */
class SectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.section',
		'app.department',
		'app.category',
		'app.product',
		'app.manufacturer',
		'app.unit',
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
		$this->Section = ClassRegistry::init('Section');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Section);

		parent::tearDown();
	}

}
