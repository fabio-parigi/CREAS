<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/PessoaQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		//include_once '../modelo/PessoaSchema.php';

	class ControladorPessoas {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
			
			private $PessoaQM 		= null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function ControladorPessoas() {

				$this->PessoaQM  = new PessoaQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * Métodos de Adicionar						  *
	 		 **********************************************/

			
				public function AdicionarPessoa(&$NovaPessoa, &$Banco) {

					return $this->PessoaQM->AdicionarPessoa($NovaPessoa, $Banco);
				}				
							
			 
	        /**********************************************
	 		 * Métodos de Busca 						  *
	 		 **********************************************/	

				public function ListarPessoas(&$Banco){

					$colunas	= "*";
					$statement  = "ORDER BY nome_pessoa";
			
					return $this->PessoaQM->BuscarPessoa($Banco, $colunas, $statement);

				}
				
				public function BuscarNomePessoa(&$Banco, $nome){

					$colunas	= "*";
					$statement	= "WHERE nome_pessoa = '".$nome."'";
			
					return $this->PessoaQM->BuscarPessoa($Banco, $colunas, $statement);

				}				
				
				public function BuscarPessoa(&$Banco, $id){

					$colunas	= "*";
					$statement	= "WHERE id_pessoa = '".$id."'";
			
					return $this->PessoaQM->BuscarPessoa($Banco, $colunas, $statement);

				}
				



	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
	        
				public function DeletarPessoa($idPessoa, $Banco){

					return $this->PessoaQM->DeletarPessoa($idPessoa, $Banco);
				}
			
	        /**********************************************
	 		 * Método de Editar						  	  *
	 		 **********************************************/
			
			
				public function EditarPessoa(&$Banco, &$Pessoa){

					return $this->PessoaQM->AlterarPessoa($Pessoa, $Banco);
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