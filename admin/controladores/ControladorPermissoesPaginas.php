<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		//include_once '../persistencia/Banco.php';
		include_once '../persistencia/PermissoesPaginasQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		//include_once '../modelo/PermissoesPaginasSchema.php';

		class ControladorPermissoesPaginas {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/

			private $PermissoesPaginasQM = null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/

			public function ControladorPermissoesPaginas() {

				$this->PermissoesPaginasQM 	= new PermissoesPaginasQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * Métodos de Adicionar						  *
	 		 **********************************************/

			/*	public function AdicionarCargo(&$cargo, &$Banco) {

		            return $this->CQM->AdicionarCargo($cargo, $Banco);
		        }
			*/
	        /**********************************************
	 		 * Métodos de Busca 						  *
	 		 **********************************************/

			/*	public function BuscarCargo(&$Banco, $idCargo){

					$colunas	= "*";
					$statement	= "WHERE idCargo = ".$idCargo."";

					return $this->CQM->BuscarCargo($Banco, $colunas, $statement);
				}
			*/
				public function ListarPermissoesPaginas(&$Banco,$idUsuario){

					$colunas	= "tb_paginas.id_pagina,tb_paginas.nome_pagina,tb_paginas.path,tb_paginas.logotipo,tb_paginas.tem_subitens";
					$statement	= "INNER JOIN tb_paginas on tb_permissao.id_pagina = tb_paginas.id_pagina INNER JOIN tb_usuario on tb_permissao.id_usuario = tb_usuario.id_usuario WHERE tb_usuario.id_usuario = ".$idUsuario." ORDER BY tb_permissao.id_pagina ";
				
					return $this->PermissoesPaginasQM->ListarPermissoesPaginasUsuarios($Banco, $colunas, $statement);
				}
			
				public function ListarPermissoesSubItensPaginas(&$Banco,$idPagina,$idUsuario){

					$colunas	= "*";
					$statement	= "INNER JOIN tb_permissao_sub ON tb_paginas_subitens.id_pagina_sub = tb_permissao_sub.id_pagina_sub  WHERE tb_paginas_subitens.id_pagina = ".$idPagina." AND tb_permissao_sub.id_usuario = ".$idUsuario." ORDER BY tb_paginas_subitens.nome_pagina ";
				
					return $this->PermissoesPaginasQM->ListarSubitensPaginasUsuarios($Banco, $colunas, $statement);
				}

				public function ListarPaginas(&$Banco){

					$colunas	= "*";
					$statement	= "";
				
					return $this->PermissoesPaginasQM->ListarPaginas($Banco, $colunas, $statement);
				}
			
				public function ListarSubItensPaginas(&$Banco,$idPagina){

					$colunas	= "*";
					$statement	= "WHERE id_pagina = ".$idPagina;
				
					return $this->PermissoesPaginasQM->ListarSubitensPaginasUsuarios($Banco, $colunas, $statement);
				}

			/**********************************************
	 		 * Método de Editar						  *
	 		 **********************************************/
		
			/*	public function EditarCargo(&$Banco, &$CargoEditado, $idcargo){

					$query	= "UPDATE `cargo` SET `nome`= '".$CargoEditado->get('nome')."',
					`nivel` = ".$CargoEditado->get('nivel')." WHERE `idCargo` = ".$idcargo;
				
					return $this->CQM->EditarCargo($Banco, $query);
				}
			*/
	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
			/*
	        	public function DeletarCargo($idCargo, &$Banco) {

	            	return $this->CQM->DeletarCargo($idCargo, $Banco);
	        	}
			*/
	        /**********************************************
	 		 * Alternativos								  *
	 		 **********************************************/
						
				public function TemPermissaoSub(&$Banco,$idPagina,$idUsuario){

					$colunas	= "*";
					$statement	= "WHERE id_pagina_sub = ".$idPagina." AND id_usuario = ".$idUsuario;
					
					//return  $this->PermissoesPaginasQM->BuscarPermissaoSub($Banco, $colunas, $statement);
					 if (($this->PermissoesPaginasQM->BuscarPermissaoSub($Banco, $colunas, $statement)))
						 return true;
					 else
						 return false;
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