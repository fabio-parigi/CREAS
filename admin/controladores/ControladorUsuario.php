<?php

	/**********************************************
	 * Include Persistencia de Banco de Dados	  *
	 **********************************************/

		include_once '../persistencia/Banco.php';
		include_once '../persistencia/UQM.php';

	/**********************************************
	 * Include Modelos de Banco de Dados 		  *
	 **********************************************/

		include_once '../modelo/UsuarioSchema.php';

	class ControladorUsuario {

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
			
			private $UQM 		= null;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function ControladorUsuario() {

				$this->UQM  = new UQM();
			}

		/**********************************************
		 * Funcionalidades ligadas ao Banco de Dados  *
		 **********************************************/

			/**********************************************
	 		 * M�todos de Adicionar						  *
	 		 **********************************************/

				public function AdicionarUsuario(&$NovoUsuario, &$Banco) {

					return $this->UQM->AdicionarUsuario($NovoUsuario, $Banco);
				}				

	        /**********************************************
	 		 * M�todos de Busca 						  *
	 		 **********************************************/	

				// public function ListarUsuario(&$Banco, $filtro){

					// $colunas	= "	usuario.idUsuario, usuario.login";
					// $statement  = "";
			
					// return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
					// $statement	= "   ";  //n�o h� joins para fazer no momento

					// return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
				// }
				
				public function ListarUsuario(&$Banco, $filtro){

					$colunas	= "	id_usuario,login";
					$statement  = "ORDER BY login";
			
					return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);

				}
				
				
				public function ListarPermissoesMenuUsuario(&$Banco, $filtro){

					$colunas	= "	usuario.id_usuario, usuario.login";
					$statement  = "";
			
					return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
					$statement	= "   ";  //n�o h� joins para fazer no momento

					return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
				}

				public function BuscarUsuario(&$Banco, $login){

					$colunas	= "login";
					$statement	= "WHERE login = '".$login."'";

					return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
				}

				public function BuscarDadosUsuario(&$Banco, $idUsuario){

					$colunas	= "*";
					$statement	= "WHERE id_usuario = ".$idUsuario."";

					return $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
				}

	        /**********************************************
	 		 * M�todo de Deletar						  *
	 		 **********************************************/
	        
				public function DeletarUsuario($idUsuario, $Banco){

					return $this->UQM->DeletarUsuario($idUsuario, $Banco);
				}

	        /**********************************************
	 		 * M�todo de Editar						  	  *
	 		 **********************************************/

				public function EditarUsuario(&$Banco, &$usuario){

					return $this->UQM->AlterarUsuario($usuario, $Banco);
				}

				public function EditarUsuarioSSenha(&$Banco, &$usuario){

					return $this->UQM->AlterarUsuarioSSenha($usuario, $Banco);
				}

			/**********************************************
	 		 * Alternativos 							  *
	 		 **********************************************/

				public function AutenticaUsuario($login, $senha, &$Banco) {

					$this->Usuario = new UsuarioSchema($login, $senha);
			
					if(!$this->UQM->AutenticaUsuario($this->Usuario, $Banco)){
						
						$this->Usuario = null;
						
						return FALSE;
					}else{
						
						return TRUE;
					}
				}

				

				/*public function BuscaridNivel(&$Banco, $idUsuario){   fun��o n�o ser� necess�ria enquanto n�o houver n�veis de usuario

					$colunas	= "idCargoFK";
					$statement	= "WHERE idUsuario = ".$idUsuario."";

					$resultado = $this->UQM->BuscarUsuario($Banco, $colunas, $statement);
					
					if($linha = $resultado->fetch_assoc()){
						
						return $linha['idCargoFK'];
					}
				}*/

				public function NomeUser(){

					return $this->Usuario->get('login');
				}

				/*
				public function idCargo(){ 

					return $this->Usuario->get('idCargoFK');
				}
				*/
				

				public function idUsuario(){

					return $this->Usuario->get('idUsuario');
				}


				public function privilegio(){

					return $this->Usuario->get('privilegio');
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