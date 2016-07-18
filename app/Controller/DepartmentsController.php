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
			throw new NotFoundException(__('Departamento inválido.'));
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
				$this->Flash->success(__('O departamento foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O departamento não pôde ser salvo. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Departamento inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Department->save($this->request->data)) {
				$this->Flash->success(__('O departamento foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O departamento não pôde ser salvo. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Departamento inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Department->delete()) {
			$this->Flash->success(__('O departamento foi deletado.'));
		} else {
			$this->Flash->error(__('O departamento não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
