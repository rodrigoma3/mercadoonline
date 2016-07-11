<?php
App::uses('AppModel', 'Model');
/**
 * CartsProduct Model
 *
 * @property Product $Product
 * @property Cart $Cart
 */
class CartsProduct extends AppModel {

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['product_id']['inList']['rule'][1] = array_keys($this->Product->find('list'));
		$this->validate['cart_id']['inList']['rule'][1] = array_keys($this->Cart->find('list'));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'inList' => array(
				'rule' => array('inList'),
				'message' => 'Escolha uma das opções disponíveis',
			),
		),
		'cart_id' => array(
			'inList' => array(
				'rule' => array('inList'),
				'message' => 'Escolha uma das opções disponíveis',
			),
		),
		'quantity' => array(
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				'message' => 'Apenas números inteiros positivos',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
