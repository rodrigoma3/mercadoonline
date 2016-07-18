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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CartsProduct->exists($id)) {
			throw new NotFoundException(__('Pedido inválido.'));
		}
		$options = array('conditions' => array('CartsProduct.' . $this->CartsProduct->primaryKey => $id));
		$this->set('ordersProduct', $this->CartsProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$cart = $this->Cart->findByUserId($this->Auth->user('id'));
			debug($cart);
			// $this->request->data[$this->CartsProduct->name]['cart_id'] = $cart['id'];
			$this->CartsProduct->create();
			if ($this->CartsProduct->save($this->request->data)) {
				$this->Flash->success(__('O pedido foi salvo.'));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
			return $this->redirect(array('controller' => 'products', 'action' => 'view', $this->request->data[$this->CartsProduct->name]['product_id']));
		}
		$cart = $this->Cart->find('first', array('conditions' => array('user_id' => $this->Auth->user('id')));
		debug($cart);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CartsProduct->exists($id)) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CartsProduct->save($this->request->data)) {
				$this->Flash->success(__('O pedido foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('CartsProduct.' . $this->CartsProduct->primaryKey => $id));
			$this->request->data = $this->CartsProduct->find('first', $options);
		}
		$products = $this->CartsProduct->Product->find('list');
		$orders = $this->CartsProduct->Cart->find('list');
		$this->set(compact('products', 'orders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CartsProduct->id = $id;
		if (!$this->CartsProduct->exists()) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CartsProduct->delete()) {
			$this->Flash->success(__('O pedido foi deletado.'));
		} else {
			$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
