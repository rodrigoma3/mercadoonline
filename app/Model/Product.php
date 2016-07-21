<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Manufacturer $Manufacturer
 * @property Category $Category
 * @property Unit $Unit
 * @property Order $Order
 */
class Product extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['manufacturer_id']['inList']['rule'][1] = array_keys($this->Manufacturer->find('list'));
		$this->validate['category_id']['inList']['rule'][1] = array_keys($this->Category->find('list'));
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
		'manufacturer_id' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Escolha uma das opções disponíveis',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Escolha uma das opções disponíveis',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stock' => array(
			'naturalNumber' => array(
				'rule' => array('naturalNumber', true),
				'message' => 'Informe um valor não negativo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'money' => array(
				'rule' => array('money'),
				'message' => 'Insira um valor válido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'promotion_price' => array(
			'money' => array(
				'rule' => array('money'),
				'message' => 'Insira um valor válido',
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
		'Manufacturer' => array(
			'className' => 'Manufacturer',
			'foreignKey' => 'manufacturer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
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
		'Order' => array(
			'className' => 'Order',
			'joinTable' => 'orders_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'order_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public function bestSellers() {
		$query = 'SELECT Product.*, Manufacturer.*
				FROM products as Product
				LEFT JOIN manufacturers as Manufacturer
				ON (Product.manufacturer_id = Manufacturer.id)
				LEFT JOIN orders_products as OrdersProduct
				ON (Product.id = OrdersProduct.product_id)
				GROUP BY OrdersProduct.product_id
				ORDER BY COUNT(OrdersProduct.product_id) DESC
				LIMIT 6
				';

		return $this->query($query);
	}

	public function searchProducts($q = null) {
		$this->recursive = 0;
		if ($q == null) $q = '';
		$conditions = array('OR' => array(
				$this->alias.'.name LIKE' => "%$q%",
				$this->alias.'.description LIKE' => "%$q%",
				$this->Manufacturer->alias.'.name LIKE' => "%$q%",
				$this->Category->alias.'.name LIKE' => "%$q%",
				$this->Category->alias.'.description LIKE' => "%$q%",
				$this->Category->Section->alias.'.name LIKE' => "%$q%",
				$this->Category->Section->alias.'.description LIKE' => "%$q%",
			)
		);
		$join = array(
			array(
				'table' => $this->Category->Section->table,
				'alias' => $this->Category->Section->alias,
				'type' => 'LEFT',
				'conditions' => array($this->Category->Section->alias.'.id = '.$this->Category->alias.'.section_id'),
			)
		);
		return $this->find('all', array('conditions' => $conditions, 'joins' => $join));
	}
}
