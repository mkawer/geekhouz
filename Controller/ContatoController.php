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
class ContatoController extends AppController {

	public function envia() {
		$this->autoRender = false;
		$this->layout = 'ajax';

		$msg = array();
		
		$this->Utils = $this->Components->load('Utils');

		$nome = $this->request->data('nome');
		$email = $this->request->data('email');
		$texto = addslashes($this->request->data('texto'));

		if(!$this->Utils->emailValido($email)) {
			$msg[] = array('cp-email','Email inválido');
		}
		if(strlen($nome)<3) {
			$msg[] = array('cp-nome','Nome deve contér pelo menos 3 caracteres');
		}
		if(strlen($texto)<10) {
			$msg[] = array('cp-texto','Texto deve contér pelo menos 10 caracteres');
		}

		if(count($msg)==0) {

			$mEmail = "Alguem fez contato através do site e deixou os seguintes dados: \n\n";
			$mEmail.= "nome:$nome\n";
			$mEmail.= "email:$email\n";
			$mEmail.= "texto:$texto\n";
			//echo $mEmail;
			$this->enviaEmail('mkawer@gmail.com', $mEmail);

		}

		echo json_encode($msg);
	
	}
	

} 

?>