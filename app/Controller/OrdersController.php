<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Orders $Orders
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class OrdersController extends AppController {

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
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Pedido inválido.'));
		}
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
		$this->set('order', $this->Order->find('first', $options));
		$this->set('title_for_layout', 'Pedidos');
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->loadModel('CartsProduct');
			$options = array(
				'conditions' => array(
					'Cart.user_id' => $this->Auth->user('id'),
				),
			);
			$cartProducts = $this->CartsProduct->find('all', $options);
			$this->request->data[$this->Order->name]['user_id'] = $this->Auth->user('id');
			$this->request->data[$this->Order->name]['situation_id'] = '2';
			$cartProducts = $this->Order->OrdersProduct->Product->CartsProduct->find('all');
			$this->request->data[$this->OrdersProduct->name]['product_id'] = '';
			$this->request->data[$this->OrdersProduct->name]['quantity'] = '';
			$this->request->data[$this->OrdersProduct->name]['unit_price'] = '';
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('O pedido foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
		}
		$this->loadModel('CartsProduct');
		$options = array(
			'conditions' => array(
				'Cart.user_id' => $this->Auth->user('id'),
			),
		);
		debug($cartProducts = $this->CartsProduct->find('all', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Pedido inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('O pedido foi salvo'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Pedido inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Order->delete()) {
			$this->Flash->success(__('O pedido foi deletado.'));
		} else {
			$this->Flash->error(__('O pedido não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
