<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class LoginController extends AppController {

	public function interno() {
		$this->autoRender = false;
		$this->layout = "ajax";
	}


	public function loginSocial() {
		$this->autoRender = false;
		$this->layout = "ajax";

    	$this->loadModel("Usuario");
    	$u = new Usuario();
		
		/*
		email:mkawer@gmail.com
		nome:Marcello Kawer Rebelo
		:10212546718448203
		:male
		urlImagem:https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/11012954_10207092012443962_3379786890417611598_n.jpg?oh=c2f87f04263c68337e2e5d7cd7ac2366&oe=5951185D
		tipo:facebook
		*/

		$retorno = "erro";
		$senha = "123456";

		$nome = $this->request->data('nome');
		$email = $this->request->data('email');
		$id = $this->request->data('id');
		$sexo = strtoupper(substr($this->request->data('sexo'),0,1));
		$urlImagem = $this->request->data('urlImagem');
		$tipo = $this->request->data('tipo');

        $usuario = $u->find(
          'first', array('conditions' => array('email' => $email))
        );

		if(!$usuario) {
			$usuario['nome'] = $nome;
			$usuario['email'] = $email;
			$usuario['senha'] = $senha;
			$usuario['tipo'] = $tipo;
			$usuario['sexo'] = $sexo;
			$u->save($usuario);
			$usuario['id'] = $u->getLastInsertId();
		}

		if($usuario) {
			$this->Session->write('usuario',$usuario);
			$retorno = "sucesso";
		}

		echo json_encode(array('retorno' => $retorno));


	}


}
?>