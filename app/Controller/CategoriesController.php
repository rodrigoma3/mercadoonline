<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class CategoriesController extends AppController {

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
		$this->Category->recursive = 0;
		$this->set('categories', $this->Category->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Categoria inválida.'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
		$this->set('title_for_layout', 'Categorias');
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('A categoria foi salva.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A categoria não pôde ser salva. Por favor, tente novamente.'));
			}
		}
		$sections = $this->Category->Section->find('list');
		$this->set(compact('sections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Categoria inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('A categoria foi salva.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('A categoria não pôde ser salva. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$sections = $this->Category->Section->find('list');
		$this->set(compact('sections'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Categoria inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Flash->success(__('A categoria foi deletada'));
		} else {
			$this->Flash->error(__('A categoria não pôde ser deletada. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
