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
		$this->loadModel('CartsProduct');
		$this->loadModel('OrdersProduct');
		$options = array(
			'conditions' => array(
				'Cart.user_id' => $this->Auth->user('id'),
			),
		);
		$cartProducts = $this->CartsProduct->find('all', $options);
		$totalPrice = 0;
		$ordersProducts = array();
		foreach ($cartProducts as $cartProduct) {
			$price = ($cartProduct[$this->CartsProduct->Product->name]['promotion_price'] > 0) ? $cartProduct[$this->CartsProduct->Product->name]['promotion_price'] : $cartProduct[$this->CartsProduct->Product->name]['price'] ;
			$totalPrice = $totalPrice + $price;
			$ordersProducts[][$this->OrdersProduct->name] = array(
				'id' => $cartProduct[$this->CartsProduct->name]['product_id'],
				'quantity' => $cartProduct[$this->CartsProduct->name]['quantity'],
				'unit_price' => $price,
			);
		}
		$this->request->data[$this->Order->name]['user_id'] = $this->Auth->user('id');
		$this->request->data[$this->Order->name]['situation_id'] = '2';
		$this->request->data[$this->Order->name]['total_price'] = $totalPrice;
		if ($this->request->is('post')) {
			$this->Order->create();
			$order = $this->Order->save($this->request->data);
			foreach ($ordersProducts as $ordersProduct) {
				$ordersProduct[$this->OrdersProduct->name]['order_id'] = $this->Order->id;
			}
			$this->OrdersProduct->create();
			if ($this->OrdersProduct->saveMany($ordersProducts)) {
				debug($ordersProducts);
				// $this->CartsProduct->deleteAll(array('cart_id' => $cartProducts[0]['CartsProduct']['cart_id']));
				$this->Flash->success(__('O pedido foi salvo.'));
				// return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
			} else {
				$this->Flash->error(__('O pedido não pôde ser salvo. Por favor, tente novamente.'));
			}
		}
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
