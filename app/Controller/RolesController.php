<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RolesController extends AppController {

	public function isAuthorized($user = null) {
		if (parent::isAuthorized($user))
			return true;

			switch($this->action) {
				case 'admin_index':
				case 'admin_view':
				case 'admin_add':
				case 'admin_edit':
				case 'admin_delete':
					if (in_array($user['role_id'], array('1'))) {
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
		$this->Role->recursive = 0;
		$this->set('roles', $this->Role->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
		$this->set('role', $this->Role->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Role->create();
			if ($this->Role->save($this->request->data)) {
				$this->Flash->success(__('The role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The role could not be saved. Please, try again.'));
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
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Role->save($this->request->data)) {
				$this->Flash->success(__('The role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The role could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
			$this->request->data = $this->Role->find('first', $options);
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
		$this->Role->id = $id;
		if (!$this->Role->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Role->delete()) {
			$this->Flash->success(__('The role has been deleted.'));
		} else {
			$this->Flash->error(__('The role could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
