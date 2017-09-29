<?php

	/**********************************************
	 * Include Controladores Necessários		  *
	 **********************************************/
	
		include_once '../controladores/ControladorUsuario.php';
		include_once '../controladores/ControladorPermissoesPaginas.php';


			
	class Menus{

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
					
			//public $today;
			
		
		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function Menus(&$Banco){
				
				  $this->Banco  = $Banco;
			}

			
			
		/**********************************************
	 	 * Alternativos 							  *
	 	 **********************************************/
			


			public function setMenu($idUsuario){
				
				$ControladorPermissoesPaginas = new ControladorPermissoesPaginas(); //carrega as classes com os métodos necessários para a consulta

			
				$resultado = $ControladorPermissoesPaginas->ListarPermissoesPaginas($this->Banco,$idUsuario); // lista as paginas que o usuario está autorizado a acessar da tabela tb_permissoes
			
					echo 	"<ul>";
					
								while($linha = $resultado->fetch_assoc()){
									
									if($linha['tem_subitens']==FALSE){ // se o item do menu não tiver subitens
										echo"
										<li class=\"sub\">
											<a href=".$linha['path'].">
												<i class=".$linha['logotipo']."></i>".$linha['nome_pagina']."
												<span class=\"selected\"></span>
											</a>					
										</li>";

									}else{
										
										$resultado2 = $ControladorPermissoesPaginas->ListarPermissoesSubItensPaginas($this->Banco,$linha['id_pagina'],$idUsuario);  //responsável por buscar os subitens de uma página-pai para exibir no menu
									
										echo"
											<li class=\"has-sub\">
												<a href=\"javascript:;\" class=\"\">
													<i class=".$linha['logotipo']."></i>".$linha['nome_pagina']."
													<span class=\"arrow\"></span>
												</a>

												<ul class=\"sub\">";
													while($linha2 = $resultado2->fetch_assoc()){
														echo"<li><a class=\"\" href=\"".$linha2['path']."\">".$linha2['nome_pagina']."</a></li>";
													}
											echo"
												</ul>
											</li>";									
									}									
								}					
					echo	"</ul>";
				
			}
			
			
			public function setDropDown($NomeUser, $idUsuario,$privilegio){

				echo 	"<li class=\"dropdown user\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
								<img alt=\"\" src=\"assets/img/avatar1_small.jpg\" />
								<span class=\"username\">".$NomeUser."</span>
								<i class=\"icon-angle-down\"></i>
							</a>
							<ul class=\"dropdown-menu\">
								
								<li><a href=\"editarusuario.php?ideditar=".$idUsuario."\"><i class=\"icon-user\"></i> &nbsp;&nbsp;Meu Usuário</a></li>";
								if($privilegio==2)echo"<li><a href=\"seguranca.php\"><i class=\"icon-lock\"></i> &nbsp;&nbsp;Segurança</a></li>"; // se o usuário tiver privilegios, ele pode acessar o painel de permissões de outros usuários
				echo"			<li><a href=\"logout.php\"><i class=\"icon-off\"></i> &nbsp;&nbsp;Sair</a></li>
							</ul>
						</li>";
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