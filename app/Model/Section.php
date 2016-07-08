<?php
App::uses('AppModel', 'Model');
/**
 * Section Model
 *
 * @property Department $Department
 * @property Category $Category
 */
class Section extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['department_id']['inList']['rule'][1] = array_keys($this->Department->find('list'));
	}

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
		'department_id' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Escolha uma das opções disponíveis',
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
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'section_id',
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
