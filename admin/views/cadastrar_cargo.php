<?php

    /**********************************************
     * Include Controladores de Página	          *
     **********************************************/
	
		include_once '../controladores/ControladorUsuario.php';
		include_once '../controladores/ControladorPaginas.php';
		include_once '../controladores/ControladorMenus.php';
		include_once '../controladores/ControladorCargo.php';

    /**********************************************
     * Include Persistência          			  *
     **********************************************/

		include_once '../persistencia/Banco.php';

	/**********************************************
     * Identificação de Sessão         			  *
     **********************************************/

		session_start();
		
		
		if(!isset($_SESSION['ControladorUsuario'])) header('Location: logout.php');
		else{

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
			
			$Paginas 					= new Paginas();
			$Banco 						= new Banco();
			$Menus						= new Menus($Banco);
			$ControladorCargo			= new ControladorCargo();
	
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
	 
    	if($ControladorUsuario->privilegio()<1) header("Location: 500.php");

	/**********************************************
     * Aplicação					 			  *
     **********************************************/
	
		if(isset($_REQUEST['nome']) && isset($_REQUEST['descricao']) && isset($_REQUEST['enviar']) ){
	
			$Novo = new CargoSchema(NULL,$_REQUEST['nome'],$_REQUEST['descricao']);
			
			if($ControladorCargo->AdicionarCargo($Novo, $Banco)){

				$tipo = "sucesso";
				$msgn = "Cargo cadastrado com sucesso.";
				$confirma = TRUE;

			}else{

				$tipo = "erro";
				$msgn = "Ocorreu um erro no cadastro. Certifique-se de ter preenchido todos os campos de forma adequada. Ou informe ao Administrador que ocorreu um \"Exception\" no Banco de Dados.";
				$confirma = TRUE;
			}

		}
	
	    $result = $ControladorCargo->ListarCargos($Banco);
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
		<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
		<link rel="stylesheet" type="text/css" href="assets/ckeditor/contents.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
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
				<div class="row-fluid">
					<div class="span12">
						<?php $Paginas->setTitleBarra("Cargos","Instituições<span class=\"icon-angle-right\"></span>Cargos<span class=\"icon-angle-right\"></span>Novo Cargo"); ?>
					</div>
				</div>
				
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<?php echo $Paginas->setAviso($tipo, $msgn, $confirma) ?>
						<div class="portlet box grey">

			                <div class="portlet-title">
			                    <h4><i class="icon-reorder"></i>Cadastrar Cargo</h4> 
			                    <div class="tools">
			                        <a href="javascript:;" class="collapse"></a>
			                    </div>
			                </div>
		                    <div class="portlet-body form">
		                        <form name="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/> <!-- formulário com destino para a mesma página (efeito "refresh") -->

											 
			                        <div class="control-group">
			                           	<label class="control-label">Nome do Cargo</label>
			                           	<div class="controls">
			                               	<input class="span6 m-wrap" name="nome" type="text" pattern=".{0,100}" REQUIRED>
			                           	</div>
			                        </div> 			
									
			                        <div class="control-group">
			                           	<label class="control-label">Descrição do Cargo</label>
			                           	<div class="controls">
			                               	<input class="span12 m-wrap" name="descricao" type="text" pattern=".{0,100}" REQUIRED>
			                           	</div>
			                        </div> 
										 
										 


			                        <div class="form-actions">
		                              	<button name="enviar" type="submit" class="btn blue">Enviar</button>
		                              	<button type="button" class="btn" onclick="window.location.href='cargos.php'">Cancelar</button>
		                           	</div>

		                 		</form>
		                  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - END CONTAINER - - - - - - - - - - - - - - - - - - - - - -->
	
	<!-- BEGIN FOOTER -->
		<?php $Paginas->setCopyInterno(); ?>
	<!-- END FOOTER -->
	
	<!-- BEGIN JAVASCRIPTS -->
	<script src="assets/js/jquery-1.8.3.min.js"></script>			
	<script src="assets/breakpoints/breakpoints.js"></script>			

	<!--script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script> 
	<script type="text/javascript" src="assets/ckeditor/config.js"></script>
	<script type="text/javascript" src="assets/ckeditor/build-config.js"></script-->

	<script src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.blockui.js"></script>
	<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<!-- ie8 fixes -->
		<!--[if lt IE 9]>
			<script src="assets/js/excanvas.js"></script>
			<script src="assets/js/respond.js"></script>
		<![endif]-->
	<script src="assets/js/app.js"></script>		
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage('calendar');
			App.init();
		});
	</script>
	<!--script type="text/javascript">
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
	</script-->
	
	
	
	
	<!-- END JAVASCRIPTS -->
</body>
</html>