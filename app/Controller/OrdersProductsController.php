<?php
App::uses('AppController', 'Controller');
/**
 * OrdersProducts Controller
 *
 * @property OrdersProduct $OrdersProduct
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class OrdersProductsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OrdersProduct->recursive = 0;
		$this->set('ordersProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrdersProduct->exists($id)) {
			throw new NotFoundException(__('Invalid orders product'));
		}
		$options = array('conditions' => array('OrdersProduct.' . $this->OrdersProduct->primaryKey => $id));
		$this->set('ordersProduct', $this->OrdersProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrdersProduct->create();
			if ($this->OrdersProduct->save($this->request->data)) {
				$this->Flash->success(__('The orders product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The orders product could not be saved. Please, try again.'));
			}
		}
		$products = $this->OrdersProduct->Product->find('list');
		$orders = $this->OrdersProduct->Order->find('list');
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
		if (!$this->OrdersProduct->exists($id)) {
			throw new NotFoundException(__('Invalid orders product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OrdersProduct->save($this->request->data)) {
				$this->Flash->success(__('The orders product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The orders product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OrdersProduct.' . $this->OrdersProduct->primaryKey => $id));
			$this->request->data = $this->OrdersProduct->find('first', $options);
		}
		$products = $this->OrdersProduct->Product->find('list');
		$orders = $this->OrdersProduct->Order->find('list');
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
		$this->OrdersProduct->id = $id;
		if (!$this->OrdersProduct->exists()) {
			throw new NotFoundException(__('Invalid orders product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->OrdersProduct->delete()) {
			$this->Flash->success(__('The orders product has been deleted.'));
		} else {
			$this->Flash->error(__('The orders product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
