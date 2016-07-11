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
			'isCPF' => array(
				'rule' => array('isCPF'),
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
			'equalToField' => array(
				'rule'    => array('equaltofield','confirmPassword'),
				'message' => 'Os valores informados não são iguais',
			),
		),
		'currentPassword' => array(
			'length' => array(
				'rule'    => array('minLength', 3),
				'message' => 'É necessário possuir ao menos 3 caracteres'
			),
			'confirm' => array(
				'rule'    => 'confirmCurrentPassword',
				'message' => 'Senha incorreta',
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

	public function isCPF($check){
		try {
			foreach ($check as $value) {
				$cpf = ereg_replace('[^0-9]', '', (string) $value);
				break;
			}
			if (strlen($cpf) == 11) {
				if ($cpf == '00000000000' ||
					$cpf == '11111111111' ||
					$cpf == '22222222222' ||
					$cpf == '33333333333' ||
					$cpf == '44444444444' ||
					$cpf == '55555555555' ||
					$cpf == '66666666666' ||
					$cpf == '77777777777' ||
					$cpf == '88888888888' ||
					$cpf == '99999999999') {
						return false;
				} else {
					for ($t = 9; $t < 11; $t++) {

						for ($d = 0, $c = 0; $c < $t; $c++) {
							$d += $cpf{$c} * (($t + 1) - $c);
						}
						$d = ((10 * $d) % 11) % 10;
						if ($cpf{$c} != $d) {
							return false;
						}
					}
					return true;
				}
			} else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function equaltofield($check,$otherfield) {
		try {
			foreach ($check as $key => $value){
				$fname = $key;
				break;
			}
			if ($this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]) {
				return true;
			} else {
				$this->invalidate($otherfield, null);
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function confirmCurrentPassword($check) {
		try {
			foreach ($check as $key => $value){
				$fname = $key;
				break;
			}
			$usuario = $this->findById($this->data[$this->name]['id']);
			$newHash = Security::hash($this->data[$this->name][$fname], 'blowfish', $usuario[$this->name]['password']);
			if($newHash === $usuario[$this->name]['password']){
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

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
