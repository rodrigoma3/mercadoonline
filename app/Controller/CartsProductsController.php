<?php
App::uses('AppController', 'Controller');
/**
 * CartsProducts Controller
 *
 * @property CartsProduct $CartsProduct
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class CartsProductsController extends AppController {

	public function isAuthorized($user = null) {
		if (parent::isAuthorized($user))
			return true;

			switch($this->action) {
				case 'index':
				case 'view':
				case 'add':
				case 'edit':
				case 'delete':
					if (in_array($user['role_id'], array('3'))) {
						return true;
					} else {
						return false;
					}
					break;
			}
	}

/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */
	public function index() {
		$cartProducts = $this->CartsProduct->listCartProducts($this->Auth->user('id'));
		$this->set('cartProducts', $cartProducts);

	}

/**
 * add method
 *
 * @return int
 */
	public function add() {
		if($this->request->is('ajax')){
			$this->autoRender = false;
			if ($this->Auth->loggedIn()) {
				$cart = $this->CartsProduct->Cart->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));
				$this->request->data[$this->CartsProduct->name]['cart_id'] = $cart[0][$this->CartsProduct->Cart->name]['id'];
				$this->request->data[$this->CartsProduct->name]['product_id'] = $this->request->query('product_id');
				$this->request->data[$this->CartsProduct->name]['quantity'] = $this->request->query('quantity');
				$productInCart = $this->CartsProduct->find('first', array('conditions' => array('cart_id' => $this->request->data[$this->CartsProduct->name]['cart_id'], 'product_id' => $this->request->data[$this->CartsProduct->name]['product_id'])));
				if (isset($productInCart[$this->CartsProduct->name]) && !empty($productInCart[$this->CartsProduct->name])) {
					$this->CartsProduct->id = $productInCart[$this->CartsProduct->name]['id'];
				} else {
					$this->CartsProduct->create();
				}
				if ($this->CartsProduct->save($this->request->data)) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return -1;
			}
		} elseif ($this->request->is('post')) {
			$productInCart = $this->CartsProduct->find('first', array('conditions' => array('cart_id' => $this->request->data[$this->CartsProduct->name]['cart_id'], 'product_id' => $this->request->data[$this->CartsProduct->name]['product_id'])));
			if (isset($productInCart[$this->CartsProduct->name]) && !empty($productInCart[$this->CartsProduct->name])) {
				$this->CartsProduct->id = $productInCart[$this->CartsProduct->name]['id'];
			} else {
				$this->CartsProduct->create();
			}
			if ($this->CartsProduct->save($this->request->data)) {
				$this->Flash->success(__('O pedido foi salvo.'));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
			return $this->redirect(array('controller' => 'products', 'action' => 'view', $this->request->data[$this->CartsProduct->name]['product_id']));
		} else {
			return $this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CartsProduct->saveAll($this->request->data)) {
				$this->Flash->success(__('Carrinho atualizado com sucesso.'));
			} else {
				$this->Flash->error(__('Não foi possível atualizar o carrinho. Por favor, tente novamente.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete() {
		if($this->request->is('ajax')){
			$this->autoRender = false;
			$this->CartsProduct->id = $this->request->query('id');
			if ($this->CartsProduct->delete()) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return $this->redirect(array('action' => 'index'));
		}
	}

}
