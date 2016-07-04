<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class DepartmentsController extends AppController {

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
		$this->Department->recursive = 0;
		$this->set('departments', $this->Department->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
		$this->set('department', $this->Department->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Department->create();
			if ($this->Department->save($this->request->data)) {
				$this->Flash->success(__('The department has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The department could not be saved. Please, try again.'));
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
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Department->save($this->request->data)) {
				$this->Flash->success(__('The department has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The department could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
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
		$this->Department->id = $id;
		if (!$this->Department->exists()) {
			throw new NotFoundException(__('Invalid department'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Department->delete()) {
			$this->Flash->success(__('The department has been deleted.'));
		} else {
			$this->Flash->error(__('The department could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
