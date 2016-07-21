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
			throw new NotFoundException(__('Sessão inválida.'));
		}
		$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
		$this->set('section', $this->Section->find('first', $options));
		$this->set('title_for_layout', 'Seções');
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
				$this->Flash->success(__('A seção foi salva.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A seção não pôde ser salva. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Seção inválida.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Section->save($this->request->data)) {
				$this->Flash->success(__('A seção foi salva.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A seção não pôde ser salva. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Seção inválida.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Section->delete()) {
			$this->Flash->success(__('A seção foi salva.'));
		} else {
			$this->Flash->error(__('A seção não pôde ser salva. Porfavor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
