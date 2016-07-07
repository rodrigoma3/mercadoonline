<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Session',
        'Paginator',
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'admin' => false,
                'controller' => 'products',
                'action' => 'index',
            ),
            'logoutRedirect' => array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'login',
            ),
            'loginAction' => array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'login',
            ),
            'authError' => 'Você não está autorizado a acessar esse local.',
            'flash' => array(
                'params' => array(
                    'class' => 'alert alert-danger',
                ),
                'element' => 'auth',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                ),
            ),
            'authorize' => 'Controller',
        ),
    );

	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
		// $this->Auth->allow();

        if($this->request->prefix == 'admin'){
            $this->layout = 'admin';
        } else {
            $this->loadModel('Department');
            $this->set('menuDepartments', $this->Department->find('all'));
        }

	}

    public function isAuthorized($user = null) {
        // if($user['role_id'] == '1'){
            // return true;
        // }else{
            return false;
        // }
    }
}
