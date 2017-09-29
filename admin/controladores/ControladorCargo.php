<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/CargoQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		include_once '../modelo/CargoSchema.php';

	class ControladorCargo {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/

			private $CargoQM 		= null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/

			public function ControladorCargo() {

				$this->CargoQM 		= new CargoQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * Métodos de Adicionar						  *
	 		 **********************************************/

				public function AdicionarCargo(&$cargo, &$Banco) {

		            return $this->CargoQM->AdicionarCargo($cargo, $Banco);
		        }

	        /**********************************************
	 		 * Métodos de Busca 						  *
	 		 **********************************************/

				public function BuscarCargo(&$Banco,$idCargo){

					$colunas	= "*";
					$statement	= "WHERE id_cargo = ".$idCargo."";

					return $this->CargoQM->BuscarCargo($Banco, $colunas, $statement);
				}
				
				public function BuscarNomeCargo(&$Banco, $nome){

					$colunas	= "*";
					$statement	= "WHERE nome_cargo = '".$nome."'";

					return $this->CargoQM->BuscarCargo($Banco, $colunas, $statement);
				}

				public function ListarCargos(&$Banco){

					$colunas	= "*";
					$statement	= "ORDER BY nome_cargo";
				
					return $this->CargoQM->BuscarCargo($Banco, $colunas, $statement);
				}

			/**********************************************
	 		 * Método de Editar						  *
	 		 **********************************************/

				// public function EditarCargo(&$Banco, &$CargoEditado, $idcargo){

					// $query	=  "UPDATE `tb_cargo` SET  nome_cargo= '".$CargoEditado->get('nome')."',
													   // descricao_cargo = ".$CargoEditado->get('descricao')." 
					
								// WHERE `id_cargo` = ".$idcargo;
				
					// return $this->CargoQM->EditarCargo($Banco, $query);
				// }
				
				public function EditarCargo(&$Cargo,&$Banco){

					return $this->CargoQM->AlterarCargo($Cargo, $Banco);
				}
					        
	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/

	        	public function DeletarCargo($idCargo, &$Banco) {

	            	return $this->CargoQM->DeletarCargo($idCargo, $Banco);
	        	}

			/**********************************************
	 		 * Alternativos 							  *
	 		 **********************************************/
			
				// public function getNivel(&$Banco, $idCargo){

					// $resultado = $this->CargoQM->BuscarCargo($Banco,'*', $idCargo);

					// if($linha = $resultado->fetch_assoc()){

						// return $linha['nivel'];
					// }
				// }

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