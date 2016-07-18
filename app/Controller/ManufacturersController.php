<?php
App::uses('AppController', 'Controller');
/**
 * Manufacturers Controller
 *
 * @property Manufacturer $Manufacturer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ManufacturersController extends AppController {

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

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Manufacturer->recursive = 0;
		$this->set('manufacturers', $this->Manufacturer->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Manufacturer->exists($id)) {
			throw new NotFoundException(__('Fabricante inválido.'));
		}
		$options = array('conditions' => array('Manufacturer.' . $this->Manufacturer->primaryKey => $id));
		$this->set('manufacturer', $this->Manufacturer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Manufacturer->create();
			if ($this->Manufacturer->save($this->request->data)) {
				$this->Flash->success(__('O fabricante foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O fabricante não pôde ser salvo. Por favor, tente novamente.'));
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
	public function admin_edit($id = null) {
		if (!$this->Manufacturer->exists($id)) {
			throw new NotFoundException(__('Fabricante inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Manufacturer->save($this->request->data)) {
				$this->Flash->success(__('O fabricante foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O fabricante não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Manufacturer.' . $this->Manufacturer->primaryKey => $id));
			$this->request->data = $this->Manufacturer->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Manufacturer->id = $id;
		if (!$this->Manufacturer->exists()) {
			throw new NotFoundException(__('Fabricante inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Manufacturer->delete()) {
			$this->Flash->success(__('O fabricante foi deletado.'));
		} else {
			$this->Flash->error(__('O fabricante não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
