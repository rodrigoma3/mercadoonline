<?php
App::uses('AppModel', 'Model');
/**
 * Cart Model
 *
 * @property User $User
 * @property Situation $Situation
 * @property Product $Product
 */
class Cart extends AppModel {

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['user_id']['inList']['rule'][1] = array_keys($this->User->find('list'));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Escolha uma das opções disponíveis',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'carts_products',
			'foreignKey' => 'cart_id',
			'associationForeignKey' => 'product_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
}
