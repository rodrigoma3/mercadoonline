<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Address $Address
 * @property Order $Order
 * @property Role $Role
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$hash = new BlowfishPasswordHasher();
			$senha = $hash->hash($this->data[$this->alias]['password']);

			$this->data[$this->alias]['password'] = $senha;
		}
		return true;
	}

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['role_id']['inList']['rule'][1] = array_keys($this->Role->find('list'));
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
				'message' => 'É necessário possuir ao menos 3 caracteres'
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Nome de usuário já registrado!'
			),
		),
		'username' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres'
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Nome de usuário já registrado!'
			),
			'simplechars' => array(
				'rule'    => '/^[a-z0-9_\.]{3,}$/i',
				'message' => 'Apenas caracteres simples, números, underline "_"  e ponto "."'
			),
		),
		'cpf' => array(
			'custom' => array(
				'rule' => array('custom'),
				'message' => 'CPF inválido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Insira um e-mail válido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres'
			),
			'equalTo' => array(
				'rule'    => array('equalTo', 'password'),
				'message' => 'As senhas não conferem'
			),
		),
		'role_id' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Escolha uma das opções disponíveis',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'isRemoved' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Por favor, utilize a caixa de seleção',
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
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'user_id',
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


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
