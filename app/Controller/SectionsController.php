<?php
App::uses('AppController', 'Controller');
/**
 * Sections Controller
 *
 * @property Section $Section
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SectionsController extends AppController {

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
		$this->Auth->allow('index');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Invalid section'));
		}
		$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
		$this->Section->recursive = 1;
		debug($this->Section->find('all',$options));
		// $products = $this->Product->find('all', array('conditions' => array('promotion_price >' => '0')));
		// // $products = $this->Product->find('all');
		// $bestSellers = $this->Product->bestSellers();
		// $optionsCategory = array();
		// foreach ($products as $product) {
		// 	$optionsCategory[$product['Category']['id']]['name'] = $product['Category']['name'];
		// 	$optionsCategory[$product['Category']['id']]['manufacturers'][$product['Manufacturer']['id']] = $product['Manufacturer']['name'];
		// }
		// $this->set('optionsCategory', $optionsCategory);
		// $this->set('products', $products);
		// $this->set('bestSellers', $bestSellers);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Invalid section'));
		}
		$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
		$this->set('section', $this->Section->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Section->create();
			if ($this->Section->save($this->request->data)) {
				$this->Flash->success(__('The section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The section could not be saved. Please, try again.'));
			}
		}
		$departments = $this->Section->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Invalid section'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Section->save($this->request->data)) {
				$this->Flash->success(__('The section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The section could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
			$this->request->data = $this->Section->find('first', $options);
		}
		$departments = $this->Section->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Section->id = $id;
		if (!$this->Section->exists()) {
			throw new NotFoundException(__('Invalid section'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Section->delete()) {
			$this->Flash->success(__('The section has been deleted.'));
		} else {
			$this->Flash->error(__('The section could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
