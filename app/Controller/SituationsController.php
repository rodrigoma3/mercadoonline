<?php
App::uses('AppController', 'Controller');
/**
 * Situations Controller
 *
 * @property Situation $Situation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SituationsController extends AppController {

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
		$this->Situation->recursive = 0;
		$this->set('situations', $this->Situation->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Situation->exists($id)) {
			throw new NotFoundException(__('Invalid situation'));
		}
		$options = array('conditions' => array('Situation.' . $this->Situation->primaryKey => $id));
		$this->set('situation', $this->Situation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Situation->create();
			if ($this->Situation->save($this->request->data)) {
				$this->Flash->success(__('The situation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The situation could not be saved. Please, try again.'));
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
		if (!$this->Situation->exists($id)) {
			throw new NotFoundException(__('Invalid situation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Situation->save($this->request->data)) {
				$this->Flash->success(__('The situation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The situation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Situation.' . $this->Situation->primaryKey => $id));
			$this->request->data = $this->Situation->find('first', $options);
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
		$this->Situation->id = $id;
		if (!$this->Situation->exists()) {
			throw new NotFoundException(__('Invalid situation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Situation->delete()) {
			$this->Flash->success(__('The situation has been deleted.'));
		} else {
			$this->Flash->error(__('The situation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
