<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/TipoPessoaQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		include_once '../modelo/TipoPessoaSchema.php';

	class ControladorTipoPessoa {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
			
			private $TipoPessoaQM 		= null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function ControladorTipoPessoa() {

				$this->TipoPessoaQM  = new TipoPessoaQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * Métodos de Adicionar						  *
	 		 **********************************************/

			
				public function AdicionarTipoPessoa(&$NovoTipo, &$Banco) {

					return $this->TipoPessoaQM->AdicionarTipoPessoa($NovoTipo, $Banco);
				}				
							
			 
	        /**********************************************
	 		 * Métodos de Busca 						  *
	 		 **********************************************/	

				public function ListarTipoPessoa(&$Banco){

					$colunas	= "*";
					$statement  = "ORDER BY nome_tipo_pessoa";
			
					return $this->TipoPessoaQM->BuscarTipoPessoa($Banco, $colunas, $statement);

				}
				
				public function BuscarNomeTipoPessoa(&$Banco, $nome){

					$colunas	= "*";
					$statement	= "WHERE nome_tipo_pessoa = '".$nome."'";
			
					return $this->TipoPessoaQM->BuscarTipoPessoa($Banco, $colunas, $statement);

				}				
				
				public function BuscarTipoPessoa(&$Banco, $id){

					$colunas	= "*";
					$statement	= "WHERE id_tipo_pessoa = '".$id."'";
			
					return $this->TipoPessoaQM->BuscarTipoPessoa($Banco, $colunas, $statement);

				}
				



	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
	        
				public function DeletarTipoPessoa($idTipoPessoa, $Banco){

					return $this->TipoPessoaQM->DeletarTipoPessoa($idTipoPessoa, $Banco);
				}
			
	        /**********************************************
	 		 * Método de Editar						  	  *
	 		 **********************************************/
			
			
				public function EditarTipoPessoa(&$Banco, &$tipoPessoa){

					return $this->TipoPessoaQM->AlterarTipoPessoa($tipoPessoa, $Banco);
				}
			
			
			/**********************************************
	 		 * Alternativos 							  *
	 		 **********************************************/
		
			// . . . 
				


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