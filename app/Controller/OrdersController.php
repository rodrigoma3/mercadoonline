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
			throw new NotFoundException(__('Invalid orders product'));
		}
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
		$this->set('order', $this->Order->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('The orders product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The orders product could not be saved. Please, try again.'));
			}
		}
		$products = $this->Order->Product->find('list');
		$orders = $this->Order->Order->find('list');
		$this->set(compact('products', 'orders'));
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
			throw new NotFoundException(__('Invalid orders product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error(__('The orders product could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid orders product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Order->delete()) {
			$this->Flash->success(__('The orders product has been deleted.'));
		} else {
			$this->Flash->error(__('The orders product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
