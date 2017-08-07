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
class ShopController extends AppController {

	public function esvaziaCesta() {
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->Session->destroy();
	}

	public function removeDoCarrinho() {
		$id = $this->request->data('id');
		$this->autoRender = false;
		$this->layout = "ajax";
		$novoCarrinho = array(); //Recria o carrinho para ordenar o indice (remove o item recebido por parametro)
		$carrinho = $this->getCarrinho();
		foreach($carrinho as $k => $v) {
			if($v['id'] != $id) {
				array_push($novoCarrinho,$v);
			}
		}
		$this->atualizaItensCesta($novoCarrinho);
		$carrinho = $this->getCarrinho();
	}

	private function atualizaItensCesta($pedidos) {
		$this->Session->write('shop.carrinho.itens',serialize($pedidos));
	}

	private function getQuantidadeItens() {
		return $this->Session->check('shop.carrinho.qtdeItens')?$this->Session->read('shop.carrinho.qtdeItens'):0;
	}

	private function adicionaNoCarrinho($pedido) {
		$valor = $this->Session->check('shop.carrinho.total')?$this->Session->read('shop.carrinho.total'):0;
		$valor = $valor + $pedido['valor'];
		$v = split(",",number_format($valor,2,',','.'));
		$carrinho = $this->Session->check('shop.carrinho.itens')?unserialize($this->Session->read('shop.carrinho.itens')):array();
		array_push($carrinho,$pedido);
		$this->Session->write('shop.carrinho.itens',serialize($carrinho));
		$this->Session->write('shop.carrinho.total',$valor);
		$this->Session->write('shop.carrinho.vtotal',preg_replace('[^0-9]','',$v[0]));
		$this->Session->write('shop.carrinho.dtotal',$v[1]);
		$this->Session->write('shop.carrinho.ultimaInteracao',@mktime());
		$this->Session->write('shop.carrinho.qtdeItens',count($carrinho));
	}

	public function reserva_mesa() {
		$this->autoRender = false;
		$this->layout = "ajax";
		$data = $this->request->data('data');
		$tipoMesa = $this->request->data('tipoMesa');
		$mesa = $this->request->data('mesa');
		$horaInicial = $this->request->data('horaInicial');
		$horaFinal = $this->request->data('horaFinal');
		$valorCalculado = $this->calcula_reserva_hora(true);
		$valor = $valorCalculado['valor_float'];
		$objShop = $this->objetoCesta($valor,'reserva',"Reserva mesa $mesa ($tipoMesa) de $horaInicial até $horaFinal");
		$this->adicionaNoCarrinho($objShop);
		echo json_encode(array('qtde' => $this->getQuantidadeItens()));
	}

	public function informacoes_carrinho() {
		$this->layout = "ajax";
		$this->autoRender = false;
		$itens = $this->getQuantidadeItens();
		$total = $this->Session->check('shop.carrinho.total')?$this->Session->read('shop.carrinho.total'):0;
		echo json_encode(array('itens' => $itens, 'total' => $total));
	}

	private function objetoCesta($valor, $tipo, $descricao) {
		$fvalor = number_format($valor,2,',','.');
		$v = split(",",$fvalor);
		return array(
			'id'  		=> @mktime(),
			'valor' 	=> $valor,
			'fvalor'    => $fvalor,
			'v'    		=> preg_replace('[^0-9]','',$v[0]),
			'd'         => $v[1],
			'tipo' 		=> $tipo,
			'descricao' => $descricao
			
		);
	}

	public function carrinho() {
		$this->layout = 'ajax';
		$itens = $this->getCarrinho();
		$this->set('itens',$itens);
		$this->set('total',$this->Session->read('shop.carrinho.total'));
		$this->set('vtotal',$this->Session->read('shop.carrinho.vtotal'));
		$this->set('dtotal',$this->Session->read('shop.carrinho.dtotal'));
	}

	private function getCarrinho() {
		return $this->Session->check('shop.carrinho.itens')?unserialize($this->Session->read('shop.carrinho.itens')):array();
	}

	public function calcula_reserva_hora($saida=null) {
		
		$this->autoRender = false;
		$this->layout = "ajax";

		$this->Utils = $this->Components->load('Utils');

		$precos['CARD GAMES'] = 10;
		$precos['RPG'] = 15;
		$precos['BOARD GAMES'] = 20;

		$data = $this->request->data('data');
		$tipoMesa = $this->request->data('tipoMesa');
		$mesa = $this->request->data('mesa');
		$horaInicial = $this->request->data('horaInicial');
		$horaFinal = $this->request->data('horaFinal');

		$valorHora = isset($precos[$tipoMesa])?$precos[$tipoMesa]:15;

		$horas = $this->Utils->diferencaEntreDatasEmHoras($this->Utils->getDataByString($horaInicial),$this->Utils->getDataByString($horaFinal));

		$valor = $horas * $valorHora;
		$retorno = array('valor' => number_format($valor,2,',','.'), 'valor_float' => $valor, 'base' => $valorHora);
		if($saida==null) {
			echo json_encode($retorno);
		} else {
			return $retorno;	
		}
	}

	public function checkout() {
		$idUsuario = $this->Session->check("usuario.id")?$this->Session->read("usuario.id"):0;
		if($idUsuario > 0) {

			
			
		} else {
			$this->redirect("/Login/login");
		}
	}

}
?>