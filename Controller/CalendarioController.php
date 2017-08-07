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
class CalendarioController extends AppController {

	public function calendario() {
		
		$this->layout = "ajax";
		$this->CalendarioCp = $this->Components->load('Calendario');
		
		$dia = date('d');
		$diaSemana = date('w');
		
		$mes = date('m');
		$ano = date('Y',mktime(0,0,0,$mes,1,date('Y')));
		
		$this->set('diaSemana',$this->CalendarioCp->getDiaExtenso($diaSemana));
		$this->set('mes',$this->CalendarioCp->getMesExtenso[$mes]);
		$this->set('dia',$dia);
		
		$c = $this->CalendarioCp->monta_calendario($mes,$ano);
		$this->set("mesAtual",$this->montaTabelaCalendario($c));

		$mes = date('m')+1;
		$ano = date('Y',mktime(0,0,0,$mes,1,date('Y')));
		$c = $this->CalendarioCp->monta_calendario($mes,$ano);
		$this->set("proximoMes",$this->montaTabelaCalendario($c));
	
	}
	
	
	private function montaTabelaCalendario($objCalendario) {
		
		$tbl = '';

		$ano = $objCalendario['ano'];
		$mes = $objCalendario['mes'];
		$nmes = $objCalendario['nmes'];

		$tbl .= '<table class="MonthlyCalendar" cellpadding="0" tablespacing="0"><thead id="CalendarHead" style="height: 50px;">';
		$tbl .= '<tr><td colspan="7"><div class="FormHeader MonthNavigation"><div class="MonthName">'.$mes.' '.$ano.'</div></div></td></tr><tr><th colspan="7"><hr></th></tr>';
		
		$tbl .= '<tr><th title="Dom" class="DateHeader Weekend"><span>Dom</span></th><th title="Seg" class="DateHeader"><span>Seg</span></th><th title="Ter" class="DateHeader"><span>Ter</span></th><th title="Qua" class="DateHeader"><span>Qua</span></th><th title="Qui" class="DateHeader"><span>Qui</span></th><th title="Sex" class="DateHeader"><span>Sex</span></th><th title="Sab" class="DateHeader Weekend"><span>Sab</span></th></tr><tr><th colspan="7"><hr></th></tr></thead>';
        
		$tbl .= '<tbody id="CalendarBody">';
		
		foreach($objCalendario['calendario'] as $key => $linhas) {
			$tbl .= '<tr style="height: 52px;">';
			foreach($linhas as $k => $dia) {
				$tbl .= '<td class="DateBox" title="'.$this->escreveDia($dia).'/'.$mes.'/'.$ano.'" date="'.$this->escreveDia($dia).'/'.$nmes.'/'.$ano.'">';
				if(substr($dia,0,1)=="*") {
					$tbl .= '<div class="DateLabel"><span>'.$this->escreveDia($dia).'</span></div>';
				} elseif(substr($dia,0,1)=="#") {
					$tbl .= '<div class="DateLabel Today"><a href="javascript:void(0);">'.$this->escreveDia($dia).'</a></div>';
				} else if($dia!="") {
					$tbl .= '<div class="DateLabel"><a href="javascript:void(0);">'.$dia.'</a></div>';
				} else {
					$tbl .= '<div class="DateLabel">&nbsp;</div>';
				}
				$tbl .= '</td>';
			}
			$tbl .= '</tr>';
		}
		
		$tbl .= '</tbody>';
		$tbl .= '</table>';
		
		return $tbl;
		
		
	}

	public function getHorariosDisponiveis($dia, $mes, $ano) {
		
		$horaInicial = 17;
		$horaFinal = 2;

		$this->layout = "ajax";
		$this->autoRender = false;

		$arr_horas = array();
		
		$dia = (int) $dia;
		$mes = (int) $mes;

		$diaHoje = (int) date('d');
		$mesHoje = (int) date('m');
		$horaAgora = (int) date('H');

		$primeiraHora = mktime(max($horaInicial,$horaAgora),0,0,$mes,$dia,$ano);
		$ultimaHora = mktime($horaFinal,0,0,$mes,$dia+1,$ano);

		$hora = $primeiraHora;
		while($hora <= $ultimaHora) {
			$arr_horas[] = date('d/m/Y H:i',$hora);
			$hora = $hora + (15*60);
		}

		echo json_encode($arr_horas);
		
	}

	private function escreveDia($valor) {
		return preg_replace('/[^0-9]/','',$valor);
	}
	
} 

?>