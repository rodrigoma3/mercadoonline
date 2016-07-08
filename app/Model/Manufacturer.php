<?php
App::uses('AppModel', 'Model');
/**
 * Manufacturer Model
 *
 * @property Product $Product
 */
class Manufacturer extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres',
				//'allowEmpty' => false,
				//'required' => false,
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Valor já registrado!',
			),
		),
		'cnpj' => array(
			'custom' => array(
				'rule' => array('custom'),
				'message' => 'CNPJ inválido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'manufacturer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
