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
			'isCNPJ' => array(
				'rule' => array('isCNPJ'),
				'message' => 'CNPJ inválido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function isCNPJ($check){
		try {
			foreach ($check as $value) {
				$cnpj = preg_replace('/[^0-9]/', '', (string) $value);
				break;
			}
			if (strlen($cnpj) == 14) {
				for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
					$soma += $cnpj{$i} * $j;
					$j = ($j == 2) ? 9 : $j - 1;
				}
				$resto = $soma % 11;
				if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)){
					return false;
				}
				for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
					$soma += $cnpj{$i} * $j;
					$j = ($j == 2) ? 9 : $j - 1;
				}
				$resto = $soma % 11;
				return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
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
