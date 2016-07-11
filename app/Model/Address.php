<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 * @property User $User
 */
class Address extends AppModel {


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cep' => array(
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 8, 8),
				'message' => 'CEP possui 8 números, insira apenas os números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				'message' => 'Apenas números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres',
				//'allowEmpty' => false,
				//'required' => false,
			),
		),
		'neighborhood' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres',
				//'allowEmpty' => false,
				//'required' => false,
			),
		),
		'city' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres',
				//'allowEmpty' => false,
				//'required' => false,
			),
		),
		'state' => array(
			'lengthBetween' => array(
				'rule'    => array('lengthBetween', 2, 2),
				'message' => 'Digite o Estado com 2 caracteres',
				//'allowEmpty' => false,
				//'required' => false,
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
		)
	);
}
