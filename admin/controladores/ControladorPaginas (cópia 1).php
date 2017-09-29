<?php
	/**********************************************
	 * Include Controlador de Usuários	  *
	 **********************************************/
	include_once '../controladores/ControladorUsuario.php';
	

	class Paginas{

		/**********************************************
	 	 * Atributos da Classe 						  *
	 	 **********************************************/
					
			public $today;

		/**********************************************
	 	 * Construtor da classe 					  *
	 	 **********************************************/
			
			public function Paginas(){
			}

		/**********************************************
	 	 * Alternativos 							  *
	 	 **********************************************/

			public function setTitle(){

				echo "<title>Sistema Administrativo</title>";
			}

			public function setAviso($caso, $mensagem, $confirma){
				
				if($confirma == TRUE){

					switch ($caso) {

						case 'sucesso':
							$tipo = "sucess";
							$titulo = "Sucesso!";
							break;

						case 'erro':
							$tipo = "error";
							$titulo = "Erro!";
							break;

						default:
							$tipo = "info";
							$titulo = "Informe-se!";
							break;
					}

					return 	"<div class=\"alert alert-".$tipo."\">
							<button class=\"close\" data-dismiss=\"alert\"></button>
							<strong>".$titulo."</strong> ".$mensagem."</div>";	

				}else return;

			}

			public function setTitleBarra($nomePagina, $local){

				echo	"<h3 class=\"page-title\">
							".$nomePagina."&nbsp;<small>Administrativo</small>
						</h3>
						<ul class=\"breadcrumb\">
							<li>
								<i class=\"icon-home\"></i>
								<span class=\"icon-angle-right\"></span>
							</li>
							<li>
								".$local."
							</li>
							<li class=\"pull-right no-text-shadow\">
								<div class=\"dataDashboard hidden-phone\">
									<i class=\"icon-calendar\"></i>
									".$this->getData()."
								</div>
							</li>
						</ul>";
			}

			public function setCopy(){

				echo 	"<div class=\"copyright\">
		    				&copy;2016 - CREAS Ibitinga - Todos os direitos reservados
		  				</div>";
			}

			public function setCopyInterno(){
				echo 	"<div class=\"footer\">

							&copy;2016 - CREAS Ibitinga - Todos os direitos reservados
							<div class=\"span pull-right\">
								<span class=\"go-top\"><i class=\"icon-angle-up\"></i></span>
							</div>
						</div>";
			}

			public function setMenu($nivel){

				echo 	"<ul>
							<li class=\"sub\">
								<a href=\"home.php\">
									<i class=\"icon-home\"></i> Inicial
									<span class=\"selected\"></span>
								</a>					
							<!-- /li>
							
							<li class=\"sub\">
								<a href=\"postagem.php\">
									<i class=\"icon-pencil\"></i> Postagens
									<span class=\"selected\"></span>
								</a>					
							</li -->
							
							
							
							
							
							<li class=\"sub\">
								<a href=\"pessoas.php\">
									<i class=\"icon-search\"></i> Registro de Pessoas
									<span class=\"selected\"></span>
								</a>					
							</li>";
				if($nivel >= 1){
							echo"





						<li class=\"has-sub\">
									<a href=\"javascript:;\" class=\"\">
										<i class=\"icon-reorder\"></i> P.I.A.
										<span class=\"arrow\"></span>
									</a>
									<ul class=\"sub\">
										<li><a class=\"\" href=\"identificacao.php\">1.Identificação</a></li>
										<li><a class=\"\" href=\"documentacao.php\">2.Documentação</a></li>
										<li><a class=\"\" href=\"situacao_processual.php\">3.Situação Processual</a></li>
										<li><a class=\"\" href=\"situacao_habitacional.php\">4.Situação Habitacional</a></li>
										<li><a class=\"\" href=\"composicao_familiar.php\">5.Composição Familiar</a></li>
										<li><a class=\"\" href=\"rede_servicos.php\">6.Rede de Serviços</a></li>
										<li><a class=\"\" href=\"historico_familiar.php\">7.Histórico Familiar</a></li>
										<li><a class=\"\" href=\"historico_adolescente.php\">8.Histórico do Adolescente</a></li>
										<li><a class=\"\" href=\"escolarizacao.php\">9.Escolarização</a></li>
										<li><a class=\"\" href=\"profissionalizacao.php\">10.Profissionalização</a></li>
										<li><a class=\"\" href=\"atividades_laborativas.php\">11.Atividades Laborativas</a></li>
										<li><a class=\"\" href=\"atividades_culturais.php\">12.Atividades Culturais E./ L.</a></li>
										<li><a class=\"\" href=\"expectativas.php\">13.Expectativas do Adolescente</a></li>
										<li><a class=\"\" href=\"#\">14.Planejamento dos Atendimentos</a></li>
										<li><a class=\"\" href=\"#\">15.Controle de Encaminhamento de Relatórios</a></li>
										<li><a class=\"\" href=\"#\">16.Quadro de Ações</a></li>
									</ul>
								</li>";
				

				}

				if($nivel == 2){
					echo "<li class=\"sub\">
								<a href=\"usuarios.php\">
									<i class=\"icon-group\"></i>[Admin] Usuários
									<span class=\"selected\"></span>
								</a>					
							</li>
							
	
						<li class=\"sub\">
								<a href=\"log.php\">
									<i class=\"icon-arrow-down\"></i> Acessos
									<span class=\"selected\"></span>
								</a>					
							</li>
				
			
							<li class=\"sub\">
								<a href=\"logout.php\">
									<i class=\"icon-off\"></i> Sair
									<span class=\"selected\"></span>
								</a>					
							</li>
						</ul>";
				}
			}

			public function setDropDown($NomeUser, $idUsuario,$privilegio){

				echo 	"<li class=\"dropdown user\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
								<img alt=\"\" src=\"assets/img/avatar1_small.jpg\" />
								<span class=\"username\">".$NomeUser."</span>
								<i class=\"icon-angle-down\"></i>
							</a>
							<ul class=\"dropdown-menu\">
								<li><a href=\"logout.php\"><i class=\"icon-off\"></i> &nbsp;&nbsp;Sair</a></li>
								<li><a href=\"editarusuario.php?ideditar=".$idUsuario."\"><i class=\"icon-user\"></i> &nbsp;&nbsp;Meu Usuário</a></li>";
								if($privilegio==2)echo"<li>2</li>";
				echo"			</ul>
						</li>";
			}

			public function setData(){

				$this->today = getdate();
				
				switch ($this->today['weekday']) {
					case "Monday":
						$this->today['weekday'] = "Segunda-feira";
						break;
					case "Tuesday":
						$this->today['weekday'] = "Terça-feira";
						break;
					case "Wednesday":
						$this->today['weekday'] = "Quarta-feira";
						break;
					case "Thursday":
						$this->today['weekday'] = "Quinta-feira";
						break;
					case "Friday":
						$this->tody['weekday'] = "Sexta-feira";
						break;
					case "Saturday":
						$this->today['weekday'] = "Sábado";
						break;
					case "Sunday":
						$this->today['weekday'] = "Domingo";
						break;
				} 

				switch ($this->today['month']) {
					case "January";
						$this->today['month'] = "Janeiro";
						break;
					case "February";
						$this->today['month'] = "Fevereiro";
						break;
					case "March";
						$this->today['month'] = "Março";
						break;
					case "April";
						$this->today['month'] = "Abril";
						break;
					case "May";
						$this->today['month'] = "Maio";
						break;
					case "June";
						$this->today['month'] = "Junho";
						break;
					case "July";
						$this->today['month'] = "Julho";
						break;
					case "August";
						$this->today['month'] = "Agosto";
						break;
					case "September";
						$this->today['month'] = "Setembro";
						break;	
					case "October";
						$this->today['month'] = "Outubro";
						break;
					case "November";
						$this->today['month'] = "Novembro";
						break;
					case "December";
						$this->today['month'] = "Dezembro";
						break;
				}
			}

			public function getData(){

				$this->setData();
				
				return "&nbsp;".$this->today['weekday'].", ".$this->today['mday']." de ".$this->today['month']." de ".$this->today['year']."&nbsp;&nbsp;";
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