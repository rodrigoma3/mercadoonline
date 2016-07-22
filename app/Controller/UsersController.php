<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function isAuthorized($user = null) {
		if (parent::isAuthorized($user))
			return true;

			switch($this->action) {
				case 'admin_index':
				case 'admin_view':
				case 'admin_add':
				case 'admin_edit':
				case 'admin_delete':
				case 'admin_changePassword':
					if (in_array($user['role_id'], array('1'))) {
						return true;
					} else {
						return false;
					}
					break;
		        case 'delete':
					if (in_array($user['role_id'], array('3'))) {
						return true;
					} else {
						return false;
					}
					break;
				case 'view':
				case 'edit':
				case 'changePassword':
					if (in_array($user['role_id'], array('1', '2', '3'))) {
						return true;
					} else {
						return false;
					}
					break;
			}
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login', date("Y-m-d H:i"));
				if(in_array($this->Auth->user('role_id'), array('1', '2'))){
		            $this->Auth->loginRedirect = array('admin' => true, 'controller' => 'products', 'action' => 'index');
		        }
				return $this->redirect($this->Auth->redirectUrl());
			}
            $this->Flash->error(__('Usuário ou senha inválido.'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
		$this->set('title_for_layout', 'Usuários'); // Trocando título da página
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		$this->set('situations', $this->User->Order->Situation->find('list'));
		$this->set('title_for_layout', 'Usuários');
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->request->is('ajax')){
			$this->autoRender = false;
			$options = array('OR' => array('cpf' => $this->request->query('cpf'), 'email' => $this->request->query('email')), 'role_id' => '3');
			return $this->User->find('count', array('conditions' => $options));
		} elseif ($this->request->is('post')) {
			$this->request->data[$this->User->name]['role_id'] = '3';
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			unset($this->request->data[$this->User->name]['username']);
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			unset($this->request->data[$this->User->alias]['password']);
		}
		$roles = $this->User->Role->find('list');
		unset($roles['3']);
		$this->set(compact('roles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('O usuário foi deletado.'));
		} else {
			$this->Flash->error(__('O usuário não pôde ser deletado. Por favor, tente novamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * changePassword method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function changePassword($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data[$this->User->alias]['id'] = $id;
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$options = array($this->User->alias.'.role_id <>' => '3');
		$this->set('users', $this->User->find('all', array('conditions' => $options)));
		$this->set('title_for_layout', 'Usuários');
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$roles = $this->User->Role->find('list');
		unset($roles['3']);
		$this->set(compact('roles'));
	}

/**
 * admin_changePassword method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_changePassword($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('O usuário foi salvo.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data[$this->User->alias]['id'] = $id;
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if ($id == '1') {
			$this->Flash->error(__('Não é permitido excluir o administrador.'));
		} else {
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Usuário inválido.'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->User->delete()) {
				$this->Flash->success(__('O usuário foi deletado.'));
			} else {
				$this->Flash->error(__('O usuário não pôde ser deletado. Por favor, tente novamente.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}
}
