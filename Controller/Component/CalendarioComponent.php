<?php

class CalendarioComponent extends Component {
      
      public $dia;
      public $mes;
      public $ano;
      public $tstamp;
      public $dtmanip;
      public $dsprimdia;
      public $linhafechada;
	  public $tstamp_hj;
	  
	  private $meses = array(1 => 'Janeiro',
							 2 => 'Fevereiro',
							 3 => 'Março',
							 4 => 'Abril',
							 5 => 'Maio',
							 6 => 'Junho',
							 7 => 'Julho',
							 8 => 'Agosto',
							 9 => 'Setembro',
							 10 => 'Outubro',
							 11 => 'Novembro',
							 12 => 'Dezembro'
							);
	  private $diasSemana = array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado');
	  
      public function getMesExtenso($mes) {
		  return $meses[$mes];
	  }
	  
	  public function getDiaExtenso($dia) {
		  return $this->diasSemana[$dia];
	  }
	  
	  public function calcula_tstamp_hj() {
		 $this->tstamp_hj = mktime(0,0,0,date('m'),date('d'),$this->ano); 
	  }
        
      public function calcula_tstamp() {
         $this->tstamp = mktime(0,0,0,$this->mes,$this->dia,$this->ano);
      }
      
      public function data_manipulavel() {
         $this->dtmanip = getdate( $this->tstamp );
      }
      
      public function primeiro_dia_mes() {
         $this->dsprimdia = $this->dtmanip[ "wday" ];
      }
      
      public function proximo_dia() {
         $this->dia++;
         $this->calcula_tstamp();         
      }
      
      public function monta_calendario($pmes, $pano) {
         
         $this->linhafechada = true;
         $this->dia = 1;
         $this->mes = (int) $pmes;
         $this->ano = $pano;
         $this->calcula_tstamp();
		 $this->calcula_tstamp_hj();
         $this->data_manipulavel();
         $this->primeiro_dia_mes();		 
		 $linhas = array();
		 
         $ccol = 0;
         $casa = 0;
		 $linha = array();
         
		 while( checkdate( $this->mes, $this->dia, $this->ano ) ) {
            
            if ( $casa < $this->dsprimdia ) {
               array_push($linha,'');
            } else {
				
               if($this->tstamp == $this->tstamp_hj) {
                  array_push($linha,'#'.$this->dia);
               } elseif($this->tstamp < $this->tstamp_hj) {
   					array_push($linha,'*'.$this->dia);
   				} else {
   					array_push($linha,$this->dia);
   				}

               $this->proximo_dia();
            }
			
            $ccol++;
            $ccol = $ccol % 7;
            $casa++;
            if ( ( $casa % 7 ) == 0 ) {
			   array_push($linhas,$linha);
			   $linha = array();
            }
         }
		 
         while( $ccol != 0 ) {
            $ccol++;
            $ccol = $ccol % 7;
            array_push($linha,'');
         }
         array_push($linhas,$linha);
		 
		 return array('calendario'=>$linhas,'nmes'=>$this->mes,'mes'=>$this->meses[$this->mes],'ano'=>$this->ano);
		 
      }
      
   }


?>