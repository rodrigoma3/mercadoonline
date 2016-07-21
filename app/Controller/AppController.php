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
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');

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
            'authError' => false,
            // 'authError' => 'Você não está autorizado a acessar esse local.',
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
            $this->loadModel('Section');
            $this->set('menuTop', $this->Section->find('all'));
        }

        if ($this->Auth->loggedIn()) {
            $this->loadModel('Cart');
            $this->set('cart', $this->Cart->find('first', array('conditions' => array('user_id' => $this->Auth->user('id')))));
        }
	}

    public function isAuthorized($user = null) {
        // if($user['role_id'] == '1'){
            // return true;
        // }else{
            return false;
        // }
    }

    public function calculateDistance($options) {
        try {
            $HttpSocket = new HttpSocket();
    		$result = $HttpSocket->get('http://maps.googleapis.com/maps/api/distancematrix/xml', array('origins' => $options['from'], 'destinations' => $options['to'], 'language' => 'pt-BR'));
            $r = Xml::toArray(Xml::build($result->body));
            $distance = $r['DistanceMatrixResponse'];
            $distance['deliver'] = false;
            switch ($distance['status']) {
                case 'OK':
                    switch ($distance['row']['element']['status']) {
                        case 'OK':
                            if ((int) $distance['row']['element']['distance']['value'] <= 3000) {
                                $this->Flash->success(__('Endereço dentro da área de entrega'));
                                $distance['deliver'] = true;
                            } else {
                                $this->Flash->error(__('Endereço fora da área de entrega'));
                            }
                            break;
                        case 'NOT_FOUND':
                            $this->Flash->error(__('Endereço não encontrado'));
                            break;
                        case 'ZERO_RESULTS':
                            $this->Flash->error(__('Endereço fora da área de entrega'));
                            break;
                        default:
                            $this->Flash->warning(__('Houve uma falha ao processar seu pedido. Por favor, tente novamente e se o problema persistir contate o administrador.'));
                            break;
                    }
                    break;
                default:
                    $this->Flash->warning(__('Houve uma falha ao processar seu pedido. Por favor, tente novamente e se o problema persistir contate o administrador.'));
                    break;
            }
            return $distance;
        } catch (Exception $e) {
            $this->Flash->error(__('Erro inesperado'));
            return array('status' => 'ERROR');
        }
    }
}
