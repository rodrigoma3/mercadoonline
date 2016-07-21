<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ProductsController extends AppController {

	public function isAuthorized($user = null) {
		if (parent::isAuthorized($user))
			return true;

			switch($this->action) {
				case 'admin_index':
				case 'admin_view':
				case 'admin_add':
				case 'admin_edit':
				case 'admin_delete':
					if (in_array($user['role_id'], array('1', '2'))) {
						return true;
					} else {
						return false;
					}
					break;
			}
	}

	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'category', 'section', 'search');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		$options = array('conditions' => array('promotion_price >' => '0'));
		$products = $this->Product->find('all', $options);
		$this->set('menuLeft', $this->menuLeft($products));
		$this->set('products', $products);
		$this->set('bestSellers', $this->Product->bestSellers());
	}

/**
 * section method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function section($id = null) {
		$this->Product->Category->Section->id = $id;
		if (!$this->Product->Category->Section->exists()) {
			throw new NotFoundException(__('Categoria inválida'));
		}
		$titleProducts = ''.$this->Product->Category->Section->field('name');
		$this->Product->recursive = 0;
		$options = array($this->Product->Category->alias.'.section_id' => $id);
		$products = $this->Product->find('all', array('conditions' => $options));
		$this->set('menuLeft', $this->menuLeft($products));
		$this->set('products', $products);
		$this->set('titleProducts', $titleProducts);
	}

/**
 * category method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function category($id = null, $filter = null, $idFilter = null) {
		$this->Product->Category->id = $id;
		if (!$this->Product->Category->exists()) {
			throw new NotFoundException(__('Categoria inválida'));
		}
		$titleProducts = ''.$this->Product->Category->field('name');
		$this->Product->recursive = 0;
		$options = array('category_id' => $id);
		if ($filter != null) {
			switch ($filter) {
				case 'manufacturer':
					$options['manufacturer_id'] = $idFilter;
					$this->Product->Manufacturer->id = $idFilter;
					$titleProducts = $titleProducts.' - '.$this->Product->Manufacturer->field('name');
					break;
			}
		}
		$products = $this->Product->find('all', array('conditions' => $options));
		$this->set('menuLeft', $this->menuLeft($products));
		$this->set('products', $products);
		$this->set('titleProducts', $titleProducts);
	}

/**
 * search method
 *
 * @throws NotFoundException
 * @param string $q
 * @return void
 */
	public function search() {
		$products = $this->Product->searchProducts($this->request->query('q'));
		$titleProducts = 'Resultado(s) de "'.$this->request->query('q').'"';
		$this->set('menuLeft', $this->menuLeft($products));
		$this->set('products', $products);
		$this->set('titleProducts', $titleProducts);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('O produto foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O produto não pôde ser salvo. Por favor, tente novamente.'));
			}
		}
		$manufacturers = $this->Product->Manufacturer->find('list');
		$categories = $this->Product->Category->find('list');
		$orders = $this->Product->Order->find('list');
		$this->set(compact('manufacturers', 'categories', 'orders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('O produto foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O produto não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$manufacturers = $this->Product->Manufacturer->find('list');
		$categories = $this->Product->Category->find('list');
		$orders = $this->Product->Order->find('list');
		$this->set(compact('manufacturers', 'categories', 'orders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Flash->success(__('O produto foi deletado.'));
		} else {
			$this->Flash->error(__('O produto não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->Product->find('all'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('O produto foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O produto não pôde ser salvo. Por favor, tente novamente.'));
			}
		}
		$manufacturers = $this->Product->Manufacturer->find('list');
		$categories = $this->Product->Category->find('list');
		$orders = $this->Product->Order->find('list');
		$this->set(compact('manufacturers', 'categories', 'orders'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('O produto foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O produto não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$manufacturers = $this->Product->Manufacturer->find('list');
		$categories = $this->Product->Category->find('list');
		$orders = $this->Product->Order->find('list');
		$this->set(compact('manufacturers', 'categories', 'orders'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Flash->success(__('O produto foi deletado.'));
		} else {
			$this->Flash->error(__('O produto não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * menuLeft method
 *
 * @throws NotFoundException
 * @param array $products
 * @return array
 */
	public function menuLeft($products = array()) {
		$menuLeft = array();
		foreach ($products as $product) {
			$menuLeft[$product['Category']['id']]['name'] = $product['Category']['name'];
			$menuLeft[$product['Category']['id']]['manufacturers'][$product['Manufacturer']['id']] = $product['Manufacturer']['name'];
		}
		return $menuLeft;
	}
}
