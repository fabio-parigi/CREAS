<?php
error_reporting(E_ALL);
    /**********************************************
     * Include Controladores de Página	          *
     **********************************************/
		
		include_once '../controladores/ControladorUsuario.php';
		include_once '../controladores/ControladorPaginas.php';
		include_once '../controladores/ControladorMenus.php';
		

    /**********************************************
     * Include Persistência          			  *
     **********************************************/

		include_once '../persistencia/Banco.php';

	/**********************************************
     * Identificação de Sessão         			  *
     **********************************************/

		session_start();
		
		if(!isset($_SESSION['ControladorUsuario'])) header('Location: logout.php');
		else {

		    /**********************************************
	     	* Limitador de Sessão          			  *
	     	**********************************************/		
				date_default_timezone_set("Brazil/East");
						
				$registro 	= $_SESSION['registro'];
				$limite 	= $_SESSION['limite'];

				if($registro) $segundos = time()- $registro;

				if($segundos>$limite)header("Location: logout.php");
				else $_SESSION['registro'] = time();

			$ControladorUsuario = $_SESSION['ControladorUsuario'];
			
			$Paginas 			= new Paginas();
			$Banco 				= new Banco();
			$Menus = new Menus($Banco);
		}

	/**********************************************
     * Tratamento de Mensagens de Erro 			  *
     **********************************************/

		$tipo 	 = "";
		$msgn	 = "";
		$confirma = FALSE;

	/**********************************************
     * Verificação de nível			 			  *
     **********************************************/
		// (...)

	/**********************************************
     * Aplicação					 			  *
     **********************************************/

		 $filtro="";
		 $users = $ControladorUsuario->ListarUsuario($Banco, $filtro);
	
	/**********************************************
	 * 			FIM DO SERVER SIDE			 	  *
	 **********************************************/
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="pt-BR"> <!--<![endif]-->

<!-- BEGIN HEAD -->
	<head>
		<meta charset="UTF-8" />
		<?php echo  $Paginas->setTitle(); ?>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/metro.css" rel="stylesheet" />
		<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/style_responsive.css" rel="stylesheet" />
		<link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
		<link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
		<link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
		<link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="fixed-top">
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				
				<a class="brand" href="">
					<!--<img src="assets/img/logo.png" alt="logo" />-->
				</a>
				
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->

				<ul class="nav pull-right">
					<?php $Menus->setDropDown($ControladorUsuario->NomeUser(), $ControladorUsuario->idUsuario() , $ControladorUsuario->privilegio() ); ?>
				</ul>

			</div>
		</div>
	</div>

	<!-- BEGIN CONTAINER -->	
	<div class="page-container row-fluid">

		<div class="page-sidebar nav-collapse collapse">
			<?php $Menus->setMenu($ControladorUsuario->idUsuario()); ?>
		</div>

		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - BEGIN PAGE - - - - - - - - - - - - - - - - - - - - -->
		<div class="page-content">
			<div class="container-fluid">
				
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<?php $Paginas->setTitleBarra("Usuários","Usuários"); ?>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				
				<div class="row-fluid">
					<div class="span12">
						<?php echo $Paginas->setAviso($tipo, $msgn, $confirma) ?>
						<!-- DELETE FORM -->
							<form name="formUsuario" type="hidden"  action="usuarios.php" method="post"/>
								<input type="hidden" name="id" value="">
							</form>
						<!-- END DELETE FORM -->

						<!-- EDIT FORM -->
							<form name="formEditUsuario" type="hidden"  action="editarusuario.php" method="get"/>
								<input type="hidden" name="ideditar" value="">
							</form>
						<!-- END EDIT FORM -->

						<div class="portlet box light-grey">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Usuários</h4>
								<?php 
									echo "&nbsp;&nbsp;&nbsp;<a href=\"cadastrarusuario.php\"><span class=\"label label-warning\">Adicionar Usuários</span></a>";
								?>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
										<tr>
											<th class="hidden-phone" style="">Opções</th>
											<th>Login</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											while($linha = $users->fetch_assoc()){
									            echo "	<tr class=\"odd gradeX\">
										           			<td class=\"hidden-phone\" style=\"width: 108px;\">
										           				<a href=\"javascript:editar(".$linha['id_usuario'].");\">
												           			<span class=\"label label-success\">
												           				Editar
												           			</span>	
												           		</a>	&nbsp;";
																if($ControladorUsuario->privilegio()==2)
																	echo"
																		<a href=\"javascript:excluir(".$linha['login'].");\">
																			<span class=\"label label-inverse\">
																				Remover
																			</span>
																		</a>";
												echo"
										           			</td>
										           			<td>".$linha['login']."</td>
										              			
														</tr>";
									        }
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - END CONTAINER - - - - - - - - - - - - - - - - - - - - - -->

	<!-- BEGIN COPYRIGHT -->
	  	<?php $Paginas->setCopyInterno(); ?>
	<!-- END COPYRIGHT -->
	
	<!-- BEGIN JAVASCRIPTS -->
		<script src="assets/js/jquery-1.8.3.min.js"></script>	
		<script src="assets/breakpoints/breakpoints.js"></script>	
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>		
		<script src="assets/js/jquery.blockui.js"></script>
		<!-- ie8 fixes -->
			<!--[if lt IE 9]>
				<script src="assets/js/excanvas.js"></script>
				<script src="assets/js/respond.js"></script>
			<![endif]-->	
		<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
		<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
		<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
		<script src="assets/js/app.js"></script>		
		<script>
			jQuery(document).ready(function() {			
				// initiate layout and plugins
				App.init();
			});
		</script>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-37564768-1']);
			_gaq.push(['_setDomainName', 'keenthemes.com']);
			_gaq.push(['_setAllowLinker', TRUE]);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = TRUE;
			    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<script type="text/javascript">
	        function excluir(id){
	        	if(window.confirm("Deseja realmente excluir?")){
	                document.formUsuario.id.value = id;
	                document.formUsuario.submit();
	            }
	        }
        </script>
        <script type="text/javascript">
	        function editar(id){
	        	if(window.confirm("Deseja realmente editar?")){
	                document.formEditUsuario.ideditar.value = id;
	                document.formEditUsuario.submit();
	            }
	        }
        </script>
</body>
</html>