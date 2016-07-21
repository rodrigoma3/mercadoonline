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
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

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
