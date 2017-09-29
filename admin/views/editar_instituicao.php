<?php

    /**********************************************
     * Include Controladores de Página	          *
     **********************************************/
	
		include_once '../controladores/ControladorUsuario.php';
		include_once '../controladores/ControladorPaginas.php';
		include_once '../controladores/ControladorMenus.php';
		include_once '../controladores/ControladorInstituicoes.php';

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
			$ControladorInstituicoes	= new ControladorInstituicoes();
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

			if(isset ($_REQUEST['nome']) && isset ($_REQUEST['municipio']) && isset ($_REQUEST['uf']) && isset ($_REQUEST['enviar']) ){
		
				$Editada = new InstituicaoSchema($_REQUEST['idEdit'],$_REQUEST['nome'],$_REQUEST['jurisdicao'],$_REQUEST['municipio'],$_REQUEST['uf']);
				
				if($ControladorInstituicoes->EditarInstituicao($Editada,$Banco)){

					$tipo = "sucesso";
					$msgn = "Instituição editada com sucesso.";
					$confirma = TRUE;

				}else{

					$tipo = "erro";
					$msgn = "Ocorreu um erro na alteração. Certifique-se de ter preenchido todos os campos de forma adequada. Ou informe ao Administrador que ocorreu um \"Exception\" no Banco de Dados.";
					$confirma = TRUE;
				}

			}
			
			$filtro = "WHERE id_instituicao = ".$_REQUEST['idEdit'].";";	// busca no banco qual o registro com o ID recebido via parametro
			$result = $ControladorInstituicoes->ListarInstituicoes($Banco, $filtro);
			$linha = $result->fetch_assoc();
			
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
						<?php $Paginas->setTitleBarra("Instituições","Instituições<span class=\"icon-angle-right\"></span>Geral<span class=\"icon-angle-right\"></span>Editar Instituição"); ?>
					</div>
				</div>
				
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<?php echo $Paginas->setAviso($tipo, $msgn, $confirma) ?>
						<div class="portlet box grey">

			                <div class="portlet-title">
			                    <h4><i class="icon-reorder"></i>Editar Instituição</h4> 
			                    <div class="tools">
			                        <a href="javascript:;" class="collapse"></a>
			                    </div>
			                </div>
		                    <div class="portlet-body form">
		                        <form name="formUsuario" class="form-horizontal" action="editar_instituicao.php" method="post"/>

									<input type="hidden" name="idEdit" value="<?php echo $linha['id_instituicao']; ?>" >
									
			                        <div class="control-group">
			                           	<label class="control-label">Nome da Instituição</label>
			                           	<div class="controls">
			                               	<input class="span6 m-wrap" name="nome" type="text" value="<?php echo $linha['nome_instituicao']; ?>" pattern=".{0,100}" REQUIRED>
			                           	</div>
			                        </div> 
										 
									<div class="control-group">
		                              	<label class="control-label">Município</label>
		                              	<div class="controls">
		                                 	<input class="span6 m-wrap" name="municipio" value ="<?php echo $linha['municipio']; ?>" type="text" pattern=".{0,100}" REQUIRED>
		                              	</div>
		                           	</div>			
                        
								
										<div class="control-group">
											<label class="control-label">UF:</label>
											<div class="controls">
												<select  name="uf" align="right" class="chosen" data-placeholder="Clique para visualizar" REQUIRED>
													<option value=""/>
													<option value="AC" <?php if($linha['UF'] == 'AC') echo "selected"; ?>  />AC</option>
													<option value="AL" <?php if($linha['UF'] == 'AL') echo "selected"; ?>  />AL</option>
													<option value="AM" <?php if($linha['UF'] == 'AM') echo "selected"; ?>  />AM</option>
													<option value="AP" <?php if($linha['UF'] == 'AP') echo "selected"; ?>  />AP</option>
													<option value="BA" <?php if($linha['UF'] == 'BA') echo "selected"; ?>  />BA</option>
													<option value="CE" <?php if($linha['UF'] == 'CE') echo "selected"; ?>  />CE</option>
													<option value="DF" <?php if($linha['UF'] == 'DF') echo "selected"; ?>  />DF</option>
													<option value="ES" <?php if($linha['UF'] == 'ES') echo "selected"; ?>  />ES</option>
													<option value="GO" <?php if($linha['UF'] == 'GO') echo "selected"; ?>  />GO</option>
													<option value="MA" <?php if($linha['UF'] == 'MA') echo "selected"; ?>  />MA</option>
													<option value="MG" <?php if($linha['UF'] == 'MG') echo "selected"; ?>  />MG</option>
													<option value="MS" <?php if($linha['UF'] == 'MS') echo "selected"; ?>  />MS</option>
													<option value="MT" <?php if($linha['UF'] == 'MT') echo "selected"; ?>  />MT</option>
													<option value="PA" <?php if($linha['UF'] == 'PA') echo "selected"; ?>  />PA</option>
													<option value="PB" <?php if($linha['UF'] == 'PB') echo "selected"; ?>  />PB</option>
													<option value="PE" <?php if($linha['UF'] == 'PE') echo "selected"; ?>  />PE</option>
													<option value="PI" <?php if($linha['UF'] == 'PI') echo "selected"; ?>  />PI</option>
													<option value="PR" <?php if($linha['UF'] == 'PR') echo "selected"; ?> />PR</option>
													<option value="RJ" <?php if($linha['UF'] == 'RJ') echo "selected"; ?>  />RJ</option>
													<option value="RN" <?php if($linha['UF'] == 'RN') echo "selected"; ?>  />RN</option>
													<option value="RO" <?php if($linha['UF'] == 'RO') echo "selected"; ?>  />RO</option>
													<option value="RR" <?php if($linha['UF'] == 'RR') echo "selected"; ?>  />RR</option>
													<option value="RS" <?php if($linha['UF'] == 'RS') echo "selected"; ?>  />RS</option>
													<option value="SC" <?php if($linha['UF'] == 'SC') echo "selected"; ?>  />SC</option>
													<option value="SE" <?php if($linha['UF'] == 'SE') echo "selected"; ?>  />SE</option>
													<option value="TO" <?php if($linha['UF'] == 'TO') echo "selected"; ?>  />TO</option>
													<option value="SP" <?php if($linha['UF'] == 'SP') echo "selected"; ?>  />SP</option>
												</select>
											</div>
										</div>
								
										 
			                        <div class="control-group">
		                              	<label class="control-label">Jurisdição</label>
		                              	<div class="controls">
		                                 	<input class="span6 m-wrap" name="jurisdicao" value ="<?php echo $linha['jurisdicao']; ?>" type="text" pattern=".{0,100}">
		                              	</div>
		                           	</div>			                        

			                     
			                        <div class="form-actions">
		                              	<button name="enviar" type="submit" class="btn blue">Enviar</button>
		                              	<button type="button" class="btn" onclick="window.location.href='instituicoes.php'">Cancelar</button>
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
	
	<!-- END JAVASCRIPTS -->
</body>
</html>