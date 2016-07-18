<?php
App::uses('AppController', 'Controller');
/**
 * Addresses Controller
 *
 * @property Address $Address
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class AddressesController extends AppController {

	public function isAuthorized($user = null) {
		if (parent::isAuthorized($user))
			return true;

			switch($this->action) {
				case 'add':
				case 'edit':
				case 'delete':
				case 'addressToDeliver':
					if (in_array($user['role_id'], array('3'))) {
						return true;
					} else {
						return false;
					}
					break;
			}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		debug($this->request->data);
		// if ($this->request->is('post')) {
		// 	$this->request->data[$this->Address->name]['user_id'] = $this->Auth->user('id');
		// 	$this->Address->create();
		// 	if ($this->Address->save($this->request->data)) {
		// 		$this->Flash->success(__('The address has been saved.'));
		// 		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
		// 	} else {
		// 		$this->Flash->error(__('The address could not be saved. Please, try again.'));
		// 	}
		// }
	}

/**
 * addressToDeliver method
 *
 * @return void
 */
	public function addressToDeliver() {
		if ($this->request->is('post')) {
			$this->Address->set($this->request->data);
			if($this->Address->validates()){
				$options = array('from' => 'Avenida Osvaldo Aranha, 799, Juventude, Bento Gonçalves, 95700-000', 'to' => implode(',', $this->request->data[$this->Address->name]));
				$distance = $this->calculateDistance($options);
				// debug($distance);
			} else {
				$errors = $this->Address->validationErrors;
				$this->Flash->error(__('Endereço inválido. Por favor, tente novamente.'));
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
		if (!$this->Address->exists($id)) {
			throw new NotFoundException(__('Endereço inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data[$this->Address->name]['user_id'] = $this->Auth->user('id');
			if ($this->Address->save($this->request->data)) {
				$this->Flash->success(__('O endereço foi salvo.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
			} else {
				$this->Flash->error(__('O endereço não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Address.' . $this->Address->primaryKey => $id));
			$this->request->data = $this->Address->find('first', $options);
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
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			throw new NotFoundException(__('Endereço inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Address->delete()) {
			$this->Flash->success(__('O endereço foi deletado.'));
		} else {
			$this->Flash->error(__('O endereço não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
