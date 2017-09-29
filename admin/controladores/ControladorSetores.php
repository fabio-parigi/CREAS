<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/SetorQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		include_once '../modelo/SetorSchema.php';

	class ControladorSetores {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
			
			private $SetorQM  = null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function ControladorSetores() {

				$this->SetorQM  = new SetorQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * M�todos de Adicionar						  *
	 		 **********************************************/

				public function AdicionarSetor(&$Novo, &$Banco) {

					return $this->SetorQM->AdicionarSetor($Novo, $Banco);
				}				

	        /**********************************************
	 		 * M�todos de Busca 						  *
	 		 **********************************************/	

				
				public function ListarSetores(&$Banco, $filtro){

					$colunas	= "*";
					$statement  = $filtro;
			
					return $this->SetorQM->BuscarSetor($Banco, $colunas, $statement);

				}

	        /**********************************************
	 		 * M�todo de Deletar						  *
	 		 **********************************************/
	        
				public function DeletarSetor($idSetor, $Banco){

					return $this->SetorQM->DeletarSetor($idSetor, $Banco);
				}

	        /**********************************************
	 		 * M�todo de Editar						  	  *
	 		 **********************************************/

				public function EditarSetor(&$Setor,&$Banco){

					return $this->SetorQM->AlterarSetor($Setor, $Banco);
				}
					        

		/********************************************************************************************
         * M�todos 'get' e 'set' mold�veis.															*
         * � poss�vel pegar e setar o valor de qualquer vari�vel apenas digitando o nome e o valor. *
         ********************************************************************************************/
	        public function set($variavel, $valor){
	            $this->$variavel = $valor;
	        }
	        public function get($variavel){
	            return $this->$variavel;
	        }
	}
?>