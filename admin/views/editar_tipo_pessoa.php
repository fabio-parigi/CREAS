<?php

    /**********************************************
     * Include Controladores de Página	          *
     **********************************************/

		include_once '../controladores/ControladorUsuario.php';
		include_once '../controladores/ControladorPaginas.php';
		include_once '../controladores/ControladorMenus.php';
		include_once '../controladores/ControladorTipoPessoa.php';

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

			$ControladorUsuario 	= $_SESSION['ControladorUsuario'];
			$Banco 					= new Banco();	
			$Paginas 				= new Paginas();
			$Menus 					= new Menus($Banco);
			$ControladorTipoPessoa 	= new ControladorTipoPessoa();
		}

	/**********************************************
     * Tratamento de Mensagens de Erro 			  *
     **********************************************/

		$EstadoVerifica = array("","",FALSE,TRUE);

	/**********************************************
     * Verificação de nível			 			  *
     **********************************************/

    	// $NivelUsuarioLogado = $ControladorCargo->getNivel($Banco, $ControladorUsuario->idCargo());
    	 if($ControladorUsuario->privilegio() < 1) header("Location: 500.php");

	/**********************************************
     * Aplicação					 			  *
     **********************************************/

		if(!isset($_REQUEST['ideditar'])) header('Location: tipos_pessoas.php');
		else{
			
			$resultado = $ControladorTipoPessoa->BuscarTipoPessoa($Banco, $_REQUEST["ideditar"]);
			
			if($result = $resultado->fetch_assoc()){

				$TipoPessoaEditada = new TipoPessoaSchema($result['id_tipo_pessoa'],$result['nome_tipo_pessoa']);			
				
			}
		}
		
		if(isset($_REQUEST['enviar'])){
			if($EstadoVerifica[3] == TRUE){ // se não tem erros
				
				$TipoPessoaEditada->set('nomeTipoPessoa', $_REQUEST['nome']);

		
				if($ControladorTipoPessoa->EditarTipoPessoa($Banco, $TipoPessoaEditada)){
					 $EstadoVerifica = array("sucesso","Tipo editado com Sucesso.",TRUE,TRUE);
				 }
			}
		}
	
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
		<link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/style_responsive.css" rel="stylesheet" />
		<link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
		<link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
		<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
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
						<?php $Paginas->setTitleBarra("Tipo de Pessoa","Tipos de Pessoa<span class=\"icon-angle-right\"></span>Editar Tipos"); ?>
					</div>
				</div>
				
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<?php echo $Paginas->setAviso($EstadoVerifica[0], $EstadoVerifica[1], $EstadoVerifica[2]) ?>
						<div class="portlet box grey">

			                <div class="portlet-title">
			                    <h4><i class="icon-reorder"></i>Editar Tipo de Pessoa</h4> 
			                    <div class="tools">
			                        <a href="javascript:;" class="collapse"></a>
			                    </div>
			                </div>
		                    <div class="portlet-body form">
		                        <form name="formUsuario" class="form-horizontal" action="editar_tipo_pessoa.php?ideditar=<?php echo $_REQUEST['ideditar']; ?>" method="POST">
			                        
			                        <div class="control-group">
			                           	<label class="control-label">Nome do tipo</label>
			                           	<div class="controls">
			                               	<input class="span6 m-wrap" name="nome" value="<?php echo $TipoPessoaEditada->get('nomeTipoPessoa'); ?>" type="text" pattern=".{0,50}" title="No máximo cinquenta caracteres." required/>
			                              
			                           	</div>
			                        </div>

			                        <div class="form-actions">
		                              	<button name="enviar" id="enviar" type="submit" class="btn blue">Enviar</button>
		                              	<button type="button" class="btn" onclick="window.location.href='tipos_pessoas.php'">Cancelar</button>
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
	<script src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.blockui.js"></script>
	<script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>	
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

	<!-- END JAVASCRIPTS -->
</body>
</html>