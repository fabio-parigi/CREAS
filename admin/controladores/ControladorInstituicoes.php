<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/InstituicoesQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		include_once '../modelo/InstituicaoSchema.php';

	class ControladorInstituicoes {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
			
			private $InstituicoesQM  = null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function ControladorInstituicoes() {

				$this->InstituicoesQM  = new InstituicoesQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * Métodos de Adicionar						  *
	 		 **********************************************/

				public function AdicionarInstituicao(&$Novo, &$Banco) {

					return $this->InstituicoesQM->AdicionarInstituicao($Novo, $Banco);
				}				

	        /**********************************************
	 		 * Métodos de Busca 						  *
	 		 **********************************************/	

				
				public function ListarInstituicoes(&$Banco, $filtro){

					$colunas	= "*";
					$statement  = $filtro;
			
					return $this->InstituicoesQM->BuscarInstituicoes($Banco, $colunas, $statement);

				}
				

			

	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
	        
				public function DeletarInstituicao($idInstituicao, $Banco){

					return $this->InstituicoesQM->DeletarInstituicao($idInstituicao, $Banco);
				}

	        /**********************************************
	 		 * Método de Editar						  	  *
	 		 **********************************************/

				public function EditarInstituicao(&$Instituicao,&$Banco){

					return $this->InstituicoesQM->AlterarInstituicao($Instituicao, $Banco);
				}

							
			 /**********************************************
	 		 * Alternativos							  	  *
	 		 **********************************************/
			
				public function GetNomeInstituicao(&$Banco, $idInstituicao){

					$colunas	= "nome_instituicao";
					$statement  = "WHERE id_instituicao =".$idInstituicao;
			
					return $this->InstituicoesQM->BuscarInstituicoes($Banco, $colunas, $statement);

				}
		/********************************************************************************************
         * Métodos 'get' e 'set' moldáveis.															*
         * É possível pegar e setar o valor de qualquer variável apenas digitando o nome e o valor. *
         ********************************************************************************************/
	        public function set($variavel, $valor){
	            $this->$variavel = $valor;
	        }
	        public function get($variavel){
	            return $this->$variavel;
	        }
	}
?>